<!doctype html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Overzicht</title>
    <link rel="stylesheet" href="<?php echo site_url('css/style.css') ?>" media="all">
    <script src="https://kit.fontawesome.com/1eb7c10cba.js" crossorigin="anonymous"></script>

</head>
<!-- Body wordt geopend in nav.php -->
<?php include '../private/includes/nav.php' ?>
<div class="ov-wrapper">
    <div class="ov-wrapper-left">
        <?php  foreach ($cards['statement'] as $row):
            
        ?>
        <div class="ov-card">
            <div class="oranje-balk"></div>
            <div class="ov-post">
                <div class="ov-post-user">
                    <img src="<?php echo site_url() ?>uploads/<?php echo $row['myfile']; ?>" alt="Profielfoto" class="ov-profiel">
                    <section class="ov-post-user-info">
                        <p class="ov-post-naam"><?php echo ucfirst($row['voornaam']) . ' ' . ucfirst($row['achternaam']); ?></p>
                        <p class="ov-post-plaats"><?php 
                                                    // Making first letter of place always uppercase
                                                    echo ucfirst($row['plaats']); ?></p>
                    </section>
                </div>
                <div class="ov-post-punten">
                    <i class="fas fa-coins"></i>
                    <p class="punt-hoeveelheid">1</p>
                </div>
                <div class="ov-post-info">
                    <h3 class="ov-post-info-title"><?php echo ucfirst($row['titel']); ?></h3>
                    <p class="ov-post-info-tekst"><?php echo ucfirst($row['inhoud']); ?></p>
                </div>
                <div class="ov-post-knop">
                    <form action="<?php echo url('details') ?>" method="POST" class="ov-post-form">
                        <input type="hidden" name="postId" value="<?php echo $row['gebruiker_id'] ?>">
                        <input type="submit" name="post-detail" id="ov-form-submit" value="Details">
                    </form>
                </div>
            </div>
        </div>
        <?php  endforeach; 
        ?>
    </div>
    <div class="ov-wrapper-right">

    </div>


</div>

</body>

</html>