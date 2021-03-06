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
class SearchController
{
    public function search() {
        $page = 1;
        $zoekterm = $_POST['zoekterm'];
        $zoeksoort = $_POST['zoek'];
        $cardData = getSearchCardData($page, 5, $zoekterm, $zoeksoort);
        $api_data = krijgCoronaData();

		$template_engine = get_template_engine();
		echo $template_engine->render('search', [	'cards' => $cardData, 'api_summary' => $api_data ]);
    }
    public function searchPagination($page) {
        $zoekterm = $_POST['zoekterm'];
        $zoeksoort = $_POST['zoek'];
        $cardData = getSearchCardData($page, 5, $zoekterm, $zoeksoort);
        $api_data = krijgCoronaData();
        
        

		

        $template_engine = get_template_engine();
		echo $template_engine->render('search', [	'cards' => $cardData, 'api_summary' => $api_data ]);
	}
    
        
}
