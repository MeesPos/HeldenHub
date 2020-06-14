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
    
    public function koop($item_id)
    {
        // Get item data
        $item_info = getItemInfo($item_id);
        
        // User credits - cost
        buyItemPayment($item_info['prijs']);
        
        // Deactivate old active item
        $old_active_item = getOldActiveItem($item_info);
        
        deactivateItem($old_active_item);
        

        // Make item row in user_items (also make active item
        giveUserItem($item_id);

        // Redirect to shop page
        $redirectURL = url('shop');
        redirect($redirectURL);

    }
    public function activeer($item_id)
    {   
        // Get what type it is
        $new_item = getItemInfo($item_id);

        // Get old active item from type, userId and active
        $old_active_item = getOldActiveItem($new_item);
        
        // Update old active item
        deactivateItem($old_active_item);
        

        // Get row on user_items of to activate item
        $toActivateItem = getItemRow($new_item);
      

        // Update/Activate new item
        activateItem($toActivateItem);
     

        // Redirect to shop page
        $redirectURL = url('shop');
        redirect($redirectURL);

    }
}
