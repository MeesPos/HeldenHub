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

    <header>
        <?php include '../private/includes/nav.php' ?>
    </header>
    <main>
        <section id="header" style="background-image: linear-gradient(rgba(123, 123, 123, 0.4), rgba(123, 123, 123, 0.4)), url( <?php echo site_url('/img/stad.png') ?> )" >
            <img src="<?php echo site_url('/img/logo.png') ?> " alt="Logo van HeldenHub" class="logoheader">
        </section>

        <section id="meerinfo">
            <h2 class="kominactie">Kom in actie!</h2>
            <p class="actietext">Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                Corporis perspiciatis dolor saepe nostrum incidunt a totam, enim at,
                provident repellendus ab sapiente, reiciendis id voluptates error culpa
                est voluptate beatae!Corporis perspiciatis dolor saepe nostrum incidunt a totam, enim at,
                provident repellendus ab sapiente, reiciendis id voluptates error culpa
                est voluptate beatae!</p>

                <div class="knoppenhelpen">
                    <button class="wilhelpen">IK WIL HELPEN</button>
                    <button class="hulpnodig">HULP NODIG</button>
                </div>
        </section>

        <section id="leaderbord">
            <div class="leaderinfo">
                <h2 class="scoor">SCOOR PUNTEN</h2>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                    Corporis perspiciatis dolor saepe nostrum incidunt a totam, enim at,
                    provident repellendus ab sapiente, reiciendis id voluptates error culpa
                    est voluptate beatae!Corporis perspiciatis dolor saepe nostrum incidunt a totam, enim at,
                    provident repellendus ab sapiente, reiciendis id voluptates error culpa
                    est voluptate beatae! reiciendis id voluptates error culpa
                    est voluptate beatae!Corporis perspiciatis dolor saepe nostrum incidunt a totam, enim at,
                    provident repellendus ab sapiente, reiciendis id voluptates error culpa
                    est voluptate beatae!</p>

                    <div class="beginknop">
                        <button class="begin">BEGIN TE SCOREN</button>
                    </div>

            </div>
        </section>
    </main>

</body>

</html>