<!doctype html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Overzicht</title>
    <link rel="stylesheet" href="<?php echo site_url('css/style.css') ?>" media="all">
    <script src="https://kit.fontawesome.com/1eb7c10cba.js" crossorigin="anonymous"></script>

</head>
<!-- Body wordt geopend in nav.php -->
<body class="bodyOV">
    <?php include '../private/includes/nav.php' ?>
    <div class="ov-wrapper">
        <div class="ov-wrapper-left">
            <?php foreach ($cards['statement'] as $row) :

            ?>
                <div class="ov-card">
                    <div class="oranje-balk"></div>
                    <div class="ov-post">
                        <div class="ov-post-user">
                            <img src="<?php echo site_url() ?>uploads/<?php echo $row['myfile']; ?>" alt="Profielfoto" class="ov-profiel <?php if (empty($items['kaderItem']['item_inhoud']) ) { echo "geen-item";  } else {echo $items['kaderItem']['item_inhoud'];  } ?>">
                            <section class="ov-post-user-info">
                                <p class="ov-post-naam <?php if (empty($items['kleurItem']['item_inhoud']) ) { echo "geen-item";  } else {echo $items['kleurItem']['item_inhoud'];  } ?>"><?php echo ucfirst($row['voornaam']) . ' ' . ucfirst($row['achternaam']); ?></p>
                                <p class="ov-post-plaats"><?php
                                                            // Making first letter of place always uppercase
                                                            echo ucfirst($row['plaats']); ?></p>
                            </section>
                        </div>
                        <div class="ov-post-punten">
                            <i class="fas fa-coins"></i>
                            <p class="punt-hoeveelheid">1</p>
                        </div>
                        <div class="ov-post-info">
                            <h3 class="ov-post-info-title"><?php echo ucfirst($row['titel']); ?></h3>
                            <p class="ov-post-info-tekst"><?php echo ucfirst($row['inhoud']); ?></p>
                        </div>
                        <div class="ov-post-knop">
                            <form action="<?php echo url('details') ?>" method="POST" class="ov-post-form">
                                <input type="hidden" name="postId" value="<?php echo $row['id'] ?>">
                                <input type="submit" name="post-detail" id="ov-form-submit" value="Details">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach;
        ?>
        <div class="pagination">
            <div class="pagination-links">
                <?php for ($i = 1; $i <= $cards['pages']; $i++) : ?>
                    <a href="<?php echo url('overview') . $i ?>" <?php
                                                        if ($i == $cards['page']) {
                                                            echo 'class="actieve-pagina pagination-buttons"';
                                                        } else {
                                                            echo 'class="pagination-buttons" ';
                                                        }
                                                        ?>><?php echo $i ?></a>
                <?php endfor; ?>
            </div>

        </div>
    </div>
    <div class="ov-wrapper-right">
        <div class="zoek-div">
            <form class="zoek-form" action="<?php echo url('zoeken') ?>" method="POST">

                <p class="zoek-info">Zoek op plaats of titel</p>
                <div class="choice-div">
                    <label id="plaats">Plaats<br><input type="radio" name="zoek" class="zoek-input" value="plaats" required checked></label>

                    <label id="titel">Titel<br><input type="radio" name="zoek" class="zoek-input" value="titel" required></label>
                </div>

                <input type="text" name="zoekterm" class="zoekterm-input" placeholder="Vul uw zoekterm in"><br>
                <input type="submit" value="Zoek" class="zoek-knop">

            </form>


        </div>
        <div class="corona_info">
            <?php
                foreach ($api_summary['Countries'] as $row) {
                    if ($row['Slug'] == "netherlands") {
                        $totalConfirmed = $row['TotalConfirmed'];
                        $totalDeaths    = $row['TotalDeaths'];
                        $totalRecovered = $row['TotalRecovered'];
                    }
                }
                // Deze php zou bovenin dit bestand gezet kunnen worden, of zelfs in functions.php maar 
                // dit is zodat je weet waar de info vandaan
            ?>
            <h3>Corona Nederland</h3>
            <p>Aantal Corona gevallen: <?php echo $totalConfirmed; ?></p>
            <p>Aantal Corona doden: <?php echo $totalDeaths; ?></p>
            <p>Aantal Corona gevallen geheeld: <?php echo $totalRecovered; ?></p>
            
        </div>
    </div>


</div>

</body>

</html>