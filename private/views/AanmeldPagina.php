<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/1a91c75a80.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.2.3/gsap.min.js"></script>
    <link rel="stylesheet" href="<?php echo site_url('/css/style.css') ?>" media="all">
    <title>AanmeldPagina</title>
</head>
<header>
    <?php include '../private/includes/nav.php' ?>
</header>

<body style="background-image: linear-gradient(rgba(123, 123, 123, 0.4), rgba(123, 123, 123, 0.4)), url( <?php echo site_url('/img/stad.png') ?> )">
    <main class="aanmeld">
        <section id="login">
          
            <h1><strong>INLOGGEN</strong></h1>
            <div class="form">
                <form action="<?php echo url("login")?>" method="POST" class="form1">
                    <div class="email">
                        <input type="email" name="email" placeholder="E-mail adres">
                        <?php if(isset($errors['email'])):?>
                           <span class="errors"> <?php echo $errors['email']?></span>
                           <?php endif; ?>
                    </div>
                    <div class="ww">
                        <input type="password" name="wachtwoord" placeholder="Wachtwoord">
                        <?php if(isset($errors['wachtwoord'])):?>
                           <span class="errors"> <?php echo $errors['wachtwoord']?></span>
                           <?php endif; ?>
                    </div>
                    <div class="wwv">
                        <a href="index.php" class="button2">Wachtwoord vergeten?</a>
                    </div>
                    <div class="buttons">
                        <button type="submit" class="button">INLOGGEN</button>
                    </div>
                </form>

            </div>

        </section>

        <section id="registreren">
            
            <h1><strong> REGISTREREN</strong></h1>
            <div class="grid">

                <div class="form">
                    <form action="<?php echo url("registreer")?>" method="POST" class="form2">
                        <div class="voornaam">
                            <input type="name" name="voornaam" required placeholder="Voornaam">
                        </div>
                        <div class="achternaam">
                            <input type="name" name="achternaam" required placeholder="Achternaam">
                        </div>
                        <div class="email">
                            <input type="email" name="email" required placeholder="E-mail">
                            <?php if(isset($errors['email'])):?>
                           <span class="errors"> <?php echo $errors['email']?></span>
                           <?php endif; ?>
                        </div>
                        <div class="datum">
                            <input type="date" id="birthday" name="birthday">
                        </div>
                        <div class="ww">
                            <input type="password" name="wachtwoord" required placeholder="Wachtwoord">
                            <?php if(isset($errors['wachtwoord'])):?>
                           <span class="errors"> <?php echo $errors['wachtwoord']?></span>
                           <?php endif; ?>
                        </div>
                        <div class="herww">
                            <input type="password" name="herwachtwoord" required placeholder="Hereaal wachtwoord">
                        </div>
                        <div class="plaats">
                            <input type="name" name="plaats" required placeholder="Plaats">
                        </div>
                        <div class="foto">
                            <input type="file" id="myfile" name="myfile"><br><br></div>
                        <div class="buttons">
                            <button type="submit" class="button">REGISTREER</button>
                        </div>
                        <div id="info" class="small">
                            <div><i class="fas fa-question-circle" style="font-size: 25px;"></i></div>
                            <h6>Waarom deze info?</h6>
                        </div>
                        <div class="big">
                            <h2 id="infoTitel">wat gebeurt met mijn gegevens?</h2>
                            <p id="infoP">djjjjjjjjjjfhgnnjyfkdykhfv</p>
                        </div>
                    </form>
                </div>
            </div>
        </section>





    </main>
    <script src="<?php echo site_url('/js/lightbox.js') ?>"></script>
</body>

</html>