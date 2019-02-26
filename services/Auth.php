<?php
/**
 * Created by PhpStorm.
 * UserManager: ebouvier
 * Date: 2019-02-08
 * Time: 20:19
 */

class Auth
{
    public function authenticate(User $user, string $password)
    {
        return password_verify($password, $user->getPassword());
    }

    public function hashPassword(string $password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public function generateHash(): string
    {
        return bin2hex(random_bytes(32));
    }

    public function sendConfirmationEmail(User $user)
    {
        $destinataire = $user->getEmail();
        $sujet = "Activer votre compte";
        $entete = "From: noreply@camagru.fr";

        $message = 'Bienvenue sur Camagru,
 
Pour activer votre compte, veuillez cliquer sur le lien ci dessous
ou copier/coller dans votre navigateur internet.
 
http://' . $_SERVER['HTTP_HOST'] . '/activation.php?login=' . urlencode($user->getUsername()) . '&key=' . urlencode
            ($user->getEmail_Hash()) . '
 
 
---------------
Ceci est un mail automatique, Merci de ne pas y répondre.';


        mail($destinataire, $sujet, $message, $entete);
    }

    public function sendResetPasswordEmail(User $user)
    {
        $destinataire = $user->getEmail();
        $sujet = "Reinitialiser votre mot de passe";
        $entete = "From: noreply@camagru.fr";

        $message = 'Bienvenue sur Camagru,
 
Pour reinitialiser votre mot de passe, veuillez cliquer sur le lien ci dessous
ou copier/coller dans votre navigateur internet.
 
http://' . $_SERVER['HTTP_HOST'] . '/reset_password.php?login=' . urlencode($user->getUsername()) . '&key=' .
            urlencode
            ($user->getPassword_Hash()) . '
 
 
---------------
Ceci est un mail automatique, Merci de ne pas y répondre.';


        mail($destinataire, $sujet, $message, $entete);
    }
}