<?php
/**
 * Created by PhpStorm.
 * UserManager: ebouvier
 * Date: 2019-02-09
 * Time: 16:48
 */

abstract class ValidationErrors
{
    const EMAIL_DIFFERENT = 'Les emails ne correspondent pas';
    const PASSWORD_DIFFERENT = 'Les mot de passes de correspondent pas';
    const INVALID_USERNAME = 'Le nom d\'uttilisateur doit faire entre 2 et 13 caracteres';
    const INVALID_PASSWORD = 'Le mot de passe doit faire entre 4 et 16 caracteres et comporter au moins 1 maj, 1 min et 1 chiffre';
    const INVALID_EMAIL = 'L\'email est invalide';
    const COMMENT_ERROR = 'Le commentaire est trop long ou contient des caracteres invalides';
}