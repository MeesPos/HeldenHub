<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hulp vragen</title>
    <link rel="stylesheet" href="<?php echo site_url('/css/style.css') ?>" media="all">
    <script src="https://kit.fontawesome.com/1eb7c10cba.js" crossorigin="anonymous"></script>
</head>

<body>

    <header>
        <?php include '../private/includes/nav.php' ?>
    </header>

    <section id="geholpen">

        <div class="geholpenIcon">
            <i class="fas fa-hands-helping"></i>
        </div>
        
        <div class="introductieHG">
            <h1>BENT U GEHOLPEN?</h1>
            <p>Wat fijn dat u bent geholpen. Om diegene die u geholpen heeft te bedanken, hebben wij een puntenprogramma.
                Hier kunt de email van de juiste persoon zoeken om hem zijn punten te geven!</p>
        </div>

        <form method="POST" action="<?php echo url('punten.geven') ?>" class="formHG">
            <label for="invoer" class="labelkies">Kies een gebruiker</label><br>
            <input type="text" id="invoer" name="invoer" list="lijst" class="zoekbalkHG" placeholder="Zoek"><br>
            <datalist id="lijst"></datalist>
            <button type="submit" class="submitHG">Submit</button>
        </form>
    </section>


    <script type="text/javascript">
        let dataList = document.getElementById('lijst');
        let input = document.getElementById('invoer');

        let request = new XMLHttpRequest();
        request.onreadystatechange = function(response) {
            if (request.readyState === 4 && request.status === 200) {
                let gebruikers = JSON.parse(request.responseText);

                gebruikers.forEach(function(item) {
                    let option = document.createElement('option');
                    option.innerText = item.email;
                    dataList.appendChild(option);
                });

                input.placeholder = "Zoek de juiste Gebruiker...";
            } else {
                input.placeholder = "Gebruikerlijst kan niet geladen worden";
            }
        };
        input.placeholder = "Laden van de gebruikers...";

        request.open('GET', '<?php echo url('hulp.json'); ?>', true);
        request.send();

        form.addEventListener('submit', function(event) {

            const invoer = document.forms["form"]["invoer"].value;
            let keuze = document.getElementById('keuze');

            keuze.innerText = 'Je hebt gekozen voor ' + invoer;
            event.preventDefault();

        });
    </script>
</body>

</html>