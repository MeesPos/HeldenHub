<body>
  
    <nav>
        <header id="nav">
            <section id="navbar">
                <div class="nav boven">
                    <div class="menu sticky bovennav navitems">
                        <?php if (!isset($_SESSION['user_id'])) : ?>
                            <a class="nav-items" href="<?php echo url('aanmelden') ?> ">Aanmelden</a>
                        <?php else : ?>
                            <a class="nav-items" href="<?php echo url("gebruiker")?>">Mijn Account</a>
                            <a class="nav-items" href="<?php echo url("loguit")?>">Uitloggen</a>
                            <style>
                            @media screen and (max-width: 800px) {
                                .mobielfix{
                                    margin-right: -100vw!important;
                                }
                            }
                            </style>
                        <?php endif; ?>
                        <a class="nav-items" href="<?php echo url('shop') ?> ">Shop</a>
                        <a class="nav-items mobielfix" href="<?php echo url("leaderbord") ?>">Leaderbord</a>
                    </div>
                </div>
            </section>
            <section id="navbar">
                <div class="nav">
                    <div class="menu sticky ondernav">
                        <a href="<?php echo url("home") ?>">
                            <img src="<?php echo site_url('/img/logo.png') ?> " alt="Logo Heldenhub" class="logonav">
                        </a>
                        <div class="hulp-items">
                            <a class="nav-items hulp-items aanbieden" href="<?php echo url('overview') ?>">HULP AANBIEDEN</a>
                            <a class="nav-items hulp-items" href="<?php echo url('hulp-vragen') ?> ">HULP VINDEN</a>
                        </div>
                    </div>
                </div>
            </section>
        </header>
    </nav>

