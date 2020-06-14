<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hulp vragen</title>
    <link rel="stylesheet" href="<?php echo site_url('/css/style.css') ?>" media="all">
    <script src="https://kit.fontawesome.com/a82e000026.js"></script>
</head>
<!-- Body wordt geopend in nav.php -->
<?php include '../private/includes/nav.php' ?>
<div class="shop-page">
    <div class="shop-user">
        <div class="credits">   
            <p class="coins"><i class="fas fa-coins"></i> <?php echo $user['credits'] ?></p>
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
            <h2 class="categorie">Titels</h2>
            <?php foreach ($titels as $item) { ?>
                <div class="titel-item">
                    <p class="titel-item-titel"><?php echo $item['inhoud'] ?></p>
                    <div class="item-cost">
                        <p class="coins"><i class="fas fa-coins"></i> <span class="item-cost-amount"><?php echo $item['prijs'] ?></p>
                    </div>
                    <?php
                    if (enoughCredits($item['prijs'], $user['credits'])) { ?>
                        <a href="<?php echo url('kopen') . $item['id'] ?>"><button class="item-buy-button" style="color:<?php echo shopBuyCheck('kleur', $item['id']); ?>"><?php echo shopBuyCheck('tekst', $item['id']); ?></button></a>

                    <?php    } else { ?>
                        <button class="item-buy-button" style="color:<?php echo shopBuyCheck('kleur', $item['id']); ?>"><?php echo shopBuyCheck('tekst', $item['id']); ?></button>

                    <?php }
                    ?>

                    <div class="lijnonder"></div>
                </div>
            <?php } ?>
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
                    if (enoughCredits($item['prijs'], $user['credits'])) { ?>
                        <a href="<?php echo url('kopen') . $item['id'] ?>"><button class="item-buy-button" style="color:<?php echo shopBuyCheck('kleur', $item['id']); ?>"><?php echo shopBuyCheck('tekst', $item['id']); ?></button></a>

                    <?php    } else { ?>
                        <button class="item-buy-button" style="color:<?php echo shopBuyCheck('kleur', $item['id']); ?>"><?php echo shopBuyCheck('tekst', $item['id']); ?></button>

                    <?php } ?>
                    <div class="lijnonder"></div>
                </div>
            <?php } ?>
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
                    if (enoughCredits($item['prijs'], $user['credits'])) { ?>
                        <a href="<?php echo url('kopen') . $item['id'] ?>"><button class="item-buy-button" style="color:<?php echo shopBuyCheck('kleur', $item['id']); ?>"><?php echo shopBuyCheck('tekst', $item['id']); ?></button></a>

                    <?php    } else { ?>
                        <button class="item-buy-button" style="color:<?php echo shopBuyCheck('kleur', $item['id']); ?>"><?php echo shopBuyCheck('tekst', $item['id']); ?></button>

                    <?php }
                    ?>
                    <div class="lijnonder"></div>
                </div>
            <?php } ?>
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
                        if (enoughCredits($item['prijs'], $user['credits'])) { ?>
                            <a href="<?php echo url('kopen') . $item['id'] ?>"><button class="item-buy-button" style="color:<?php echo shopBuyCheck('kleur', $item['id']); ?>"><?php echo shopBuyCheck('tekst', $item['id']); ?></button></a>

                        <?php    } else { ?>
                            <button class="item-buy-button" style="color:<?php echo shopBuyCheck('kleur', $item['id']); ?>"><?php echo shopBuyCheck('tekst', $item['id']); ?></button>

                        <?php }
                        ?>
                        <div class="lijnonder"></div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

</body>

</html>