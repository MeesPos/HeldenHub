<?php
// Model functions
// In dit bestand zet je ALLE functions die iets met data of de database doen
function getUsers(){
    $connection = dbConnect();
    $sql = 'SELECT * FROM `gebruikers`';
    $statement = $connection->query( $sql);

}

function alleDetails()
{
    // $id = $_POST['postId'];
    $id = 1;

    $connection = dbConnect();
    $sql = 'SELECT * 
        FROM `gebruikers`
        INNER JOIN `posts` 
        ON `posts`.`gebruiker_id` = `gebruikers`.`id`
        WHERE `posts`.`id` = :id';
    $statement = $connection->prepare($sql);
    $idQuery = [
        'id' => $id
    ];
    $statement->execute($idQuery);

    return $statement->fetchAll();
}

function getUsersByEmail($email){
    $connection = dbConnect();
	$sql =  'SELECT * FROM `gebruikers` WHERE `email`= :email';
	$statement = $connection->prepare($sql);
    $statement->execute(['email' => $email]);

  if ($statement->rowCount() === 1);
   return $statement->fetch();

return false;

}

function getUsersById($id){
    $connection = dbConnect();
	$sql =  'SELECT * FROM `gebruikers` WHERE `id`= :id';
	$statement = $connection->prepare($sql);
    $statement->execute(['id' => $id]);

  if ($statement->rowCount() === 1);
   return $statement->fetch();


return false;
}


function getUsersByCode($code){
    $connection = dbConnect();
	$sql =  'SELECT * FROM `gebruikers` WHERE `code`= :code';
	$statement = $connection->prepare($sql);
    $statement->execute(['code' => $code]);

  if ($statement->rowCount() === 1);
   return $statement->fetch();


return false;
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
}
function getUserData() {
    $connection = dbConnect();
    $query      = 'SELECT * FROM `gebruikers` WHERE `id` = :gebruiker_id';
    $statement  = $connection->prepare($query);

    $params = [
        'gebruiker_id' => $_SESSION['user_id']
    ];
    
    $statement->execute($params);
    
    return $statement->fetch();
}



	

function getTotalTracks($connection) {
    $sql       = 'SELECT count(*) as `total` FROM `posts`';
    $statement = $connection->query( $sql );

    return (int) $statement->fetchColumn();

}

function getCardData($page, $pagesize = 5) {
    $connection = dbConnect();

    // Amount of rows
    $total = getTotalTracks($connection);
    // Amount of pages
    $num_pages = (int) round($total / $pagesize);
    // Calculate offset
    $offset = ( $page - 1 ) * $pagesize;

    // Inner join query to get all info needed and skip deleted users 
    $query      = 'SELECT * 
    FROM `gebruikers`
    INNER JOIN `posts` 
    ON `posts`.`gebruiker_id` = `gebruikers`.`id`
    LIMIT ' . $pagesize . ' OFFSET ' . $offset; 
    
    // Prepare and return executed query
    $statement = $connection->query($query);
    return [
        'statement' => $statement,
        'total'     => $total,
        'pages'     => $num_pages,
        'page'      => $page 
    ];
};


function adminPageConn() {
    $connection = dbConnect();
    $sql = 'SELECT * FROM `gebruikers` WHERE `id` = :id';
    $statement  = $connection->prepare($sql);

    $params = [
        'id' => 1
    ];

    $statement->execute($params);

    return $data = $statement->fetch();
}
 function showPost() {
    $connection = dbConnect();
	$query = "SELECT * from ` post` ";
    $statement = $connection->query($query);
    // $template_engine = get_template_engine();
	// 	echo $template_engine->render('gebruikersPagina');	

}







// OVERIGE FUNCTIES

function logUserIn($email) {
    $connection = dbConnect();
    // Get userId via email
    $getIdQuery = 'SELECT * FROM `gebruikers` WHERE `email` = :email ';
    $statement = $connection->prepare($getIdQuery);

    $param = [
        'email' => $email 
    ];
    $statement->execute($param);

    // Create session
    $userInfo = $statement->fetch();
    $_SESSION['user_id']    = $userInfo['id'];

   
}

// AANMELDPAGINA

function userRegisteredCheck($email) {
            // Als email al in db staat -> error
			$connection = dbConnect();
			$sql =  'SELECT * FROM `gebruikers` WHERE `email`= :email';
			$statement = $connection->prepare( $sql );
            $statement->execute( ['email' => $email] );
            
            return ( $statement->rowCount() === 0 );
}

function createUser($data) {

    $connection = dbConnect();

    
    $sql =  'INSERT INTO `gebruikers` ( `email`, `voornaam`, `achternaam`, `plaats`, `birthday`, `myfile`, `wachtwoord`)
             VALUE (:email, :voornaam, :achternaam, :plaats, :birthday, :profielfoto, :wachtwoord)';
    $statement = $connection->prepare($sql);
    
    $safe_wachtwoord = password_hash($data['wachtwoord'], PASSWORD_DEFAULT);

    $params = [
        'email' => $data['email'],
        'voornaam' => $data['voornaam'],
        'achternaam' => $data['achternaam'],
        'plaats' => $data['plaats'],
        'birthday' => $data['birthday'],
        'profielfoto' => $data['profielfoto'],
        'wachtwoord' => $safe_wachtwoord,
    ];

    $statement->execute($params);

}

function getLoginUserInfo($email) {

    $connection = dbConnect();
    $sql =  'SELECT * FROM `gebruikers` WHERE `email`= :email';
    $statement = $connection->prepare( $sql );
    $statement->execute( ['email' => $email] );
    
    return ( $statement->fetch() );
}

//  HULP VRAGEN

function savePost() {
    $connection = dbConnect();
    $query      = 'INSERT INTO `posts` (`id`, `titel`, `inhoud`, `gebruiker_id`) VALUES (NULL, :titel, :inhoud,  :gebruiker_id)';
 
    $statement  = $connection->prepare($query);

    $params = [
        'titel'         => $_POST['titel'],
        'inhoud'        => $_POST['inhoud'],
        'gebruiker_id'  => $_SESSION['user_id'],
    ];

    $statement->execute($params);

    $redirectURL = url('home');
	redirect($redirectURL);
}