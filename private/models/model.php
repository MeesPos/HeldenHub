<?php
// Model functions
// In dit bestand zet je ALLE functions die iets met data of de database doen

function getUserData($connection) {
    $query = 'SELECT * FROM `gebruikers` WHERE `id` = :gebruiker_id';
    $userData = $connection->prepare($query);

    $params = [
        'gebruiker_id' => 1
    ];
    
    $userData->execute($params);
    return $userData;
}