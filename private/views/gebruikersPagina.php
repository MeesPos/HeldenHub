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
<main class="mijnAccount">
<?php if( isLoggedIn());?>
    <section class="mijnInfo">
<div id="mijnGegevens" class="small">
    <h1>Mij profile</h1>
    <img src="
     <?php echo getLoggedInMyfile();?>" class="myFile">

   <h3>
       <?php echo getLoggedInVoornaam();?> <?php echo getLoggedInAchternaam();?>
    </h3>
    <h3>
       <?php echo getLoggedInPlaats();?></h3>
       <div>
    <a href="#" id="veranderenInfo"><i class="fas fa-pencil-alt"></i> Gegevens veranderen </a>
    </div>
   
            <div class="big">
            <h2 class="infoTitel">Mij profile</h2>
    <img src="
     <?php echo getLoggedInMyfile();?>" class="myFile">

   <h3>
      
       <?php echo getLoggedInVoornaam();?> <?php echo getLoggedInAchternaam();?>
    </h3>
    <h3> 
       <?php echo getLoggedInEmail();?></h3>

    <h3> 
       <?php echo getLoggedInPlaats();?></h3>

       <h3> 
       <?php echo getLoggedInBirthday();?></h3>
            </div>

</div>
<div id="mijnPunten">
    <h3><i class="fas fa-donate"></i> 5</h3>
    <h3><i class="fas fa-coins"></i> 130</h3>
    <h3><i class="fas fa-trophy"></i> #2</h3>
<h3 id="titel">Titel:</h3>
</div>
    </section>
    <section>
        <h1 id="postTitel">LAATSTE POSTS</h1>
        <div class="mijnPost">
            <P>
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Corporis perspiciatis dolor saepe nostrum incidunt a totam, enim at,
                provident repellendus ab sapiente, reiciendis id voluptates error culpa est voluptate beatae!Corporis perspiciatis dolor saepe
                nostrum incidunt a totam, enim at, provident repellendus ab sapiente, 
            </P>
            <button class="hulpButton">Ik heb help gehad</button>
        </div>
        <div class="mijnPost">
            <P>
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Corporis perspiciatis dolor saepe nostrum incidunt a totam, enim at,
                provident repellendus ab sapiente, reiciendis id voluptates error culpa est voluptate beatae!Corporis perspiciatis dolor saepe
                nostrum incidunt a totam, enim at, provident repellendus ab sapiente, 
            </P>
            <button class="hulpButton">Hulp gehad?</button>
        </div>
        <div class="mijnPost">
            <P>
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Corporis perspiciatis dolor saepe nostrum incidunt a totam, enim at,
                provident repellendus ab sapiente, reiciendis id voluptates error culpa est voluptate beatae!Corporis perspiciatis dolor saepe
                nostrum incidunt a totam, enim at, provident repellendus ab sapiente, 
            </P>
            <button class="hulpButton">Hulp gehad?</button>
        </div>
    </section>

</main>

    <script src="<?php echo site_url('/js/lightbox.js') ?>"></script>
</body>

</html>