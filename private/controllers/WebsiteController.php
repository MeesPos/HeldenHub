<?php

namespace Website\Controllers;

/**
 * Class HomeController
 *
 * Deze handelt de logica van de homepage af
 * Haalt gegevens uit de "model" laag van de website (de gegevens)
 * Geeft de gegevens aan de "view" laag (HTML template) om weer te geven
 *
 */
class WebsiteController {

	public function home() {

		$template_engine = get_template_engine();
		echo $template_engine->render('homepage');

	}

	public function aanmeldenIndex(){

        $template_engine = get_template_engine();
        echo $template_engine->render('AanmeldPagina');
        
	}
	
	public function hulpVragen(){
		isLoggedIn();
		$userData = getUserData();
		

        $template_engine = get_template_engine();
        echo $template_engine->render('hulp', ['userData' => $userData]);
    }

}