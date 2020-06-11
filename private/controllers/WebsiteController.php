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

	
	public function loguit()
	{
		session_destroy();

		$homeUrl = url("home");
		redirect($homeUrl);
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

	
}