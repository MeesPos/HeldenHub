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
			$statement->execute( $params );
			echo $email;
			exit;
		}else{
           $errors ['email'] = 'Dit accouny bestaat al!!!!!';
		}

		$template_engine = get_template_engine();
		echo $template_engine->render('AanmeldPagina', ['errors' => $errors]);
	}
	 public function login(){

	$result = validatelogin($_POST);

   if (userNotRegistered($result['data']['email'])){
	   $result['errors']['email'] = 'Deze gebruikers is niet bekend';
   } else{
	   $user =getUsersByEmail ($result ['data']['email']);
	   if (password_verify($result['data']['wachtwoord'], $user['wachtwoord'])){

		  $_SESSION['user_id'] = $user['id'];

		  redirect(url('ingelogd'));
	   }
	   else{
		   $result['errors']['wachtwoord'] = 'wachtwoord is niet cottect';
	   }
   }

	$template_engine = get_template_engine();
		echo $template_engine->render('AanmeldPagina', ['errors' => $result['errors']]);

	// echo 'hallo';
}
 public function ingelogd(){
	$template_engine = get_template_engine();
	echo $template_engine->render('gebruikersPagina');

 }
 public function loguit(){
	session_destroy();
	$template_engine = get_template_engine();
	echo $template_engine->render('AanmeldPagina');
 }
}

// Hulp vragen page
	public function hulpVragen(){
		isLoggedIn();
		$userData = getUserData();
		

        $template_engine = get_template_engine();
        echo $template_engine->render('hulp');
	}
	
	public function details(){

		$details = alleDetails();

        $template_engine = get_template_engine();
        echo $template_engine->render( 'details', [ 'AlleDetails' => $details ] );
	}
	
	public function detailscontact() {

		$detailsContact = alleDetails();

		$template_engine = get_template_engine();
		echo $template_engine->render( 'contactformulier', [ 'AlleDetails' => $detailsContact ] );
		
		if (isset($_POST['email'])) {

			// EDIT THE 2 LINES BELOW AS REQUIRED
			$email_to = "meespostma_@hotmail.com";
			$email_subject = "Iemand wilt u helpen!";
		
			function died($error)
			{
				// your error code can go here
				echo "Er is iets fout gegaan met het formulier die u heeft ingevuld.";
				echo "Deze errors zijn we tegengekomen:<br /><br />";
				echo $error . "<br /><br />";
				echo "Ga astublieft terug om de problemen optelossen..<br /><br />";
				die();
			}
		
		
			// validation expected data exists
			if (
				!isset($_POST['naam']) ||
				!isset($_POST['email']) ||
				!isset($_POST['bericht'])
			) {
				died('Er is iets fout gegaan met het formulier die u heeft ingevuld.');
			}
		
		
		
			$name = $_POST['naam']; // required
			$email = $_POST['email']; // required
			$comments = $_POST['bericht']; // required
		
			$error_message = "";
			$email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
		
			if (!preg_match($email_exp, $email)) {
				$error_message .= 'De email lijkt niet goed.<br />';
			}
		
			$string_exp = "/^[A-Za-z .'-]+$/";
		
			if (!preg_match($string_exp, $name)) {
				$error_message .= 'De naam lijkt niet goed.<br />';
			}
		
			if (strlen($comments) < 2) {
				$error_message .= 'Uw bericht lijkt niet goed.<br />';
			}
		
			if (strlen($error_message) > 0) {
				died($error_message);
			}
		
			$email_message = "Iemand wilt u helpen, zijn bericht staat hieronder:\n\n";
		
		
			function clean_string($string)
			{
				$bad = array("content-type", "bcc:", "to:", "cc:", "href");
				return str_replace($bad, "", $string);
			}
		
		
		
			$email_message .= "Naam: " . clean_string($name) . "\n";
			$email_message .= "Email: " . clean_string($email) . "\n";
			$email_message .= "Bericht: " . clean_string($comments) . "\n";
		
			// create email headers
			$headers = 'From: ' . $email . "\r\n" .
				'Reply-To: ' . $email . "\r\n" .
				'X-Mailer: PHP/' . phpversion();
			@mail($email_to, $email_subject, $email_message, $headers);
		?>
			<h5>Uw bericht is verstuurd. Bedankt dat u wilt helpen!</h5>
		<?php
		
		}
		// header('Location: details');
		?>
		<?php
	}

}
        echo $template_engine->render('hulp', ['userData' => $userData]);
	}
	
	public function postOpslaan(){
		savePost();
	}

	// Overzicht pagina
	public function overzicht() {

		$template_engine = get_template_engine();
		echo $template_engine->render('overzicht');

?>
   

