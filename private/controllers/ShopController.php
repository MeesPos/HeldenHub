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
class ShopController
{
    // Hulp vragen page
    public function shop()
    {
        // Get user info
        $user_data = getUserData();

        // Get items
        $titels = getItems('titel');
        $kaders = getItems('kader');
        $kleur  = getItems('kleur');
        $overig = getItems('overig');
        
        $template_engine = get_template_engine();
        echo $template_engine->render('shop', ['user' => $user_data, 'titels' => $titels, 'kaders' => $kaders, 'kleur' => $kleur, 'overig' => $overig ]);
    }
    
    public function kopen($item_id)
    {
        // Get item data
        $item_info = getItemInfo($item_id);
        // Check if enough credits -> if so do user credits - item cost

        // Make item row in user_items

    }
}
