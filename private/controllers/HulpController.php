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
class HulpController
{
    // Hulp vragen page
    public function hulpVragen()
    {
        adminLoginCheck('aanmelden');

        $userData = getUserData();
        $template_engine = get_template_engine();
        echo $template_engine->render('hulp', ['userData' => $userData]);
    }

    public function postOpslaan() {
        savePost();
    }
        
}
