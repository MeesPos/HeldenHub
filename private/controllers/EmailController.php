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
class EmailController
{
    // bevestigen email
    public function bevestigenEmail()
	{

		$mailer = getSwiftMailer();
		// $connection = dbConnect();
		// $email      = filter_var($_POST['email']);
		// $sql =  'SELECT * FROM `gebruikers` WHERE `email`= :email';
		// $statement = $connection->prepare($sql);
		$message = createEmailMessage('buneya2001@gmail.com' , 'dit is een test email', 'Duneya', '29269@ma-web.nl');
		$message->setBody('dit is de inhoud van mijn test bericht');
		$aantal_verstuurd = $mailer->send($message);
		echo "Aantal = " . $aantal_verstuurd;
		
		// $template_engine = get_template_engine();
		// echo $template_engine->render('email', ['message' => null]);	


	}
	public function viewsEmail()
	{
		$mailer = getSwiftMailer();
		$connection = dbConnect();
		$email      = filter_var($_POST['email']);
		$sql =  'SELECT * FROM `gebruikers` WHERE `email`= :email';
		echo $email; exit;
		$statement = $connection->prepare($sql);
		
		$statement->execute(['email' => $email]);
		$message = createEmailMessage($email, 'dit is een test email', 'Duneya', '29269@ma-web.nl');
		
		$template_engine = get_template_engine();
		$html =  $template_engine->render('email', ['message' => $message]);
	    $mailer->send($message);
		$message->setBody($html, 'text/html');
		$template_engine = get_template_engine();
		echo $template_engine->render('bedanktPagina');	
	}
   
    public function bevestigenEmailCode($code)
	{

		// eerst de $code gaan lezen 

		// gebruikers ophalen bij die $code
		$userInfo = getUsersByCode($code);
		if (!$userInfo) {
			$message = "Onbekende gebruikers of al bevestigd?";
		    echo "<script type='text/javascript'>alert('$message');</script>";
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
}
