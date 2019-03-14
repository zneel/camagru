<?php
/**
 * Created by PhpStorm.
 * User: ebouvier
 * Date: 2019-02-23
 * Time: 15:00
 */

require_once '../config/database.php';
require_once '../models/UserManager.php';
require_once '../services/ForgotPasswordForm.php';
require_once '../models/Db.php';
require_once '../services/Auth.php';
if (!isset($_SESSION)) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST)) {
    $db = new Db($DB_DSN, $DB_NAME, $DB_USER, $DB_PASSWORD);
    $form = new ForgotPasswordForm();
    $valid = $form->validate($_POST);
    if ($valid) {
        $auth = new Auth();
        $manager = new UserManager($db);
        $user = $manager->getUserByEmail($_POST['email']);
        if (empty($user)) {
            $_SESSION['flash']['message'] = 'Un email vous a été envoyé';
            header('Location: /forgot_password.php');
            exit();
        } else {
            $hash = $auth->generateHash();
            $manager->generatePasswordHash($user->getId(), $hash);
            $user->setPassword_Hash($hash);
            $auth->sendResetPasswordEmail($user);
            $_SESSION['flash']['message'] = 'Un email vous a été envoyé';
            header('Location: /forgot_password.php');
            exit();
        }
    } else {
        $_SESSION['flash']['message'] = 'Un email vous a été envoyé';
        header('Location: /forgot_password.php');
        exit();
    }
}