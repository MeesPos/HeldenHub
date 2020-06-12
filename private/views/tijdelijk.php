<div class="registratie-bedankt-content">
        <?php if (isset($errors)) {
            foreach ($errors as $row) {
                echo $row; ?>
                <a href="<?php echo url('aanmelden') ?>"><button>Terug naar aanmelden</button></a>
                <?php
            };
        } else {
            echo "Bedankt voor het registreren!" ?>
            <a href="<?php echo url('overview'); ?>"><button>Naar overview</button></a>
        <?php
        }
        ?>

    </div>