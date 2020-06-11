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


    <div class="ov-wrapper-gebruiker">
        <div class="ov-wrapper-left">
            <div class="user-account">
                <div class="oranje-balk"></div>
                <h1 class="user-title">Beginnende Held</h1>
                <img src=" <?php echo site_url() . 'uploads/' . $user_data['myfile'] ?>  " class="myFile">

                <h2><?php echo ucfirst($user_data['voornaam']) . ' ' . ucfirst($user_data['achternaam']); ?></h3>
                    <p class="gebruiker-plaats"><?php echo ucfirst($user_data['plaats']); ?></p>
                    <div class="small">
                        <a href="#" id="veranderenInfo"><i class="fas fa-pencil-alt"></i> Gegevens wijzigen </a>
                    </div>
                    <div class="big">
                        <h1 class="infoTitel"> Mijn gegevens wijzigen</h1>
                        <div class="form">
                            <form action="<?php // echo url("infoWijzigen", ['id']) 
                                            ?>" method="POST" class="form2">
                                <div class="voornaam">
                                    <input type="name" class="form-control" name="voornaam" required placeholder="<?php // echo getLoggedInVoornaam(); 
                                                                                                                    ?>">
                                </div>
                                <div class="achternaam">
                                    <input type="name" class="form-control" name="achternaam" required placeholder="<?php // echo getLoggedInAchternaam(); 
                                                                                                                    ?>">
                                </div>
                                <div class="email">
                                    <input type="email" class="form-control" name="email" required placeholder=" <?php //  echo getLoggedInEmail(); 
                                                                                                                    ?>"><br>
                                </div>
                                <div class="datum">
                                    <input type="date" class="form-control" id="birthday" name="<?php // echo getLoggedInBirthday(); 
                                                                                                ?></h3>">
                                </div>
                                <div class="plaats">
                                    <input type="name" class="form-control" name="plaats" required placeholder=" <?php // echo getLoggedInPlaats(); 
                                                                                                                    ?>">
                                </div>
                                <div class="foto">
                                    <input type="file" class="form-control" id="myfile" name="myfile[]" accept="image/*" multiple="" /><br><br></div>
                                <div class="buttons">
                                    <button type="submit" value="upload" class="button">Wijzigen</button>
                                </div>
                        </div>

                    </div>
            </div>
            <div class="user-held-info">
                <div class="oranje-balk"></div>
                <table class="gebruiker-table">
                    <tr class="gebruiker-table-row" title="Deze punten houden bij hoevaak jij iemand hebt geholpen. Hiermee wordt jouw plaats op het leaderbord bepaalt!">
                        <td class="gebruiker-table-data"><i class="fas fa-donate"></i></td>
                        <td><?php echo $user_data['punten'] ?></td>
                    </tr>
                    <tr class="gebruiker-table-row" title="Gebruik deze credits om items uit de shop te kopen!">
                        <td class="gebruiker-table-data"><i class="fas fa-coins gebruiker-credits"></i></td>
                        <td><?php echo $user_data['credits'] ?></td>
                    </tr>
                    <tr class="disable-leaderbord-score gebruiker-table-row">
                        <td class="gebruiker-table-data"><i class="fas fa-trophy" ></i></td>
                        <td>#1</td>
                    </tr>
                </table>
            </div>

        </div>
        <div class="ov-wrapper-right">
            <?php foreach ($cards['statement'] as $row) :

            ?>
                <div class="ov-card-gebruiker">
                    <div class="oranje-balk"></div>
                    <div class="ov-post">
                        <div class="ov-post-user">
                            <img src="<?php echo site_url() ?>uploads/<?php echo $row['myfile']; ?>" alt="Profielfoto" class="ov-profiel">
                            <section class="ov-post-user-info">
                                <p class="ov-post-naam"><?php echo ucfirst($row['voornaam']) . ' ' . ucfirst($row['achternaam']); ?></p>
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
                        <div class="ov-buttons">
                            <div class="ov-post-knop">
                                <form action="#" method="POST" class="ov-post-form">
                                    <input type="hidden" name="postId" value="1">
                                    <input type="submit" name="post-detail" id="ov-form-submit" value="Details">
                                </form>
                            </div>

                            <div class="ov-geholpen-knop">
                                <form action="<?php echo url('hulp-gehad') ?>" method="POST">
                                    <input type="hidden" name="geefIDMee">
                                    <input type="submit" name="hulpgehad" id="ov-geholpen-submit" value="Ik ben geholpen">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach;
            ?>
        </div>


    </div>

    <script src="<?php echo site_url('/js/lightbox.js') ?>"></script>
</body>

</html>