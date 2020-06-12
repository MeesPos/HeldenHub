<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo site_url('css/style.css') ?>" media="all">
</head>

<body>

    <?php include '../private/includes/nav.php' ?>

    <section id="inloggen">

        <h1><strong>WACHTWOORD RESETTEN</strong></h1>
        <p>Vul hier uw nieuwe wachtwoord in!</p>
        <form action="<?php url('wachtwoord.reset', ['reset_code' => $reset_code]) ?>" method="POST">
            <input type="password" class="WVEmail" name="password" placeholder="Wachtwoord"><br>
            <?php if (isset($errors['password'])) : ?>
                <span class="errors"> <?php echo $errors['password'] ?></span>
            <?php endif; ?>

            <input type="password" class="WVEmail" style="margin-top: 2vh;" name="password_confirm" placeholder="Wachtwoord Bevestigen"> <br>

            <button type="submit" class="WVReset">Wachtwoord resetten</button>
        </form>

    </section>
</body>

</html>