<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/1a91c75a80.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?php echo site_url('/css/style.css') ?>" media="all">
    <title>Leaderbord</title>
</head>

<body>

    <header>
        <?php include '../private/includes/nav.php' ?>
    </header>

    <section id="leaderbordLB">
        <section class="leftLB">
            <div class="informatie">
                <p>Op deze pagina kan je zien wie de <br>meeste HeldenPunten heeft behaald!
                    <br><br>Ga meer mensen helpen om zo in rang te stijgen!</p>
            </div>

            <div class="top3">

                <div class="top3">
                    <h2 class="huidigtop3">Onze huidige top 3!</h2>
                    <?php $counterLB = 0; ?>
                    <?php foreach ($top3 as $row) : ?>
                    <?php $counterLB += 1 ?>
                        <div class="ranking">
                            <h2> <span class="nummers"><?php echo $counterLB; ?></span> <span class="naamLB"> <?php echo $row['voornaam'] ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="right">
            <div class="top5">
            <img class="vlagleader" src="<?php echo site_url('/img/vlagleader.png') ?>" alt="Leaderbord vlag">
            <?php $counterLB2 = 0; ?>
            <?php foreach ($leaderbord as $row) : ?>
            <?php $counterLB2 += 1 ?>
                <div class="ranks">
                    <h2> <span class="nummers"><?php echo $counterLB2 ?></span> <span class="naamLB"> <?php echo $row['voornaam'] ?></span></h2>
                </div>
            <?php endforeach; ?>
            </div>
        </section>
    </section>
    <table>

    </table>


</body>

</html>