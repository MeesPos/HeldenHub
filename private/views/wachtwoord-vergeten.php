<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wachtwoord Reseten</title>
    <link rel="stylesheet" href="<?php echo site_url('css/style.css') ?>" media="all">
</head>

<body>
    <?php include '../private/includes/nav.php' ?>

    <section id="inloggen">

        <h1><strong>WACHTWOORD VERGETEN</strong></h1>
        <p>Weet u uw wachtwoord niet meer? Vraag hier uw nieuwe wachtwoord aan.</p>

        <?php if (!$mail_sent) : ?>
            <form action="<?php url('wachtwoord.vergeten') ?>" method="POST">
                <input type="email" name="email" value="<?php echo input('email') ?>" class="WVEmail" placeholder="E-mail adres"><br>
                <?php if (isset($errors['email'])) : ?>
                    <span class="errors"> <?php echo $errors['email'] ?></span>
                <?php endif; ?>

                <button type="submit" class="WVReset">Reset wachtwoord</button>
            </form>

        <?php else : ?>
            <h4>De mail is vestuurd!</h4>
            <p>Bekijk uw e-mail voor de reset link! Niet vestuurd? Probeer later opnieuw!</p>
            <strong>Bekijk ook je SPAM folder!</strong>
        <?php endif; ?>

    </section>
</body>

</html>