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
}
