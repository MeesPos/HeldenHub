<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/1a91c75a80.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.2.3/gsap.min.js"></script>
    <link rel="stylesheet" href="<?php echo site_url('/css/style.css') ?>" media="all">
    <title>Mijn Account</title>
</head>
<header>
    <?php include '../private/includes/nav.php' ?>
</header>

<body style="background-image: linear-gradient(rgba(123, 123, 123, 0.4), rgba(123, 123, 123, 0.4)), url( <?php echo site_url('/img/stad.png') ?> )">
    <main class="mijnAccount">
        <section class="mijnInfo">
            <div id="mijnGegevens" class="small">
                <h1>Mij profile</h1>
                <img src=" " class="myFile">

                <h3>Cornell van der Straaten</h3>
                <h3>Boskoop</h3>
                <div class="small">
                    <a href="#" id="veranderenInfo"><i class="fas fa-pencil-alt"></i> Gegevens wijzigen </a>
                </div>
                <div class="big">
                    <h1 class="infoTitel"> Mijn gegevens wijzigen</h1>
                    <div class="form">
                        <form action="<?php echo url("infoWijzigen", ['id']) ?>" method="POST" class="form2">
                            <div class="voornaam">
                                <input type="name" class="form-control" name="voornaam" required placeholder="<?php // echo getLoggedInVoornaam(); ?>">
                            </div>
                            <div class="achternaam">
                                <input type="name" class="form-control" name="achternaam" required placeholder="<?php // echo getLoggedInAchternaam(); ?>">
                            </div>
                            <div class="email">
                                <input type="email" class="form-control" name="email" required placeholder=" <?php //  echo getLoggedInEmail(); ?>"><br>
                            </div>
                            <div class="datum">
                                <input type="date" class="form-control" id="birthday" name="<?php // echo getLoggedInBirthday(); ?></h3>">
                            </div>
                            <div class="plaats">
                                <input type="name" class="form-control" name="plaats" required placeholder=" <?php // echo getLoggedInPlaats(); ?>">
                            </div>
                            <div class="foto">
                                <input type="file" class="form-control" id="myfile" name="myfile[]" accept="image/*" multiple="" /><br><br></div>
                            <div class="buttons">
                                <button type="submit" value="upload" class="button">Wijzigen</button>
                            </div>
                    </div>

                </div>
                <div id="mijnPunten">
                    <h3><i class="fas fa-donate"></i> 5</h3>
                    <h3><i class="fas fa-coins"></i> 130</h3>
                    <h3><i class="fas fa-trophy"></i> #2</h3>
                    <h3 id="titel">Titel:</h3>
                </div>
        </section>
        <?php $connection = dbConnect();

        ?>
        <?php foreach ($statement  as $row) { ?>
            <section>

                <h1 id="postTitel"><span>LAATSTE POSTS</span></h1>
                <div class="mijnPost">
                    <h2><?php echo $row['titel'] ?></h2>
                    <p><?php echo $row['inhoud'] ?></p>
                    <button class="hulpButton">Hulp gehad?</button>
                </div>

            </section>
        <?php } ?>
    </main>

    <script src="<?php echo site_url('/js/lightbox.js') ?>"></script>
</body>

</html>