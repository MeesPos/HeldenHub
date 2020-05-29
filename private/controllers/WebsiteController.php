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

	public function aanmelden(){

        $template_engine = get_template_engine();
        echo $template_engine->render('AanmeldPagina');
        
	}
	
	public function hulpVragen(){

        $template_engine = get_template_engine();
        echo $template_engine->render('hulp');
	}
	
	public function details(){

		$details = alleDetails();

        $template_engine = get_template_engine();
        echo $template_engine->render( 'details', [ 'AlleDetails' => $details ] );
	}
	
	public function detailscontact() {

		$detailsContact = alleDetails();

		$template_engine = get_template_engine();
        echo $template_engine->render( 'contactformulier', [ 'AlleDetails' => $detailsContact ] );
	}

}