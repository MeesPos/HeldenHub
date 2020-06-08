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
            <h1>Uw bericht is verzonden!</h1>
            <p>Uw bericht is verzonden, nu kunnen jullie samen bespreken wat je kan betekenen voor diegene.</p>
            <a href="<?php echo url('home') ?>">
                <button class="buttonHome">Terug naar Home</button>
            </a>
        </div>
    </section>
</body>

</html>