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


