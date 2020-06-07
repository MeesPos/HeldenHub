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
				$sql =  'INSERT INTO `gebruikers` ( `email`, `voornaam`, `achternaam`, `plaats`, `birthday`, `myfile`, `wachtwoord`, `herwachtwoord`)
			VALUE (:email, :voornaam, :achternaam, :plaats, :birthday, :myfile, :wachtwoord, :herwachtwoord )';
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
				'herwachtwoord' => $safe_wachtwoord
			];
			$statement->execute($params);
			echo $email;
			exit;
		} else {
			$errors['email'] = 'Dit account bestaat al!';
		}

		$template_engine = get_template_engine();
		echo $template_engine->render('AanmeldPagina', ['errors' => $errors]);
	}
	public function login()
	{

		$result = validatelogin($_POST);

		if (userNotRegistered($result['data']['email'])) {
			$result['errors']['email'] = 'Uw email is niet bekend!';
		} else {
			$user = getUsersByEmail($result['data']['email']);
			if (password_verify($result['data']['wachtwoord'], $user['wachtwoord'])) {

				$_SESSION['user_id'] = $user['id'];

				redirect(url('ingelogd'));
			} else {
				$result['errors']['wachtwoord'] = 'Wachtwoord is niet correct!';
			}
		}

		$template_engine = get_template_engine();
		echo $template_engine->render('AanmeldPagina', ['errors' => $result['errors']]);

		// echo 'hallo';
	}
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

	public function bedanktContact()
	{

		$template_engine = get_template_engine();
		echo $template_engine->render('bedanktContact');
	}

	public function postOpslaan()
	{
		savePost();
	}

	// Overzicht pagina
	public function overzicht()
	{

		$template_engine = get_template_engine();
		echo $template_engine->render('overzicht');
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

		$message->setBody(
			'<html>' .
				' <body> ' .
				' <p> U kunt niet reagen op deze email, die wordt niet gelezen.</p>' .
				' <p> Contact opnemen met degene die u wilt helpen? Neem contact op met: ' . '<b>' . $email . '</b>' .
				' <p> Zijn/Haar bericht was: ' . $bericht . '</p>' .
				' <p> Email van ' . '<b>' . $naam . '</b>' . ' is ' . '<b>' . $email . '</b>' .
				' </body> ' .
				' </html>',
			'text/html'
		);

		$aantalVerstuurd = $mailer->send($message);

		$bedanktUrl = url("bedanktContact");
		redirect($bedanktUrl);
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
