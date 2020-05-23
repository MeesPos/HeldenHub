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
    <div class="content-wrapper">
        <div class="over-hulp">
            <i class="fas fa-question-circle"></i>
            <h2 class="over-text">OVER</h2>
        </div>
        
        <div class="post-titel">
            <h1 class="hulp-h1">Mijn vraag om hulp</h1>
        </div>

        <div class="mijn-post">
            <div class="mijn-post-user">
                <img src=" <?php echo site_url('img/vrouw-headshot.jpg') ?>" alt="Profielfoto van persoon die post" class="hulp-profielfoto">
                <p class="hulp-naam">Voornaam achternaam</p>
                <p class="hulp-woonplaats">Amsterdam</p>
            </div>
            <div class="mijn-post-punten">
                <i class="fas fa-coins"></i>
                <p class="punt-hoeveelheid">1</p>
            </div>
            

        </div>
    </div> 
    
</body>
</html>