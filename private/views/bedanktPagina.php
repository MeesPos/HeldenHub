<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uw bericht is verzonden!</title>
    <link rel="stylesheet" href="<?php echo site_url('/css/style.css') ?>" media="all">
    <script src="https://kit.fontawesome.com/a82e000026.js"></script>
</head>

<body>
    <?php include '../private/includes/nav.php' ?>

    <section id="bedankt">
        <div class="check" style="margin-bottom: 1%;">
            <?php if (isset($errors)) { ?>
                <i class="far fa-times-circle"></i>
            <?php } else { ?>
                <i class="far fa-check-circle"></i>
            <?php } ?>
        </div>
        <div class="bedanktcontent">
            <?php if (isset($errors)) {
                foreach ($errors as $row) {
                    ?><p class="echomooi"> <?php echo $row; ?> </p> <br>
                    <a href="<?php echo url('aanmelden') ?>">
                        <button class="buttonHome">Terug naar aanmelden</button>
                    </a>
                <?php }
            } else { ?>
                <h1>U bent geregistreerd!</h1>
                <p>U kunt nu naar de overview pagina om mensen te helpen!</p>
                <a href="<?php echo url('overview') ?>">
                    <button class="buttonHome">Naar overview</button>
                </a>
            <?php } ?>
        </div>
    </section>

</body>

</html>