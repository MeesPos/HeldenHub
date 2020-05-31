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
		$dsn = 'mysql:host=' . $config('HOSTNAME') . ';dbname=' . $config['DATABASE'] . ';charset=utf8';

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

function isLoggedIn()
{
	if (isset($_SESSION['user_id'])) {
		return true;
	} else {
		return false;
	}
}
function validatelogin($data)
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

function userNotRegistered($email)
{
	$connection = dbConnect();
	$sql =  'SELECT * FROM `gebruikers` WHERE `email`= :email';
	$statement = $connection->prepare($sql);
	$statement->execute(['email' => $email]);
	return ($statement->rowCount() === 0);
}

function getLoggedInVoornaam(){
	$voornaam ='Niet Ingelogd!!';
	if (!isLoggedIn()){
		return $voornaam;
	}
	
	$user_id = $_SESSION['user_id'];
	$user = getUsersById($user_id) ;

	if($user){
		$voornaam =$user['voornaam'];
	}
	return $voornaam;
}
function getLoggedInAchternaam(){
	$achternaam ='Niet Ingelogd!!';
	if (!isLoggedIn()){
		return $achternaam;
	}
	
	$user_id = $_SESSION['user_id'];
	$user = getUsersById($user_id) ;

	if($user){
		$achternaam =$user['achternaam'];
	}
	return $achternaam;
}
function getLoggedInPlaats(){
	$plaats ='Niet Ingelogd!!';
	if (!isLoggedIn()){
		return $plaats;
	}
	
	$user_id = $_SESSION['user_id'];
	$user = getUsersById($user_id) ;

	if($user){
		$plaats =$user['plaats'];
	}
	return $plaats;
}
function getLoggedInMyfile(){
	$myfile ='Niet Ingelogd!!';
	if (!isLoggedIn()){
		return $myfile;
	}
	
	$user_id = $_SESSION['user_id'];
	$user = getUsersById($user_id) ;

	if($user){
		$myfile =$user['myfile'];
	}
	return $myfile;
} 
function getLoggedInBirthday(){
	$birthday ='Niet Ingelogd!!';
	if (!isLoggedIn()){
		return $birthday;
	}
	
	$user_id = $_SESSION['user_id'];
	$user = getUsersById($user_id) ;

	if($user){
		$birthday =$user['birthday'];
	}
	return $birthday;
}
function getLoggedInEmail(){
	$email ='Niet Ingelogd!!';
	if (!isLoggedIn()){
		return $email;
	}
	
	$user_id = $_SESSION['user_id'];
	$user = getUsersById($user_id) ;

	if($user){
		$email =$user['email'];
	}
	return $email;
}



