<?php

namespace Website\Controllers;

/**
 * Class LeaderbordController
 *
 * Deze handelt de logica van de homepage af
 * Haalt gegevens uit de "model" laag van de website (de gegevens)
 * Geeft de gegevens aan de "view" laag (HTML template) om weer te geven
 *
 */

class LeaderbordController {

    public function Leaderbord() {

        $punten = puntenOphalen();

        $template_engine = get_template_engine();
        echo $template_engine->render('leaderbord', [ 'puntenLeaderbord' => $punten ]);
        
    }

}