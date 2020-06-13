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
	public function ingelogd()
	{
		$template_engine = get_template_engine();
		echo $template_engine->render('gebruikersPagina');
	}
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

	

	public function update()
	{
		$id = (int) $_SESSION['user_id'];
		$email = $_POST['email'];
		$voornaam  = $_POST['voornaam'];
		$achternaam = $_POST['achternaam'];
		$plaats = $_POST['plaats'];
		$connection = dbConnect();
	
		$sql = 'UPDATE `gebruikers` SET
            `email` = :email,
            `voornaam` = :voornaam,
            `achternaam` = :achternaam,
            `plaats` = :plaats
          

			WHERE  `id` = :id ';
		
		$statement = $connection->prepare($sql);
		$gegevens = [
			'id' => $id,
			'email' => $email,
			'voornaam' => $voornaam,
			'achternaam' => $achternaam,
			'plaats' => $plaats
		];
		$statement->execute($gegevens);
       redirect(url('ingelogd'));
	}
	public function infoWijzigen()
	{
		$connection = dbConnect();
		$id = (int)$_SESSION['user_id'];
		$errors = [];
        $newFileName = verwerkFotoUpload($_FILES, $errors);
        $result = validateRegistrationForm($_POST, $newFileName, $errors);
		if (count($result['errors']) === 0) {
		
		$sql = 'SELECT * FROM `gebruikers` WHERE `id` = :id';
		$statement = $connection->prepare($sql);
		$parameters =[
			'id' => $id
		 ];
		$statement->execute($parameters);
		$userData = $statement->fetch();
	}
		$template_engine = get_template_engine();
		echo $template_engine->render('gebruikersPagina', ['userData'=>$userData]);
		
	}
}

