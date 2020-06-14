<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shop</title>
    <link rel="stylesheet" href="<?php echo site_url('/css/style.css') ?>" media="all">
    <script src="https://kit.fontawesome.com/a82e000026.js"></script>
</head>
<!-- Body wordt geopend in nav.php -->
<?php include '../private/includes/nav.php' ?>
<?php $items = displayAllItems();?>
<div class="shop-page">
    <div class="shop-user">
        <div class="credits">   
            <p class="coins"><i class="fas fa-coins"></i> <?php echo $user['credits'] ?></p>
        </div>
        <div class="user">
            <img src="<?php echo site_url() ?>uploads/<?php echo $user['myfile']; ?>" alt="profielfoto" class="shop-user-image">
            <p class="shop-user-name <?php if (empty($items['kleurItem']['item_inhoud']) ) { echo "geen-item";  } else {echo $items['kleurItem']['item_inhoud'];  } ?>"><?php echo ucfirst($user['voornaam']) . " " . ucfirst($user['achternaam']) ?></p>
            <p class="user-title ">
                <?php $items['titelItem']['item_inhoud']?> 
            </p>
        </div>
    </div>
    <div class="shop-items">
        <div class="titels">
            <h2 class="categorie">Titels</h2>
            <?php foreach ($titels as $item) { ?>
                <div class="titel-item">
                    <p class="titel-item-titel"><?php echo $item['inhoud'] ?></p>
                    <div class="item-cost">
                        <p class="coins"><i class="fas fa-coins"></i> <span class="item-cost-amount"><?php echo $item['prijs'] ?></p>
                    </div>
                    <?php
                    if ( isItemOwned($item['id']) == true ) {
                        // If item owned, see if it is active or not and give choice to activate it
                        if (isItemActive($item['id']) == true) {
                            // If active, show that it is active
                        ?>    <button class="item-buy-button" style="background-color: purple;">Actief</button> <?php
                        } else {
                            // if not active, make active
                           ?> <a href="<?php echo url('actief') . $item['id'] ?>"><button class="item-buy-button" >Zet actief</button></a> <?php

                        }
                    } else {
                        // If not owned, give chance to be bought
                        if (enoughCredits($item['prijs'], $user['credits'])) { ?>
                        
                        <!-- If enough credits, able to buy -->
                        <a href="<?php echo url('kopen') . $item['id'] ?>"><button class="item-buy-button" style="background-color: green;">Koop nu</button></a>

                    <?php } else { ?>

                        <button class="item-buy-button" style="background-color: red;">Niet mogelijk</button>
                    <?php }
                    ?>

                    <div class="lijnonder"></div>
                </div>
            <?php } } ?>
        </div>
        <div class="kaders">
            <h2 class="categorie">Kaders</h2>
            <?php foreach ($kaders as $item) { ?>
                <div class="kader-item">
                    <div class="titel-item-titel kader">
                        <i class="fas fa-user" style="border: <?php echo $item['inhoud'] ?>"></i>
                    </div>
                    <div class="item-cost">
                        <p class="coins"><i class="fas fa-coins"></i> <?php echo $item['prijs'] ?></p>
                    </div>
                    <?php
                    if ( isItemOwned($item['id']) == true ) {
                        // If item owned, see if it is active or not and give choice to activate it
                        if (isItemActive($item['id']) == true) {
                            // If active, show that it is active
                        ?>    <button class="item-buy-button" style="background-color: purple;">Actief</button> <?php
                        } else {
                            // if not active, make active
                           ?> <a href="<?php echo url('actief') . $item['id'] ?>"><button class="item-buy-button" >Zet actief</button></a> <?php

                        }
                    } else {
                        // If not owned, give chance to be bought
                        if (enoughCredits($item['prijs'], $user['credits'])) { ?>
                        
                        <!-- If enough credits, able to buy -->
                        <a href="<?php echo url('kopen') . $item['id'] ?>"><button class="item-buy-button" style="background-color: green;">Koop nu</button></a>


                    <?php } else { ?>

                        <button class="item-buy-button" style="background-color: red;">Niet mogelijk</button>
                    <?php }
                    ?>

                    
                    <div class="lijnonder"></div>

                </div>
            <?php } } ?>
        </div>
        <div class="kleurtjes">
            <h2 class="categorie">Kleuren</h2>
            <?php foreach ($kleur as $item) { ?>
                <div class="kleur-item">
                    <p class="titel-item-titel" style="color: <?php echo $item['inhoud'] ?> "><?php echo ucfirst($user['voornaam']) ?></p>
                    <div class="item-cost">
                        <p class="coins"><i class="fas fa-coins"></i> <?php echo $item['prijs'] ?></p>
                    </div>
                    <?php
                    if ( isItemOwned($item['id']) == true ) {
                        // If item owned, see if it is active or not and give choice to activate it
                        if (isItemActive($item['id']) == true) {
                            // If active, show that it is active
                        ?>    <button class="item-buy-button" style="background-color: purple;">Actief</button> <?php
                        } else {
                            // if not active, make active
                           ?> <a href="<?php echo url('actief') . $item['id'] ?>"><button class="item-buy-button" >Zet actief</button></a> <?php

                        }
                    } else {
                        // If not owned, give chance to be bought
                        if (enoughCredits($item['prijs'], $user['credits'])) { ?>
                        
                        <!-- If enough credits, able to buy -->
                        <a href="<?php echo url('kopen') . $item['id'] ?>"><button class="item-buy-button" style="background-color: green;">Koop nu</button></a>

                    <?php } else { ?>

                        <button class="item-buy-button" style="background-color: red;">Niet mogelijk</button>
                    <?php }
                    ?>
                    <div class="lijnonder"></div>
                </div>
            <?php } }?>
        </div>
        <div class="overig">
            <h2 class="categorie">Overig</h2>
            <?php foreach ($overig as $item) { ?>
                <div class="overig-item">
                    <div class="kleur-item">
                        <p class="titel-item-titel" ?><?php echo $item['inhoud'] ?></p>
                        <div class="item-cost">
                            <p class="coins"><i class="fas fa-coins"></i> <?php echo $item['prijs'] ?></p>
                        </div>
                        <?php
                    if ( isItemOwned($item['id']) == true ) {
                        // If item owned, see if it is active or not and give choice to activate it
                        if (isItemActive($item['id']) == true) {
                            // If active, show that it is active
                        ?>    <button class="item-buy-button" style="background-color: purple;">Actief</button> <?php
                        } else {
                            // if not active, make active
                           ?> <a href="<?php echo url('actief') . $item['id'] ?>"><button class="item-buy-button" >Zet actief</button></a> <?php

                        }
                    } else {
                        // If not owned, give chance to be bought
                        if (enoughCredits($item['prijs'], $user['credits'])) { ?>
                        
                        <!-- If enough credits, able to buy -->
                        <a href="<?php echo url('kopen') . $item['id'] ?>"><button class="item-buy-button" style="background-color: green;">Koop nu</button></a>

                    <?php } else { ?>


                        <button class="item-buy-button" style="background-color: red;">Niet mogelijk</button>
                    <?php }
                    ?>

                       
                        <div class="lijnonder"></div>

                    </div>
                </div>
            <?php } }?>
        </div>
    </div>
</div>

</body>

</html>