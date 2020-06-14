<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shop</title>
    <link rel="stylesheet" href="<?php echo site_url('/css/style.css') ?>" media="all">
    <script src="https://kit.fontawesome.com/1eb7c10cba.js" crossorigin="anonymous"></script>

</head>
<!-- Body wordt geopend in nav.php -->
<?php include '../private/includes/nav.php' ?>
<div class="shop-page">
    <div class="shop-user">
        <div class="credits">
            <i class="fas fa-credits"></i>
            <p class="shop-user-punten"><?php echo $user['credits'] ?></p>
        </div>
        <div class="user">
            <img src="<?php echo site_url() ?>uploads/<?php echo $user['myfile']; ?>" alt="profielfoto" class="shop-user-image">
            <p class="shop-user-name"><?php echo ucfirst($user['voornaam']) . " " . ucfirst($user['achternaam']) ?></p>
            <p class="user-title">
                <!-- TODO user titel -->
            </p>
        </div>
    </div>
    <div class="shop-items">
        <div class="titels">
            <?php foreach ($titels as $item) { ?>
                <div class="titel-item">
                    <p class="titel-item-titel"><?php echo $item['inhoud'] ?></p>
                    <div class="item-cost">
                        <i class="fas fa-credits"></i>
                        <p class="item-cost-amount"><?php echo $item['prijs'] ?></p>
                    </div>
                    <?php
                    if (enoughCredits($item['prijs'], $user['credits'])) { ?>
                        <a href="<?php echo url('kopen') . $item['id'] ?>"><button class="item-buy-button" style="color:<?php echo shopBuyCheck('kleur', $item['id']); ?>"><?php echo shopBuyCheck('tekst', $item['id']); ?></button></a>

                    <?php    } else { ?>
                        <button class="item-buy-button" style="color:<?php echo shopBuyCheck('kleur', $item['id']); ?>"><?php echo shopBuyCheck('tekst', $item['id']); ?></button>

                    <?php }
                    ?>
                </div>
            <?php } ?>
        </div>
        <div class="kaders">
            <?php foreach ($kaders as $item) { ?>
                <div class="kader-item">
                    <i class="fas fa-user" style="border: <?php echo $item['inhoud'] ?>"></i>
                    <div class="item-cost">
                        <i class="fas fa-credits"></i>
                        <p class="item-cost-amount"><?php echo $item['prijs'] ?></p>
                    </div>
                    <?php
<<<<<<< HEAD
                    if (enoughCredits($item['prijs'], $user['credits'])) { ?>
                        <a href="<?php echo url('kopen') . $item['id'] ?>"><button class="item-buy-button" style="color:<?php echo shopBuyCheck('kleur', $item['id']); ?>"><?php echo shopBuyCheck('tekst', $item['id']); ?></button></a>

                    <?php    } else { ?>
                        <button class="item-buy-button" style="color:<?php echo shopBuyCheck('kleur', $item['id']); ?>"><?php echo shopBuyCheck('tekst', $item['id']); ?></button>

                    <?php } ?>
                    <div class="lijnonder"></div>
=======
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
>>>>>>> parent of f59714e... Merge branch 'master' into PaniekMasterFix-Cornell
                </div>
            <?php } ?>
        </div>
        <div class="kleurtjes">
            <?php foreach ($kleur as $item) { ?>
                <div class="kleur-item">
                    <p class="titel-item-kleur" style="color: <?php echo $item['inhoud'] ?> "><?php echo ucfirst($user['voornaam']) ?></p>
                    <div class="item-cost">
                        <i class="fas fa-credits"></i>
                        <p class="item-cost-amount"><?php echo $item['prijs'] ?></p>
                    </div>
                    <?php
                    if (enoughCredits($item['prijs'], $user['credits'])) { ?>
                        <a href="<?php echo url('kopen') . $item['id'] ?>"><button class="item-buy-button" style="color:<?php echo shopBuyCheck('kleur', $item['id']); ?>"><?php echo shopBuyCheck('tekst', $item['id']); ?></button></a>

                    <?php    } else { ?>
                        <button class="item-buy-button" style="color:<?php echo shopBuyCheck('kleur', $item['id']); ?>"><?php echo shopBuyCheck('tekst', $item['id']); ?></button>

                    <?php }
                    ?>
                </div>
            <?php } ?>
        </div>
        <div class="overig">
            <?php foreach ($overig as $item) { ?>
                <div class="overig-item">
                    <div class="kleur-item">
                        <p class="titel-item-overig" ?><?php echo $item['inhoud'] ?></p>
                        <div class="item-cost">
                            <i class="fas fa-credits"></i>
                            <p class="item-cost-amount"><?php echo $item['prijs'] ?></p>
                        </div>
                        <?php
                        if (enoughCredits($item['prijs'], $user['credits'])) { ?>
                            <a href="<?php echo url('kopen') . $item['id'] ?>"><button class="item-buy-button" style="color:<?php echo shopBuyCheck('kleur', $item['id']); ?>"><?php echo shopBuyCheck('tekst', $item['id']); ?></button></a>

<<<<<<< HEAD
                        <?php    } else { ?>
                            <button class="item-buy-button" style="color:<?php echo shopBuyCheck('kleur', $item['id']); ?>"><?php echo shopBuyCheck('tekst', $item['id']); ?></button>

                        <?php }
                        ?>
                        <div class="lijnonder"></div>
=======
                        <button class="item-buy-button" style="background-color: red;">Niet mogelijk</button>
                    <?php }
                    ?>
>>>>>>> parent of f59714e... Merge branch 'master' into PaniekMasterFix-Cornell
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

</body>

</html>