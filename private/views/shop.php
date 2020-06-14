<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hulp vragen</title>
    <link rel="stylesheet" href="<?php echo site_url('/css/style.css') ?>" media="all">
    <script src="https://kit.fontawesome.com/1eb7c10cba.js" crossorigin="anonymous"></script>

</head>
<!-- Body wordt geopend in nav.php -->
<?php include '../private/includes/nav.php' ?>
<div class="shop-page">
    <div class="shop-user">
        <div class="credits">
            <i class="fas fa-credits"></i>
            <p class="shop-user-punten"><!-- TODO Punt hoeveelheid --></p> 
        </div>
        <div class="user">
            <!-- TODO image source -->
            <img src="#" alt="profielfoto" class="shop-user-image">
            <p class="shop-user-name"><!-- TODO user naam --></p>
            <p><!-- TODO user titel --></p>
        </div>
    </div>
    <div class="shop-items">
        <div class="titels">
            <!-- TODO foreach -->
            <div class="titel-item">
                <p class="titel-item-titel"><!-- TODO titel --></p>
                <div class="item-cost">
                    <i class="fas fa-credits"></i>
                    <p class="item-cost-amount"><!-- TODO amount --></p>
                </div>
                <button class="item-buy-button"><!-- TODO check if bought --></button>
            </div>
        </div>
        <div class="kaders">
            <!-- TODO foreach -->
            <div class="kader-item">           
                <i class="fas fa-user" style="border: <?php // TODO border item inhoud ?>"></i>
                <div class="item-cost">
                    <i class="fas fa-credits"></i>
                    <p class="item-cost-amount"><!-- TODO amount --></p>
                </div>
                <button class="item-buy-button"><!-- TODO check if bought --></button>
            </div>
        </div>
        <div class="kleurtjes">
            <!-- TODO foreach -->
            <div class="kleur-item">
                <p class="titel-item-kleur" style="color: <?php // TODO kleur item inhoud ?> "><!-- TODO username --></p>
                <div class="item-cost">
                    <i class="fas fa-credits"></i>
                    <p class="item-cost-amount"><!-- TODO amount --></p>
                </div>
                <button class="item-buy-button"><!-- TODO check if bought --></button>
            </div>

        </div>
        <div class="overig">
            <!-- TODO foreach -->
            <div class="overig-item">
            <div class="kleur-item">
                <p class="titel-item-overig" ?> "><!-- TODO item naam --></p>
                <div class="item-cost">
                    <i class="fas fa-credits"></i>
                    <p class="item-cost-amount"><!-- TODO amount --></p>
                </div>
                <button class="item-buy-button"><!-- TODO check if bought --></button>
            </div>
            </div>
        </div>
    </div>
</div>

</body>

</html>