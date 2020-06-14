<?php

namespace Website\Controllers;

/**
 * Class HomeController
 *
 * Deze handelt de logica van de homepage af
 * Haalt gegevens uit de "model" laag van de website (de gegevens)
 * Geeft de gegevens aan de "view" laag (HTML template) om weer te geven
 *w
 */
class AanmeldenController
{
    public function aanmelden()
    {

        $template_engine = get_template_engine();
        echo $template_engine->render('AanmeldPagina');
    }

    public function registreer()
    {
        // Valideer form informatie & zet alle POST gegevens in $data
        $errors = [];

        $newFileName = verwerkFotoUpload($_FILES, $errors);
        $result = validateRegistrationForm($_POST, $newFileName, $errors);

        if (count($result['errors']) === 0) {

            if (userRegisteredCheck($result['data']['email'] )) {
                //verificatie code bv(ece3d94aa2df1ae03df9f24d5f9eba25)
                  $code =md5(uniqid( rand(), true ) );
                // Als email nog niet in db staat -> Nieuwe user aanmaken

                createUser($result['data'], $code);
                // send een email 
                sendConfirmationEmail($result['data']['email'], $code);
                $user_info = getLoginUserInfo($result['data']['email']);
                createPuntenRow($user_info['id']);
                // Inloggen door sessie te maken
                logUserIn($result['data']['email']);
                 
                $overviewURL = url('overview');
                redirect($overviewURL);
               

               // createUser($result['data']);
                
                
                // Inloggen door sessie te maken
               // logUserIn($result['data']['email']);

                

                exit;
            } else {
                $result['errors']['email'] = 'Dit account bestaat al!'; 
            }
        }

        $template_engine = get_template_engine();
        echo $template_engine->render('bedanktPagina', ['errors' => $result['errors']]);
    }

    public function bevestigenEmailCode($code)
    {

        // eerst de $code gaan lezen 

        // gebruikers ophalen bij die $code
        $user = getUsersByCode($code);

        if ($user === false) {
            echo "Onbekende gebruikers of a bevestigd?";
            exit;
        }
        //gebruiker activereet $code een maakt ie leeg in de db (NULL)
        confirmAccount($code);

        $message = "Bedankt je account is nu bevestigd en je kunt inloggen.";
        echo "<script type='text/javascript'>alert('$message');</script>";

        $template_engine = get_template_engine();
        echo $template_engine->render('homepage');

        //bevestigings 

    }


    public function login()
    {
        $result = validate($_POST);

        if (count($result['errors']) === 0) {
            // Check if email exists
            if (!userRegisteredCheck($result['data']['email'])) {
                // Uitvoeren wanneer email al bekend is
                $userInfo = getLoginUserInfo($result['data']['email']);
                      if($userInfo['code']=== null){
                if (password_verify($result['data']['wachtwoord'], $userInfo['wachtwoord'])) {
                    $_SESSION['user_id'] = $userInfo['id'];

                    $overviewURL = url('overview');
                    redirect($overviewURL);

                } else {
                    $result['errors']['wachtwoord'] = 'Onjuist wachtwoord, probeer overnieuw.';
                }
            } else {
                $result['errors']['email'] = 'Onbekend email adres. Meld u eerst aan a.u.b.';
            }
        }
        } else {
            $result['errors']['wrong'] = 'Fout wachtwoord of onbekend email adres!';
        }

        $template_engine = get_template_engine();
		echo $template_engine->render('AanmeldPagina', ['errors' => $result['errors']]);
    }
    public function ingelogd()
	{
        $page = 1;
        $cardData = getCardData($page, 5);
        $userData = getUserData();
		$template_engine = get_template_engine();
		echo $template_engine->render('gebruikersPagina', ['userData' => $userData], [	'cards' => $cardData ]);
    }


    public function wachtwoordvergeten() {

        $errors = [];
        $mail_sent = false;

        if ( request()->getMethod() === 'post' ) {
            // Formulier afhandelen

            // Email checks
            $email = filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL);
            if ( $email === false ) {
                $errors['email'] = 'Geen geldig email adres opgegeven';
            }

            if ( count( $errors ) === 0 ) {
                // Kijken of email in de database staat
                $user = getUsersByEmail($email);
                if ( $user === false ) {
                    $errors['email'] = 'Onbekend account';
                }
            }

            // Als er geen fouten zijn, reset mail versturen
            if(count($errors) === 0){
                sendPasswordResetEmail($email);
                $mail_sent = true;
            }
        }

        $template_engine = get_template_engine();
        echo $template_engine->render('wachtwoord-vergeten', ['errors' => $errors, 'mail_sent' => $mail_sent]);
    }

    public function wachtwoordReset($reset_code) {

        $errors = [];

        // Gebruiker ophalen die bij de resetcode hoort
        $user = getUsersByResetCode($reset_code);
        if ( $user === false ) {
            echo "Ongeldige code";
            exit;
        }

        // Is het formulier opgetuurd met POST?
        if ( request()->getMethod() === 'post' ) {
            $password = $_POST['password'];
            $password_confirm = $_POST['password_confirm'];

            if(strlen($password) < 6) {
                $errors['password'] = 'Wachtwoord moet minstens 6 karakters lang zijn.';
            }

            if(count($errors) === 0) {
                if($password !== $password_confirm) {
                    $errors['password'] = 'De wachtwoorden zijn niet gelijk.';
                }
            }

            if(count($errors) === 0 ) {
                $result = updatePassword($user['id'], $password);
                if($result === true) {
                    redirect(url('aanmelden'));
                    // Script stopt
                } else {
                    $errors['password'] = 'Er ging iets fout bij het opslaan van het wachtwoord.';
                }
            }
        }

        // Formulier cheken (wachtwoord validatie)

        // Het nieuwe Wachtwoord opslaan
        
        // Gebruiker doorsturen naar de login

        $template_engine = get_template_engine();
        echo $template_engine->render('wachtwoord-reset', ['errors' => $errors, 'reset_code' => $reset_code]);
    }

}
