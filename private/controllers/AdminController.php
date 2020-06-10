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
class AdminController
{
    public function adminPage()
    {

        adminLoginCheck();

        $connection = dbConnect();
        $sql = 'SELECT * FROM `gebruikers` WHERE `id` = :id';
        $statement  = $connection->prepare($sql);

        $params = [
            'id' => 1
        ];

        $statement->execute($params);
        $data = $statement->fetch();

        if (isAdmin($data));

        $count = "SELECT `id` FROM gebruikers";
        $statement2 = $connection->prepare($count);
        $statement2->execute();
        $gebruikerCount = 0;
        foreach ($statement2 as $count) {
            $gebruikerCount += 1;
        }

        $count2 = "SELECT `id` FROM posts";
        $statement3 = $connection->prepare($count2);
        $statement3->execute();
        $postCount = 0;
        foreach ($statement3 as $count2) {
            $postCount += 1;
        }

        $gebruikersOphalen = "SELECT * FROM gebruikers";
        $statement4 = $connection->prepare($gebruikersOphalen);
        $statement4->execute();

        $template_engine = get_template_engine();
        echo $template_engine->render('adminPage', ['data' => $data, 'gebruikers' => $gebruikerCount, 'postCount' => $postCount, 'gebruikersOphalen' => $gebruikersOphalen]);
    }

    public function adminJson() {
        
        echo gebruikersOphalen();
        
    }

    public function adminBan() {

        $id = $_POST['invoer'];

        $connection = dbConnect();
        $deleteUser = 'DELETE FROM `gebruikers` WHERE `id` = :id ';
        $statement = $connection->prepare($deleteUser);
        $userParams = [
            'id' => $id
        ];
        $statement->execute($userParams);

        $deleteteItems = 'DELETE FROM `user_items` WHERE `gebruiker_id` = :gebruiker_id ';
        $statement2 = $connection->prepare($deleteteItems);
        $gebruikerParams = [
            'gebruiker_id' => $id
        ];
        $statement2->execute($gebruikerParams);

        $deletetePosts = 'DELETE FROM `posts` WHERE `gebruiker_id` = :gebruiker_id ';
        $statement3 = $connection->prepare($deletetePosts);
        $statement3->execute($gebruikerParams);

        $deletetePunten = 'DELETE FROM `punten` WHERE `gebruiker_id` = :gebruiker_id ';
        $statement4 = $connection->prepare($deletetePunten);
        $statement4->execute($gebruikerParams);
        
        $bedanktUrl = url("admin.gelukt");
		redirect($bedanktUrl);
    }

    public function adminGelukt() {

        $template_engine = get_template_engine();
        echo $template_engine->render('adminGelukt');

    }
}