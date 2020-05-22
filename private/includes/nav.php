<body>
    <nav>
        <header id="nav">
            <section id="navbar">
                <div class="nav boven">
                    <div class="menu sticky bovennav">
                        <?php if (!isLoggedIn()) : ?>
                            <a class="nav-items" href="#">Aanmelden</a>
                        <?php else : ?>
                            <a class="nav-items" href="#">Mijn Account</a>
                            <a class="nav-items" href="#">Uitloggen</a>
                        <?php endif; ?>
                        <a class="nav-items" href="#">Shop</a>
                        <a class="nav-items" href="#">Leaderbord</a>
                    </div>
                </div>
            </section>
            <section id="navbar">
                <div class="nav">
                    <div class="menu sticky ondernav">
                        <a href="">
                            <img src="<?php echo site_url('/img/logo.png') ?> " alt="Logo Heldenhub" class="logonav">
                        </a>
                        <div class="hulp-items">
                            <a class="nav-items hulp-items aanbieden" href="#">HULP AANBIEDEN</a>
                            <a class="nav-items hulp-items" href="#">HULP VINDEN</a>
                        </div>
                    </div>
                </div>
            </section>
        </header>
    </nav>
</body>