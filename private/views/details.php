<?php $connection = dbConnect(); ?>
<?php foreach ($AlleDetails as $row) { ?>
    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Vraag van <?php echo $row['voornaam'] ?> </title>
        <link rel="stylesheet" href="<?php echo site_url('/css/style.css') ?>" media="all">
    </head>

    <body>
        <?php include '../private/includes/nav.php' ?>
        <section id="hulpdetail">

            <div class="geplaatstdoor">
                <h2>Geplaatst door:</h2>
                <img src="<?php echo $row['myfile'] ?>" alt="Profiolfoto van ['voornaam'] ?>">
                <div class="gegevens">
                    <h3><?php echo $row['voornaam'] ?></h3>
                    <h3><?php echo $row['plaats'] ?></h3>
                </div>
            </div>

            <div class="hulpinfo">
                <h2><?php echo $row['titel'] ?></h2>
                <p><?php echo $row['inhoud'] ?></p>
            </div>

            <div class="contact">
                <h2>Wilt u <?php echo $row['voornaam'] ?> helpen?</h2>
                <form method="post" action="<?php echo url("detailsContact") ?>">
                    <input type="hidden" name="hiddenId" value="<?php echo $row['id'] ?>">
                    <input type="text" name="naam" placeholder="Naam">
                    <input type="email" name="email" placeholder="Email Adres">
                    <input type="comment" name="bericht" placeholder="Bericht">
                    <input type="submit" name="submit" value="Verstuur">
                </form>
            </div>
        </section>
    </body>
<?php } ?>

    </html>