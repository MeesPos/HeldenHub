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

    <div class="registratie-bedankt-content">
        <?php if (isset($errors)) {
            foreach ($errors as $row) {
                echo $row; ?>
                <a href="<?php echo url('aanmelden') ?>"><button>Terug naar aanmelden</button></a>
                <?php
            };
        } else {
            echo "Bedankt voor het registreren!, u krijgt binnen 5 secondeer Email voor
            bevestigen.
           Bedankt" ?>
            <a href="<?php echo url('overview'); ?>"><button>Naar overview</button></a>
        <?php
        }
        ?>

    </div>
</body>

</html>