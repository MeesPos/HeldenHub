<?php
// Model functions
// In dit bestand zet je ALLE functions die iets met data of de database doen

use PhpParser\Node\Stmt\ElseIf_;

function getUsers()
{
    $connection = dbConnect();
    $sql = 'SELECT * FROM `gebruikers`';
    $statement = $connection->query($sql);
}

function alleDetails()
{

    $connection = dbConnect();
    $sql = 'SELECT * 
        FROM `gebruikers`
        INNER JOIN `posts` 
        ON `posts`.`gebruiker_id` = `gebruikers`.`id`
        WHERE `posts`.`id` = :id';
    $statement = $connection->prepare($sql);
    $idQuery = [
        'id' => $_POST['postId']
    ];
    $statement->execute($idQuery);

    return $statement->fetch();
}


function detailsOphalen(){
    $connection = dbConnect();
    $sql = 'SELECT * FROM `gebruikers` WHERE `id` = :id';
    $statement = $connection->prepare($sql);
    $params = [
        'id' => $_SESSION['user_id']
    ];
    $statement->execute($params);

    return $statement->fetch();
}

function getUsersByEmail($email){

    $connection = dbConnect();
    $sql =  'SELECT * FROM `gebruikers` WHERE `email`= :email';
    $statement = $connection->prepare($sql);
    $statement->execute(['email' => $email]);


  if ($statement->rowCount() === 1){
   return $statement->fetch();
  }

    return false;
}

function getUsersById($id)
{
    $connection = dbConnect();
    $sql =  'SELECT * FROM `gebruikers` WHERE `id`= :id';
    $statement = $connection->prepare($sql);
    $statement->execute(['id' => $id]);


  if ($statement->rowCount() === 1){
   return $statement->fetch();
  }


    return false;
}


function getUsersByCode($code)
{
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






function getTotalTracks($connection)
{
    $sql       = 'SELECT count(*) as `total` FROM `posts`';
    $statement = $connection->query($sql);

    return (int) $statement->fetchColumn();
}


function adminPageConn()
{
    $connection = dbConnect();
    $sql = 'SELECT * FROM `gebruikers` WHERE `id` = :id';
    $statement  = $connection->prepare($sql);

    $params = [
        'id' => 1
    ];

    $statement->execute($params);

    return $data = $statement->fetch();
}
function showPost()
{
    $connection = dbConnect();
    $query = "SELECT * from ` post` ";
    $statement = $connection->query($query);
    // $template_engine = get_template_engine();
    // 	echo $template_engine->render('gebruikersPagina');	

}







// OVERIGE FUNCTIES

function getUserData()
{
    $connection = dbConnect();
    $query      = 'SELECT * 
                   FROM `gebruikers`
                   INNER JOIN `punten` 
                   ON `punten`.`gebruiker_id` = `gebruikers`.`id`
                   WHERE `gebruikers`.`id` = :gebruiker_id ';
    $statement  = $connection->prepare($query);

    $params = [
        'gebruiker_id' => $_SESSION['user_id']
    ];

    $statement->execute($params);

    return $statement->fetch();
}

function logUserIn($email)
{
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

function userRegisteredCheck($email)
{
    // Als email al in db staat -> error
    $connection = dbConnect();
    $sql =  'SELECT * FROM `gebruikers` WHERE `email`= :email';
    $statement = $connection->prepare($sql);
    $statement->execute(['email' => $email]);

    return ($statement->rowCount() === 0);
}


function createUser($data, $code) {

    $connection = dbConnect();

    $sql =  "INSERT INTO `gebruikers` ( `email`, `voornaam`, `achternaam`, `plaats`, `birthday`, `myfile`, `wachtwoord`, `code`)
             VALUES (:email, :voornaam, :achternaam, :plaats, :birthday, :profielfoto, :wachtwoord, :code)";

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
        'code' => $code
    ];

    $statement->execute($params);
}

function createPuntenRow($user_id)
{
    $connection = dbConnect();


    $sql =  'INSERT INTO `punten` ( `punten`, `credits`, `gebruiker_id` )
             VALUE (0, 0, :id)';
    $statement = $connection->prepare($sql);

    $params = [
        'id' => $user_id
    ];

    $statement->execute($params);
}

function getLoginUserInfo($email)
{

    $connection = dbConnect();
    $sql =  'SELECT * FROM `gebruikers` WHERE `email`= :email';

    $statement = $connection->prepare( $sql );
    $statement->execute( ['email' => $email] );
    if($statement->rowCount() === 1){
    return  $statement->fetch() ;
}
return false;

}

//  HULP VRAGEN

function savePost()
{
    $connection = dbConnect();
    $query      = 'INSERT INTO `posts` (`id`, `titel`, `inhoud`, `gebruiker_id`) VALUES (NULL, :titel, :inhoud,  :gebruiker_id)';

    $statement  = $connection->prepare($query);

    $params = [
        'titel'         => $_POST['titel'],
        'inhoud'        => $_POST['inhoud'],
        'gebruiker_id'  => $_SESSION['user_id'],
    ];

    $statement->execute($params);

    $redirectURL = url('overview');
    redirect($redirectURL);
}


// OVERVIEW

function getCardData($page, $pagesize = 5)
{
    $connection = dbConnect();

    // Amount of rows
    $total = getTotalTracks($connection);
    // Amount of pages
    $num_pages = (int) round($total / $pagesize);
    // Calculate offset
    $offset = ($page - 1) * $pagesize;

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

// GEBRUIKERS PAGINA

function getUserCardData($page, $pagesize = 5)
{
    $connection = dbConnect();

    // Amount of rows
    $total = getTotalTracks($connection);
    // Amount of pages
    $num_pages = (int) round($total / $pagesize);
    // Calculate offset
    $offset = ($page - 1) * $pagesize;

    $user_id_ophalen = $_SESSION['user_id'];

    // Inner join query to get all info needed and skip deleted users 
    $query      = 'SELECT * FROM `gebruikers`
    INNER JOIN `posts` 
    ON `posts`.`gebruiker_id` = `gebruikers`.`id`
    WHERE `gebruikers` . `id` = :gebruiker_id 
    LIMIT ' . $pagesize . ' OFFSET  ' . $offset; 
    $statement = $connection->prepare($query);
    $param = [
        'gebruiker_id' => $user_id_ophalen
    ];
    $statement->execute($param);

    return [
        'statement' => $statement,
        'total'     => $total,
        'pages'     => $num_pages,
        'page'      => $page
    ];
};


// Punten geven

function givePoint($receiver)
{
    $connection = dbConnect();
    $sql = 'UPDATE `punten` SET `punten` = `punten` + "1" , `credits` = `credits` + "1" WHERE `punten` . `gebruiker_id` = :id';

    $statement = $connection->prepare($sql);
    $statement->execute(['id' => $receiver]);
};

function deletePost($postId)
{
    $connection = dbConnect();
    $sql = 'DELETE FROM `posts` WHERE `id` = :id ';

    $statement = $connection->prepare($sql);
    $statement->execute(['id' => $postId]);
}


// LEADERBORD PAGINA

function puntenOphalen($limit)
{



    $connection = dbConnect();
    $sql = 'SELECT * FROM `punten`
    INNER JOIN `gebruikers` 
    ON `punten`.`gebruiker_id` = `gebruikers`.`id`
    WHERE `gebruikers`.`id` = `punten`.`gebruiker_id` 
    ORDER BY punten.punten DESC LIMIT ' . $limit . ' ';
    $statement = $connection->prepare($sql);
    $param = [
        'leadLimit' => $limit
    ];
    $statement->execute($param);

    return $statement->fetchAll();
}

// WACHTWOORD VERGETEN PAGINA

function getUsersByResetCode($reset_code)
{
    $connection = dbConnect();
    $sql =  'SELECT * FROM `gebruikers` WHERE `password_reset`= :code';
    $statement = $connection->prepare($sql);
    $statement->execute(['code' => $reset_code]);

    if ($statement->rowCount() === 1) {
        return $statement->fetch();
    }

    return false;
}

function updatePassword($user_id, $new_password)
{
    $safe_new_password = password_hash($new_password, PASSWORD_DEFAULT);
    $sql = 'UPDATE `gebruikers` SET `wachtwoord` = :wachtwoord, `password_reset` = NULL WHERE id = :id';
    $connection = dbConnect();
    $statement = $connection->prepare($sql);
    $params = [
        'wachtwoord' => $safe_new_password,
        'id' => $user_id
    ];

    return $statement->execute($params);
}

// Search data 
function getSearchCardData($page, $pagesize = 5, $zoekterm, $zoeksoort)
{
    $connection = dbConnect();

    // Amount of rows
    $total = getTotalSearchTracks($connection, $zoekterm, $zoeksoort);
    // Amount of pages
    $num_pages = (int) round($total / $pagesize);
    // Calculate offset
    $offset = ($page - 1) * $pagesize;

    // Inner join query to get all info needed and skip deleted users 
    if ($zoeksoort == 'plaats') {
        $query      = 'SELECT * 
    FROM `gebruikers`
    INNER JOIN `posts`  
    ON `posts`.`gebruiker_id` = `gebruikers`.`id`
    WHERE `plaats` LIKE :zoekterm
    LIMIT ' . $pagesize . ' OFFSET ' . $offset;
    } elseif ($zoeksoort == 'titel') {
        $query      = 'SELECT * 
        FROM `gebruikers`
        INNER JOIN `posts`  
        ON `posts`.`gebruiker_id` = `gebruikers`.`id`
        WHERE `titel` LIKE :zoekterm
        LIMIT ' . $pagesize . ' OFFSET ' . $offset;
    }
    // Prepare and return executed query
    $statement = $connection->prepare($query);

    $params = [
        'zoekterm' => '%' . $zoekterm . '%'
    ];

    $statement->execute($params);
    return [
        'statement' => $statement,
        'total'     => $total,
        'pages'     => $num_pages,
        'page'      => $page
    ];
};

function getTotalSearchTracks($connection, $zoekterm, $zoeksoort)
{
    if ($zoeksoort == 'plaats') {
        $sql       = 'SELECT count(*) as `total` FROM `gebruikers` WHERE `plaats` LIKE :zoekterm ';
    } elseif ($zoeksoort == 'titel') {
        $sql       = 'SELECT count(*) as `total` FROM `posts` WHERE `titel` LIKE :zoekterm ';
    }
    $statement = $connection->prepare($sql);

    $params = [
        'zoekterm' => '%' . $zoekterm . '%'
    ];
    $statement->execute($params);
    return (int) $statement->fetchColumn();
}

function getItems($item_soort){
    $connection = dbConnect();

    if($item_soort == 'titel') {
        // Make query based on what items to retrieve
        $sql = 'SELECT * FROM `item_info` WHERE `type` = "titel" ';
    } else if ($item_soort == 'kader') {
        $sql = 'SELECT * FROM `item_info` WHERE `type` = "kader" ';
    } else if ($item_soort == 'kleur') {
        $sql = 'SELECT * FROM `item_info` WHERE `type` = "kleur" ';
    } else if ($item_soort == 'overig') {
        $sql = 'SELECT * FROM `item_info` WHERE `type` = "overig" ';
    }

    $statement = $connection->prepare($sql);
    $statement->execute();
    return $statement->fetchAll();
}

function shopBuyCheck() {

}

function getItemInfo($item_id) {
    $connection = dbConnect();

    $sql = 'SELECT * FROM `item_info` WHERE `id` = :id';
    $statement = $connection->prepare($sql);

    $params = [
        'id' => $item_id
    ];

    $statement->execute($params);
    return $statement->fetch();
}

function enoughCredits($prijs, $user_credits) {
    if ($prijs <= $user_credits){
        return true;
    } else {
        return false;
    }
}

function buyItemPayment($prijs) {
    $connection = dbConnect();
    $sql = 'UPDATE `punten` SET `credits` = `credits` - :prijs WHERE `punten` . `gebruiker_id` = :id';

    $statement = $connection->prepare($sql);
    $params = [
        'id'      => $_SESSION['user_id'],
        'prijs'   => $prijs
    ];
    $statement->execute($params);
}

function giveUserItem($item_id) {
    // Get info of bought item
    $item_info = getItemInfo($item_id);

    $connection = dbConnect();
    // Create query to put into user_item
    $sql = 'INSERT INTO `user_items` (`id`, `type`, `item_inhoud`, `actief`,  `gebruiker_id`) VALUES (NULL, :soort, :inhoud, :actief, :gebruiker_id)';
    $statement = $connection->prepare($sql);

    $params = [
        'soort'         => $item_info['type'],
        'inhoud'        => $item_info['inhoud'],
        'actief'        => 1,
        'gebruiker_id'  => $_SESSION['user_id']
    ];
    $statement->execute($params);

}