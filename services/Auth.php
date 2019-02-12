<?php
/**
 * Created by PhpStorm.
 * UserManager: ebouvier
 * Date: 2019-02-08
 * Time: 20:19
 */

require_once '../models/Db.php';

class Auth
{
    private $db;

    public function __construct(Db $db)
    {
        $this->db = $db;
    }

    public function authenticate(User $user)
    {
        $this->db;
    }

    /**
     * @param UserManager $user
     */
    public function resetPassword(User $user)
    {
        // TODO: Implement resetPassword() method.
    }

    public function hashPassword(string $password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public function sendConfirmationEmail(User $user)
    {
        // Préparation du mail contenant le lien d'activation
        $destinataire = $user->getEmail();
        $sujet = "Activer votre compte";
        $entete = "From: noreply@camagru.fr";

        $message = 'Bienvenue sur Camagru,
 
Pour activer votre compte, veuillez cliquer sur le lien ci dessous
ou copier/coller dans votre navigateur internet.
 
http://localhost:3000/activation.php?login=' . urlencode($user->getUsername()) . '&key=' . urlencode($user->getEmailHash
            ()) . '
 
 
---------------
Ceci est un mail automatique, Merci de ne pas y répondre.';


        mail($destinataire, $sujet, $message, $entete); // Envoi du mail
    }
}