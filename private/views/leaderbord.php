<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/1a91c75a80.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?php echo site_url('/css/style.css') ?>" media="all">
    <title>Leaderbord</title>
</head>
<body>

    <?php foreach($puntenLeaderbord as $test) : ?>

        <?php echo $test['punten']; ?>

    <?php endforeach; ?>

</body>
</html>