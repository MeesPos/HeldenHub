<?php

namespace Website\Controllers;

/**
 * Class HomeController
 *
 * Deze handelt de logica van de homepage af
 * Haalt gegevens uit de "model" laag van de website (de gegevens)
 * Geeft de gegevens aan de "view" laag (HTML template) om weer te geven
 *w
 */
class WebsiteController
{

	public function home()
	{

		$template_engine = get_template_engine();
		echo $template_engine->render('homepage');
	}

	public function aanmelden()
	{

		$template_engine = get_template_engine();
		echo $template_engine->render('AanmeldPagina');
	}

	public function registreer()
	{

		$errors = [];
		// geldig email
		$email      = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
		$wachtwoord = trim($_POST['wachtwoord']);
		$herwachtwoord = trim($_POST['herwachtwoord']);
		$voornaam = $_POST['voornaam'];
		$achternaam = $_POST['achternaam'];
		$plaats = $_POST['plaats'];
		$birthday = $_POST['birthday'];
		$myfile = $_POST['myfile'];
		if ($email === false) {
			$errors['email'] = 'Geen geldig email ingevuld';
		}

		if (empty($wachtwoord) || strlen($wachtwoord) < 6) {
			$errors['wachtwoord'] = 'Geen geldig wachtwoord!';
		}
		if (count($errors) === 0) {
			// als geen error kan ie registreer
			$connection = dbConnect();

			$sql =  'SELECT * FROM `gebruikers` WHERE `email`= :email';
			$statement = $connection->prepare($sql);

			$statement->execute(['email' => $email]);

			if ($statement->rowCount() === 0) {
				# opslaan ...
	
				$sql =  'INSERT INTO `gebruikers` ( `email`, `voornaam`, `achternaam`, `plaats`, `birthday`, `myfile`, `wachtwoord`, `herwachtwoord`, `code`)
			VALUE (:email, :voornaam, :achternaam, :plaats, :birthday, :myfile, :wachtwoord, :herwachtwoord, :code )';
				$statement = $connection->prepare($sql);
			}
			$safe_wachtwoord = password_hash($wachtwoord, PASSWORD_DEFAULT);

			$params = [
				'email' => $email,
				'voornaam' => $voornaam,
				'achternaam' => $achternaam,
				'plaats' => $plaats,
				'birthday' => $birthday,
				'myfile' => $myfile,
				'wachtwoord' => $safe_wachtwoord,
				'herwachtwoord' => $safe_wachtwoord,
				
			];
			$statement->execute($params);

			$template_engine = get_template_engine();
			echo $template_engine->render('bedanktPagina');
			exit;
		} else {
			$errors['email'] = 'Dit account bestaat al!';

		}

		$template_engine = get_template_engine();
		echo $template_engine->render('bedanktPagina', ['errors' => $errors]);
	}
	// public function login()
	// {

	// 	$result = validatelogin($_POST);

	// 	if (userNotRegistered($result['data']['email'])) {
	// 		$result['errors']['email'] = 'Uw email is niet bekend!';
	// 	} else {
	// 		$user = getUsersByEmail($result['data']['email']);
	// 		if (password_verify($result['data']['wachtwoord'], $user['wachtwoord'])) {

	// 			$_SESSION['user_id'] = $user['id'];

	// 			redirect(url('ingelogd'));
	// 		} else {
	// 			$result['errors']['wachtwoord'] = 'Wachtwoord is niet correct!';
	// 		}
	// 	}

	// 	$template_engine = get_template_engine();
	// 	echo $template_engine->render('AanmeldPagina', ['errors' => $result['errors']]);


	public function bevestigenEmailCode($code)
	{

		// eerst de $code gaan lezen 

		// gebruikers ophalen bij die $code
		$user = getUsersByCode($code);
		if ($user === false) {
			echo "Onbekende gebruikers of a bevestigd?";
			exit;
		}
		//gebruiker activereet $code een maakt ie leeg in de db (NULL)
		confirmAccount($code);
		$message = "Bedankt je account is nu bevestigd en je kunt INLOGGEN.";
		echo "<script type='text/javascript'>alert('$message');</script>";
		$template_engine = get_template_engine();
		echo $template_engine->render('AanmeldPagina');

		//bevestigings 

	}

	public function login()
	{

		$result = validatelogin($_POST);

		if (userNotRegistered($result['data']['email'])) {


			$result['errors']['email'] = 'Deze gebruikers is niet bekend';
		} else {
			$user = getUsersByEmail($result['data']['email']);
		}
		if (is_null($user['code'])) {


			if (password_verify($result['data']['wachtwoord'], $user['wachtwoord'])) { }
		}
	}


// Hulp vragen page
	// public function hulpVragen(){
				// $_SESSION['user_id'] = $user['id'];

		// 		redirect(url('ingelogd'));
		// 	} else {
		// 		$result['errors']['wachtwoord'] = 'wachtwoord is niet cottect';
		// 	}
		//  else {
		// 	$result['errors']['email'] = 'Dit account is nog niet actief!';
		// }



		// $template_engine = get_template_engine();
		// echo $template_engine->render('AanmeldPagina', ['errors' => $result['errors']]);

		// echo 'hallo';
	// }
	public function ingelogd()
	{
		$template_engine = get_template_engine();
		echo $template_engine->render('gebruikersPagina');
	}
	public function loguit()
	{
		session_destroy();
		$template_engine = get_template_engine();
		echo $template_engine->render('AanmeldPagina');
	}


	// Hulp vragen page
	public function hulpVragen()
	{
		isLoggedIn();

		$userData = getUserData();
		$template_engine = get_template_engine();
		echo $template_engine->render('hulp', ['userData' => $userData]);
	}

	public function details()
	{

		$details = alleDetails();

		$template_engine = get_template_engine();
		echo $template_engine->render('details', ['AlleDetails' => $details]);
	}

	public function detailsContact()
	{
		$id = $_POST['hiddenId'];
		$naam = $_POST['naam'];
		$email = $_POST['email'];
		$bericht = $_POST['bericht'];

		$connection = dbConnect();
		$sql = 'SELECT * 
    		FROM `gebruikers`
    		INNER JOIN `posts` 
    		ON `posts`.`gebruiker_id` = `gebruikers`.`id`
			WHERE `posts`.`id` = :id';
		$statement = $connection->prepare($sql);
		$idQuery = [
			'id' => $id
		];
		$statement->execute($idQuery);

		$data = $statement->fetch();

		$mailer = getSwiftMailer();

		$message = createEmailMessage($data['email'], $naam . ' wilt u helpen!', $naam, '29035@ma-web.nl');
		
		$message->setBody('<html>' .
		' <body> ' .
		' <p> U kunt niet reagen op deze email, die wordt niet gelezen.</p>' .
		' <p> Contact opnemen met degene die u wilt helpen? Neem contact op met: ' . '<b>' . $email . '</b>' .
		' <p> Zijn/Haar bericht was: ' . $bericht . '</p>' .
		' <p> Email van ' . '<b>' . $naam . '</b>' . ' is ' . '<b>' . $email . '</b>' .
		' </body> ' .
		' </html>',
		'text/html' );

		$aantalVerstuurd = $mailer->send($message);
		
		$bedanktUrl = url("bedanktContact");
		redirect($bedanktUrl);
	}

	public function bevestigenEmail()
	{

		$mailer = getSwiftMailer();
		$connection = dbConnect();
		$email      = filter_var($_POST['email']);
		$sql =  'SELECT * FROM `gebruikers` WHERE `email`= :email';
		$statement = $connection->prepare($sql);
		$message = createEmailMessage($email , 'dit is een test email', 'Duneya', '29269@ma-web.nl');
		$template_engine = get_template_engine();
		echo $template_engine->render('email', ['message' => null]);	


	}
	public function viewsEmail()
	{
		$mailer = getSwiftMailer();
		$connection = dbConnect();
		$email      = filter_var($_POST['email']);
		$sql =  'SELECT * FROM `gebruikers` WHERE `email`= :email';
		$statement = $connection->prepare($sql);

		$statement->execute(['email' => $email]);
		$message = createEmailMessage($email, 'dit is een test email', 'Duneya', '29269@ma-web.nl');
		$template_engine = get_template_engine();
		$html =  $template_engine->render('email', ['message' => $message]);
		$aantal_verstuurd = $mailer->send($message);
		$message->setBody($html, 'text/html');
		$template_engine = get_template_engine();
		echo $template_engine->render('bedanktPagina');	
	}

	public function infoWijzigen()
	{
		$connection = dbConnect();

		$id = (int) $_POST['id'];
		$email = $_POST['email'];
		$voornaam  = $_POST['voornaam'];
		$achternaam = $_POST['achternaam'];
		$plaats = $_POST['plaats'];
		$birthday = $_POST['birthday'];
		$myfile = $_POST['myfile'];

		$statement = "SELECT id, email, voornaam, achternaam, plaats, birthday, myfile FROM `gebruikers`";

		$sql = 'UPDATE `gebruikers` SET
            `email` = :email,
            `voornaam` = :voornaam,
            `achternaam` = :achternaam,
            `plaats` = :plaats,
            `birthday` = :birthday,
			`myfile` = :myfile,
			WHERE  `id` = :id ';
			
		$gegevens = [
			'id' => $id,
			'email' => $email,
			'voornaam' => $voornaam,
			'achternaam' => $achternaam,
			'plaats' => $plaats,
			'birthday' => $birthday,
			'myfile' => $myfile
		];

		
		$statement = $connection->prepare($sql);

		$statement->execute($gegevens);
	}

	public function adminPage()
	{

		$connection = dbConnect();
		$sql = 'SELECT * FROM `gebruikers` WHERE `id` = :id';
		$statement  = $connection->prepare($sql);

		$params = [
			'id' => 1
		];

		$statement->execute($params);
		$data = $statement->fetch();

		if(isAdmin($data));

		$template_engine = get_template_engine();
		echo $template_engine->render('adminPage');
	}
}

	

	
?>

