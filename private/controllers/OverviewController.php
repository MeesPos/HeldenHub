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
class OverviewController {

	public function displayOverview() {
		$page = 1;
		$cardData = getCardData($page, 5);
		$api_data = krijgCoronaData();

		

		$template_engine = get_template_engine();
		echo $template_engine->render('overview', [	'cards' => $cardData, 'api_summary' => $api_data ]);
	}

	public function displayOverviewPages($page) {
		$cardData = getCardData($page, 5);
		$api_data = krijgCoronaData();

		

		$template_engine = get_template_engine();
		echo $template_engine->render('overview', [	'cards' => $cardData, 'api_summary' => $api_data ]);
	}


	
}
?>
   

