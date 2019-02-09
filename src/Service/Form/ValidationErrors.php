<?php
/**
 * Created by PhpStorm.
 * User: ebouvier
 * Date: 2019-02-09
 * Time: 16:48
 */

namespace Camagru\Service\Form;


abstract class ValidationErrors
{
    const EMAIL_DIFFERENT = 'Les emails ne correspondent pas';
    const PASSWORD_DIFFERENT = 'Les mot de passes de correspondent pas';
    const INVALID_USERNAME = 'Le nom d\'uttilisateur n\'est pas valide';
    const INVALID_PASSWORD = 'Le mot de passe doit faire entre 8 et 12 caracteres et comporter au moins 1 maj, 1 min et un symbole';
    const INVALID_EMAIL = 'L\'email est invalide';
}