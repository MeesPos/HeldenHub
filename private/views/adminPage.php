<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Pagina</title>
    <script src="https://kit.fontawesome.com/1a91c75a80.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?php echo site_url('/css/style.css') ?>" media="all">
</head>

<body>
    <section id="admin-page">
        <?php include '../private/includes/nav.php' ?>

        <div class="welkom">
            <h1 class="welkomadmin">Welkom <?php echo $data['voornaam'] ?></h1>
            <?php setlocale(LC_ALL, "Nld_Nld"); ?>
            <p class="datum">Het is vandaag: <?php echo strftime("%A %e %B %G") ?></p>
        </div>

        <div class="stats">
            <h2><?php echo $gebruikers; ?> Gebruikers</h2>
            <h2><?php echo $postCount; ?> mensen zoeken Hulp!</h2>
        </div>

        <div class="functies">
            <div class="leaderbord">
                <div class="top5">
                    <img class="vlagadmin" src="<?php echo site_url('/img/vlagleader.png') ?>" alt="Leaderbord vlag">
                    <div class="LBRechts">
                        <?php $counterLB2 = 0; ?>
                        <?php foreach ($leaderbord as $row) : ?>
                            <?php $counterLB2 += 1 ?>
                            <div class="TableLB">
                                <div class="ranken">
                                    <h2> <span class="nummeren"><?php echo $counterLB2 ?></span>
                                        <span class="naamLB"> <?php echo $row['voornaam'] ?></span></h2>
                                </div>

                                <div class="puntenLBRE">
                                    <i class="fas fa-donate"></i> <span class="puntjesLBR">
                                        <?php echo $row['punten'] ?> </span>
                                </div>
                            </div>

                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="bannen">
                <form method="POST" action="<?php echo url('admin.ban') ?>">
                    <label for="invoer" class="kieseen">Ban een gebruiker</label><br>
                    <input type="text" id="invoer" name="invoer" list="lijst" placeholder="Zoek">
                    <datalist id="lijst"></datalist>
                    <button type="submit" class="submitAdmin">Submit</button>
                </form>
            </div>
        </div>

        <script type="text/javascript">
            let dataList = document.getElementById('lijst');
            let input = document.getElementById('invoer');

            let request = new XMLHttpRequest();
            request.onreadystatechange = function(response) {
                if (request.readyState === 4 && request.status === 200) {
                    let gebruikers = JSON.parse(request.responseText);

                    gebruikers.forEach(function(item) {
                        let option = document.createElement('option');
                        option.innerText = item.voornaam;
                        option.value = item.id;
                        dataList.appendChild(option);
                    });

                    input.placeholder = "Zoek de juiste Gebruiker...";
                } else {
                    input.placeholder = "Gebruikerlijst kan niet geladen worden";
                }
            };
            input.placeholder = "Laden van de gebruikers...";

            request.open('GET', '<?php echo url('admin.json'); ?>', true);
            request.send();

            form.addEventListener('submit', function(event) {

                const invoer = document.forms["form"]["invoer"].value;
                let keuze = document.getElementById('keuze');

                keuze.innerText = 'Je hebt gekozen voor ' + invoer;
                event.preventDefault();

            });
        </script>
    </section>
</body>

</html>
