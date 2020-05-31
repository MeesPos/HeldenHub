<?php
// Model functions
// In dit bestand zet je ALLE functions die iets met data of de database doen

function alleDetails()
{
    $connection = dbConnect();
    $sql = 'SELECT * 
    FROM `gebruikers`
    INNER JOIN `posts` 
    ON `posts`.`gebruiker_id` = `gebruikers`.`id`
    WHERE `posts`.`gebruiker_id` = 1';
    $statement = $connection->query($sql);

    return $statement->fetchAll();
}

function alleDetailsContact()
{
    $connection = dbConnect();
    $sql = 'SELECT * 
    FROM `gebruikers`
    INNER JOIN `posts` 
    ON `posts`.`gebruiker_id` = `gebruikers`.`id`
    WHERE `posts`.`gebruiker_id` = 1';
    $statement = $connection->query($sql);

    return $statement->fetchAll();
function getUserData() {
    $connection = dbConnect();
    $query      = 'SELECT * FROM `gebruikers` WHERE `id` = :gebruiker_id';
    $statement  = $connection->prepare($query);

    $params = [
        'gebruiker_id' => 1
    ];
    
    $statement->execute($params);
    
    return $statement->fetch();
}

function savePost() {
    $connection = dbConnect();
    $query      = 'INSERT INTO `posts` (`id`, `titel`, `inhoud`, `gebruiker_id`) VALUES (NULL, :titel, :inhoud,  :gebruiker_id)';
 
    $statement  = $connection->prepare($query);

    $params = [
        'titel'         => $_POST['titel'],
        'inhoud'        => $_POST['inhoud'],
        'gebruiker_id'  => 1,
    ];

    $statement->execute($params);

    $redirectURL = url('/bap/Heldenhub/public');
	redirect($redirectURL);
}