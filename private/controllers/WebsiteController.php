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
	
	public function loguit()
	{
		session_destroy();
		$template_engine = get_template_engine();
		echo $template_engine->render('homePage');
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

	
}