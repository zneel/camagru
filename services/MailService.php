<?php
/**
 * Created by PhpStorm.
 * User: ebouvier
 * Date: 2019-03-19
 * Time: 13:34
 */

abstract class MailService
{
    public static function notificationEmail(string $email)
    {
        $destinataire = $email;
        $sujet = "Vous avez recu un commentaire";
        $entete = "From: noreply@camagru.fr";

        $message = 'Vous avez recu un nouveau commentaire sur votre photo!
        
        
        
---------------
Ceci est un mail automatique, Merci de ne pas y répondre.';
        mail($destinataire, $sujet, $message, $entete);
    }
}