<?php

namespace Website\Controllers;

/**
 * Class HomeController
 *
 * Deze handelt de logica van de homepage af
 * Haalt gegevens uit de "model" laag van de website (de gegevens)
 * Geeft de gegevens aan de "view" laag (HTML template) om weer te geven
 *
 */
class WebsiteController {

	public function home() {

		$template_engine = get_template_engine();
		echo $template_engine->render('homepage');

	}

	public function aanmelden(){

        $template_engine = get_template_engine();
        echo $template_engine->render('AanmeldPagina');
	}
	public function registreer(){

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

		if($email === false){
			$errors['email'] = 'Geen geldig email ingevuld';
		}

		if (empty($wachtwoord) || strlen($wachtwoord) < 6 ){
			$errors ['wachtwoord'] = 'Geen geldig wachtwoord!';
   		}
        if (count( $errors ) === 0 ){
			// als geen error kan ie registreer
			$connection = dbConnect();
			
			$sql =  'SELECT * FROM `gebruikers` WHERE `email`= :email';
			$statement = $connection->prepare($sql);

			$statement->execute( ['email' => $email] );

			if ($statement->rowCount() == 0) {
				# opslaan ...
			$sql =  'INSERT INTO `gebruikers` ( `email`, `voornaam`, `achternaam`, `plaats`, `birthday`, `myfile`, `wachtwoord`, `herwachtwoord`) 
			VALUE (:email, :voornaam, :achternaam, :plaats, :birthday, :myfile, :wachtwoord, :herwachtwoord )';
			$statement = $connection->prepare($sql);

			$safe_wachtwoord = password_hash($wachtwoord, PASSWORD_DEFAULT);
			}
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

			$statement->execute( $params );

			echo "klaar";
			exit;
		}else{
           $errors ['email'] = 'Dit accouny bestaat al!!!!!';
		} 

		$template_engine = get_template_engine();
		echo $template_engine->render('AanmeldPagina', ['errors' => $errors]);
	}
}

