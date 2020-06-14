<?php $connection = dbConnect(); ?>
    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Vraag van <?php echo ucfirst($alleDetails['voornaam']) ?> </title>
        <link rel="stylesheet" href="<?php echo site_url('/css/style.css') ?>" media="all">
    </head>

    <body>
        <?php include '../private/includes/nav.php' ?>
        <section id="hulpdetail">

            <div class="geplaatstdoor">
                <h2>Geplaatst door:</h2>
                <img src="<?php echo  site_url() . "uploads/" . $alleDetails['myfile']?>" alt="Profielfoto">
                <div class="gegevens">
                    <h3><?php echo ucfirst($alleDetails['voornaam']) . ' ' . ucfirst($alleDetails['achternaam']); ?></h3>
                    <h3><?php echo $alleDetails['plaats'] ?></h3>
                </div>
            </div>

            <div class="hulpinfo">
                <h2><?php echo $alleDetails['titel'] ?></h2>
                <p><?php echo $alleDetails['inhoud'] ?></p>
            </div>

            <div class="contact">
                <h2>Wilt u <?php echo $alleDetails['voornaam'] ?> helpen?</h2>
                <form method="post" action="<?php echo url("detailsContact") ?>">
                    <input type="hidden" name="hiddenId" value="<?php echo $alleDetails['id'] ?>">
                    <input type="text" name="naam" placeholder="Naam" value="<?php echo $details['voornaam'] ?>">
                    <input type="email" name="email" placeholder="Email Adres" value="<?php echo $details['email'] ?>">
                    <input type="comment" name="bericht" placeholder="Bericht">
                    <input type="submit" name="submit" value="Verstuur">
                </form>
            </div>
        </section>
    </body>


    </html>