<?php
// Model functions
// In dit bestand zet je ALLE functions die iets met data of de database doen
function getUsers(){
    $connection = dbConnect();
    $sql = 'SELECT * FROM `gebruikers`';
    $statement = $connection->query( $sql);

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

function getUsersByEmail($email){
    $connection = dbConnect();
	$sql =  'SELECT * FROM `gebruikers` WHERE `email`= :email';
	$statement = $connection->prepare($sql);
    $statement->execute(['email' => $email]);

  if ($statement->rowCount() === 1);
   return $statement->fetch();
}
return false;


function getUsersById($id){
    $connection = dbConnect();
	$sql =  'SELECT * FROM `gebruikers` WHERE `id`= :id';
	$statement = $connection->prepare($sql);
    $statement->execute(['id' => $id]);

  if ($statement->rowCount() === 1);
   return $statement->fetch();
}
return false;
  
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