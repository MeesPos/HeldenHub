<?php
// Dit bestand hoort bij de router, enb bevat nog een aantal extra functiesdie je kunt gebruiken
// Lees meer: https://github.com/skipperbent/simple-php-router#helper-functions
require_once __DIR__ . '/route_helpers.php';

// Hieronder kun je al je eigen functies toevoegen die je nodig hebt
// Maar... alle functies die gegevens ophalen uit de database horen in het Model PHP bestand

/**
 * Verbinding maken met de database
 * @return \PDO
 */
function dbConnect()
{

	$config = get_config('DB');

	try {
		$dsn = 'mysql:host=' . $config['HOSTNAME'] . ';dbname=' . $config['DATABASE'] . ';charset=utf8';

		$connection = new PDO($dsn, $config['USER'], $config['PASSWORD']);

		$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

		return $connection;
	} catch (\PDOException $e) {
		echo 'Fout bij maken van database verbinding: ' . $e->getMessage();
		exit;
	}
}

/**
 * Geeft de juiste URL terug: relatief aan de website root url
 * Bijvoorbeeld voor de homepage: echo url('/');
 *
 * @param $path
 *
 * @return string
 */
function site_url($path = '')
{
	return get_config('BASE_URL') . $path;
}
function absolute_url($path = '')
{
	return get_config('BASE_HOST') . $path;
}

function get_config($name)
{
	$config = require __DIR__ . '/config.php';
	$name = strtoupper($name);

	if (isset($config[$name])) {
		return $config[$name];
	}

	throw new \InvalidArgumentException('Er bestaat geen instelling met de key: ' . $name);
}

/**
 * Hier maken we de template engine en vertellen de template engine waar de templates/views staan
 * @return \League\Plates\Engine
 */
function get_template_engine()
{

	$templates_path = get_config('PRIVATE') . '/views';

	return new League\Plates\Engine($templates_path);
}

function isAdmin($data)
{

	if ($data['admin'] !== '1') {
		$redirectURL = url('home');
		redirect($redirectURL);
	}
}



function userNotRegistered($email)
{
	$connection = dbConnect();
	$sql =  'SELECT * FROM `gebruikers` WHERE `email`= :email';
	$statement = $connection->prepare($sql);
	$statement->execute(['email' => $email]);
	return ($statement->rowCount() === 0);
}

//email 

/**
 * Maak de SwiftMailer aan en stet hem op de juiste manier in
 *
 * @return Swift_Mailer
 */
function getSwiftMailer()
{
	$mail_config = get_config('MAIL');
	$transport   = new \Swift_SmtpTransport($mail_config['SMTP_HOST'], $mail_config['SMTP_PORT']);

	if (!empty($mail_config['SMTP_USER'])) {
		$transport->setUsername($mail_config['SMTP_USER']);
		$transport->setPassword($mail_config['SMTP_PASSWORD']);
	}

	$mailer = new \Swift_Mailer($transport);

	return $mailer;
}

/**
 * Maak een Swift_Message met de opgegeven subject, afzender en ontvanger
 *
 * @param $to
 * @param $subject
 * @param $from_name
 * @param $from_email
 *
 * @return Swift_Message
 */
function createEmailMessage($to, $subject, $from_name, $from_email)
{

	// Create a message
	$message = new \Swift_Message($subject);
	$message->setFrom([$from_email => $from_email]);
	$message->setTo($to);

	// Send the message
	return $message;
}

/**
 *
 * @param $message \Swift_Message De Swift Message waarin de afbeelding ge-embed moet worden
 * @param $filename string Bestandsnaam van de afbeelding (wordt automatisch uit juiste folder gehaald)
 *
 * @return mixed
 */
function embedImage($message, $filename)
{
	$image_path = get_config('WEBROOT') . '/images/email/' . $filename;
	if (!file_exists($image_path)) {
		throw new \RuntimeException('Afbeelding bestaat niet: ' . $image_path);
	}

	if ($message) {
		$cid = $message->embed(\Swift_Image::fromPath($image_path));

		return $cid;
	}
	return site_url('/images/email/' . $filename);
}
/**
 * confirms een account bij confirmer
 *
 * @param  $code
 */
function confirmAccount($code)
{

	$connection = dbConnect();
	$sql =  'UPDATE  `gebruikers` SET `code` = NULL WHERE  `code`= :code';
	$statement = $connection->prepare($sql);
	$params = [
		'code' => $code
	];
	$statement->execute($params);
}
function sendConfirmationEmail($email, $code)
{


	$url = url('bevestigenEmailCode', ['code' => $code]);
	$absolute_url = absolute_url($url);

	$mailer = getSwiftMailer();
	$message = createEmailMessage($email, 'Bevestig je account', 'HeldenHub', 'buneya2001@gmail.com');
	$email_text = 'Hallo, bevestig nu je account: <a href="' . $absolute_url . '">Klik Hier </a>';
	$message->setBody($email_text, 'text/html');

	$mailer->send($message);
}

// AANMELDPAGINA 

function validateRegistrationForm($data, $myfile, $errors)
{

	// Informatie uit post ophalen
	$email      = filter_var($data['email'], FILTER_VALIDATE_EMAIL);
	$wachtwoord = trim($data['wachtwoord']);

	// Overige post info ophalen voor duidelijke storage in data variabele
	$voornaam = $data['voornaam'];
	$achternaam = $data['achternaam'];
	$plaats = $data['plaats'];
	$birthday = $data['birthday'];

	// Check of email al bestaat 	
	if ($email === false) {
		$errors['email'] = 'Geen geldig email ingevuld';
	}

	// Check of wachtwoord 6 tekens bevat
	if (empty($wachtwoord) || strlen($wachtwoord) < 6) {
		$errors['wachtwoord'] = 'Geen geldig wachtwoord!';
	}

	// Resultaat array aanmaken
	$data = [
		'email' 	 => $email,
		'wachtwoord' =>	$wachtwoord,
		'voornaam'	 => $voornaam,
		'achternaam' => $achternaam,
		'plaats'     => $plaats,
		'birthday'	 => $birthday,
		'profielfoto' => $myfile
	];

	// Return POST data & eventuele errors
	return [
		'data'	=> $data,
		'errors' => $errors
	];
}

function verwerkFotoUpload($myfile, $errors)
{

	// Check of er uberhaupt een file is geupload
	if (!isset($_FILES['myfile'])) {
		$message = "Geen bestand geupload!";
		    echo "<script type='text/javascript'>alert('$message');</script>";
		exit;
	}

	//  Checken van upload fouten
	$file_error = $myfile['myfile']['error'];
	switch ($file_error) {
		case UPLOAD_ERR_OK:
			break;
		case UPLOAD_ERR_NO_FILE:
			$errors['myfile'] = 'Er is geen bestand geupload';
			break;
		case UPLOAD_ERR_CANT_WRITE:
			$errors['myfile'] = 'Kan niet schrijven naar disk';
			break;
		case UPLOAD_ERR_INI_SIZE:
		case UPLOAD_ERR_FORM_SIZE:
			$errors['myfile'] = 'Dit bestand is te groot, pas php.ini aan';
			break;
		default:
			$errors['myfile'] = 'Onbekeden fout';
	}

	if (count($errors) === 0) {

		$file_name = $myfile['myfile']['name'];
		$file_size = $myfile['myfile']['size'];
		$file_tmp = $myfile['myfile']['tmp_name'];
		$file_type = $myfile['myfile']['type'];

		// Is het een afbeelding check  
		$valid_image_types = [
			2 => 'jpg',
			3 => 'png'
		];
		$image_type        = exif_imagetype($file_tmp);
		if ($image_type !== false) {
			// Juiste extensie opzoeken, die gaan we zo gebruiken bij het maken van de nieuwe bestandsnaam
			$file_extension = $valid_image_types[$image_type];
		} else {
			$errors['myfile'] = 'Dit is geen afbeelding!';
		}
	}

	if (count($errors) === 0) {

		// Bestandsnaam genereren
		$new_filename   = sha1_file($file_tmp) . '.' . $file_extension;
		$final_filename = 'uploads/' . $new_filename;

		// met move_uploaded_file verplaats je het tijdelijke bestand naar de uiteindelijke plek
		move_uploaded_file($file_tmp, $final_filename); // dus van tijdelijke bestandsnaam naar de originele naam (in de huidige map);

		return $new_filename;
	}
}
function validate($data)
{
	$errors = [];

	$email      = filter_var($data['email'], FILTER_VALIDATE_EMAIL);
	$wachtwoord = trim($data['wachtwoord']);

	if ($email === false) {
		$errors['email'] = 'Geen geldig email ingevuld';
	}

	if (empty($wachtwoord) || strlen($wachtwoord) < 6) {
		$errors['wachtwoord'] = 'Geen geldig wachtwoord!';
	}
	$data = [
		'email' => $data['email'],
		'wachtwoord' => $wachtwoord
	];

	return [
		'data' => $data,
		'errors' => $errors
	];
}

function gebruikersOphalen()
{
	$connection = dbConnect();
	$gebruikersVinden = 'SELECT `voornaam`, `id` FROM `gebruikers`';
	$statementBan = $connection->prepare($gebruikersVinden);
	$statementBan->execute();

	$gebruikersData = $statementBan->fetchAll();

	return json_encode(array_values($gebruikersData));
}

function loggedInCheck()
{
	// Niet ingelogd? Terug naar log in pagina
	// ALLEEN TE GEBRUIKEN VOOR LOG IN REQUIRED PAGES
	if (!isset($_SESSION['user_id'])) {
		session_start();
	}
}

function adminLoginCheck($url) {
	if(!isset($_SESSION['user_id'])) {
		$bedanktUrl = url($url);
		redirect($bedanktUrl);
	}
}

function JSONemailOphalen() {
	$connection = dbConnect();
	$sql = 'SELECT `email` FROM `gebruikers`';
	$statement = $connection->prepare($sql);
	$statement->execute();

	$gebruikersEmail = $statement->fetchAll();

	return json_encode(array_values($gebruikersEmail));
}

function sendPasswordResetEmail($email) {

	// Code genereren en opslaan bij dit email adres (gebruiker)
	$reset_code = md5( uniqid( rand(), true) );
	$connection = dbConnect();
	$sql 		= 'UPDATE `gebruikers` SET `password_reset` = :code WHERE `email` = :email';
	$statement	= $connection->prepare($sql);
	$params 	= [
		'code'  => $reset_code,
		'email' => $email
	];
	$statement->execute($params);


	// Link genereren met code
	$url = url('wachtwoord.reset', ['reset_code' => $reset_code]);
	$absolute_url = absolute_url($url);


	// Mail opstellen en versturen
	$mailer = getSwiftMailer();
	$message = createEmailMessage($email, 'Wachtwoord resetten', 'HeldenHub', '29035@ma-web.nl');
	$email_text = 'Hallo, klik hier om je wachtwoord te resetten: <a href="' . $absolute_url . '">Wachtwoord resetten </a>';

	$message->setBody($email_text, 'text/html');
	$mailer->send($message);
}

// api
function krijgCoronaData() {
	$url = 'https://api.covid19api.com/summary';

	// HTTP client aanmaken
	$client = new \GuzzleHttp\Client();

	// Request doen
	$response = $client->request('GET', $url);
	$json	  = $response->getBody();

	// JSON omzetten in een array met json_decode()
	$country_info	= json_decode($json, true);
	return $country_info;
}