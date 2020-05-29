<?php
// Model functions
// In dit bestand zet je ALLE functions die iets met data of de database doen

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
    $query      = "INSERT INTO `posts` (`titel`, `inhoud`, `gebruiker_id`) VALUES (:titel, :inhoud :gebruiker_id)";
    $statement  = $connection->prepare($query);

    $params = [
        'titel'         => $_POST['titel'],
        'inhoud'        => $_POST['inhoud'],
        'gebruiker_id'  => 1,
    ];

    $statement->execute($params);

    $redirectURL = url('/');
	redirect($redirectURL);
}