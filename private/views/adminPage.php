<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Pagina</title>
    <link rel="stylesheet" href="<?php echo site_url('/css/style.css') ?>" media="all">
</head>

<body>
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

        </div>

        <div class="bannen">
            <label for="invoer">Kies een gebruiker</label>
            <input type="text" id="invoer" list="lijst" placeholder="Zoek">
            <datalist id="lijst"></datalist>
        </div>
    </div>

    <script type="text/javascript">
        let dataList = document.getElementById('lijst');
        let input = document.getElementById('invoer');

        let request = new XMLHttpRequest();
        request.onreadystatechange = function(response) {
            if (request.readyState === 4 && request.status === 200) {
                let steden = JSON.parse(request.responseText);

                steden.forEach(function(item) {
                    let option = document.createElement('option');
                    option.value = item;
                    dataList.appendChild(option);
                });

                input.placeholder = "Gebruikers";
            } else {
                input.placeholder = "Gebruikerlijst kan niet geladen worden";
            }
        };
        input.placeholder = "Laden van de gebruikers...";

        request.open('GET', '<?php gebruikersOphalen(); ?>', true);
        request.send();
    </script>
</body>

</html>