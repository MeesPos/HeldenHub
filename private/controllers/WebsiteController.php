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
	// Hulp vragen page
	public function hulpVragen(){
		isLoggedIn();
		$userData = getUserData();
		

        $template_engine = get_template_engine();
        echo $template_engine->render('hulp', ['userData' => $userData]);
	}
	
	public function postOpslaan(){
		savePost();
	}

	// Overzicht pagina
	public function overzicht() {

		$template_engine = get_template_engine();
		echo $template_engine->render('overzicht');
	}

}