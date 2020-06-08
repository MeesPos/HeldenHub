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

            if (userRegisteredCheck($result['data']['email'])) {

                // Als email nog niet in db staat -> Nieuwe user aanmaken
                createUser($result['data']);

                // Inloggen door sessie te maken
                logUserIn($result['data']['email']);

                $template_engine = get_template_engine();
                echo $template_engine->render('bedanktPagina');
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
        echo $template_engine->render('AanmeldPagina');

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
                if (password_verify($_POST['wachtwoord'], $userInfo['wachtwoord'])) {
                    $_SESSION['user_id'] = $userInfo['id'];
                } else {
                    $result['errors']['wachtwoord'] = 'Onjuist wachtwoord, probeer overnieuw.';
                }
            } else {
                $result['errors']['email'] = 'Onbekend email adres. Meld u eerst aan a.u.b.';
            }
        } else {
            $result['errors']['wrong'] = 'Fout wachtwoord of onbekend email adres!';
        }

        $template_engine = get_template_engine();
        echo $template_engine->render('bedanktPagina', ['errors' => $result['errors']]);
    }
}
