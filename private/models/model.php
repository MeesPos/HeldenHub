<?php
// Model functions
// In dit bestand zet je ALLE functions die iets met data of de database doen

function getUserData() {
    $connection = dbConnect();
    $query = 'SELECT * FROM `gebruikers` WHERE `id` = :gebruiker_id';
    $statement = $connection->prepare($query);

    $params = [
        'gebruiker_id' => 1
    ];
    
    $statement->execute($params);
    
    return $statement->fetch();
}