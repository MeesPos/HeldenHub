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

    <div class="post-titel post-vlak">
        <div class="oranje-balk"></div>
        <h1 class="hulp-h1">Mijn vraag om hulp</h1>
    </div>

        <div class="post-vlak main-post">
            <div class="oranje-balk"></div>
            <div class="mijn-post">
                <div class="mijn-post-user">
                    <img src=" <?php echo site_url() . 'uploads/' .  $userData['myfile']  ?>" alt="Profielfoto van persoon die post" class="hulp-profielfoto">
                    <section class="post-user-info">
                        <p class="hulp-naam"><?php echo ucfirst($userData['voornaam']) . ' ' . ucfirst($userData['achternaam']); ?></p>
                        <p class="hulp-woonplaats"><?php 
                                                    // Making first letter of place always uppercase
                                                    echo ucfirst($userData['plaats']); ?></p>
                    </section>
                </div>
                <div class="mijn-post-punten">
                    <i class="fas fa-coins"></i>
                    <p class="punt-hoeveelheid">1</p>
                </div>
                <div class="mijn-post-form-div">
                    <form action="<?php echo url("post-opslaan") ?>" method="post" class="mijn-post-form">
                        <input type="text" name="titel" id="post-titel" placeholder="Titel" class="post-text-input" required>
                        <input type="textarea"  name="inhoud" id="post-hulp" placeholder="Waar heeft u hulp bij nodig?" class="post-text-input" required>
                        <input type="submit" name="post-form-submit" id="post-form-submit">
                    </form>
                </div>
            </div>
            
        </div>


    </div>
</div>
    </div> 

</body>

</html>