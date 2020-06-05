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
    <?php echo $cards['myfile']; ?>
        <?php  foreach ($cards as $data): 
            
        ?>
        <div class="ov-card">
            <div class="oranje-balk"></div>
            <div class="ov-post">
                <div class="ov-post-user">
                    <img src="<?php echo site_url('/img/vrouw-headshot.jpg') ?>" alt="Profielfoto" class="ov-profiel">
                    <section class="ov-post-user-info">
                        <p class="ov-post-naam"><?php echo $data['voornaam'] ?>Naam</p>
                        <p class="ov-post-plaats">Amsterdam</p>
                    </section>
                </div>
                <div class="ov-post-punten">
                    <i class="fas fa-coins"></i>
                    <p class="punt-hoeveelheid">1</p>
                </div>
                <div class="ov-post-info">
                    <h3 class="ov-post-info-title">Boodschappen doen</h3>
                    <p class="ov-post-info-tekst">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo necessitatibus enim eveniet ipsum rem nesciunt ipsa consequuntur nisi? Delectus aut amet fugiat facere aspernatur possimus ab quidem unde et libero.</p>
                </div>
                <div class="ov-post-knop">
                    <form action="#" method="POST" class="ov-post-form">
                        <input type="hidden" name="postId" value="1">
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