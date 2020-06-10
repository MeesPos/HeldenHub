<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uw bericht is verzonden!</title>
    <link rel="stylesheet" href="<?php echo site_url('/css/style.css') ?>" media="all">
    <script src="https://kit.fontawesome.com/a82e000026.js"></script>
</head>


    <?php include '../private/includes/nav.php' ?>

    <section id="bedankt">
        <div class="check">
            <i class="far fa-check-circle"></i>
        </div>
        <div class="bedanktcontent">
            <h1>Gebruiker is geband!</h1>
            <p>De gebruiker is geband, u kunt nu terug naar de Admin pagina.</p>
            <a href="<?php echo url('adminPage') ?>">
                <button class="buttonHome">Terug naar Admin pagina</button>
            </a>
        </div>
    </section>
</body>

</html>