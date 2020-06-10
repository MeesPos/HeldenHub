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
class GebruikerController
{
    public function gebruikersPagina()
	{
        $page = 1;
        $cardData = getUserCardData($page, 5);
		$user_info = getUserData();
        

		$template_engine = get_template_engine();
		echo $template_engine->render('gebruikersPagina', [	'cards' => $cardData, 'user_data' => $user_info] );
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
}
