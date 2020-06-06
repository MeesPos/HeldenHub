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

		$cardData = getCardData();
		
		// echo print_r($cardData);
		foreach ((array)$cardData as $row) {
			echo $row;
		}

		$template_engine = get_template_engine();
		echo $template_engine->render('overview', [	'cards' => $cardData ]);
	}


	
}
?>
   

