<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Homepage</title>
    <link rel="stylesheet" href="<?php echo site_url('/css/style.css') ?>" media="all">
</head>

<body>
    <?php include '../private/includes/nav.php' ?>
    <main>
        <section id="header" style="background-image: linear-gradient(rgba(123, 123, 123, 0.4), rgba(123, 123, 123, 0.4)), url( <?php echo site_url('/img/stad.png') ?> )">
            <img src="<?php echo site_url('/img/logo.png') ?> " alt="Logo van HeldenHub" class="logoheader">
        </section>

        <section id="meerinfo">
            <h2 class="kominactie">Kom in actie!</h2>
            <p class="actietext">Door corona kunnen en willen veel mensen niet naar buiten. Daardoor zijn simpele
            dingen zoals boodschappen doen niet meer mogelijk. Hier op deze website kun je zelf achterlaten als je
            ook niet naar buiten wilt. Mensen kunnen je daarom helpen met zulke dingen zoals boodschappen doen, de
            hond uitlaten of de tuin doen! Als je wilt helpen kan je reageren op deze aanvragen. Wees er voorelkaar!</p>

            <div class="knoppenhelpen">
                <a href="<?php echo url("overview") ?>"><button class="wilhelpen">IK WIL HELPEN</button></a>
                <a href="<?php echo url("hulp-vragen") ?>"><button class="hulpnodig">HULP NODIG</button></a>
            </div>
        </section>

        <section id="leaderbord">
            <div class="leaderinfo">
                <h2 class="scoor">SCOOR PUNTEN</h2>
                <p>Als je mensen wil helpen zijn wij en diegene die hulp nodig heeft heel dankbaar. Om jullie te danken
                hiervoor hebben wij een puntensysteem. Telkens als je iemand helpt kan je punten en credits verdienen.
                Met deze punten ga je steeds hoger staan op het Leaderbord. Met de credits kan je extra dingen kopen
                voor op je gebruikerspagina. Bijvoorbeeld Een mooie rand over je profielfoto of een andere kleur tekst.
                Start nu met punten scoren!</p>

                <div class="beginknop">
                    <a href="<?php echo url('overview') ?>"><button class="begin">BEGIN TE SCOREN</button></a>
                </div>

            </div>
        </section>
    </main>

</body>

</html>