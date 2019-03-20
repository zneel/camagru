<?php
/**
 * Created by PhpStorm.
 * User: ebouvier
 * Date: 2019-02-24
 * Time: 14:50
 */
require_once '../config/database.php';
require_once '../models/UserManager.php';
require_once '../models/Db.php';
require_once '../services/ProfileForm.php';
require_once '../services/Auth.php';

if (!isset($_SESSION)) {
    session_start();
}

if (empty($_SESSION['user'])) {
    header('Location: /index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST)) {
    if (isset($_POST['username']) && isset($_POST['email'])) {
        $db = new Db($DB_DSN, $DB_NAME, $DB_USER, $DB_PASSWORD);
        $manager = new UserManager($db);
        $form = new ProfileForm();
        $valid = $form->validate($_POST);
        if ($valid) {
            $auth = new Auth();
            $_POST['password'] = !empty($_POST['password']) ? $auth->hashPassword($_POST['password']) : '';
            $user = $manager->updateProfile($_SESSION['user']['id'], $_POST, !empty($_POST['password']));
            $_SESSION['user']['username'] = $user->getUsername();
            $_SESSION['user']['email'] = $user->getEmail();
            $_SESSION['user']['receive_emails'] = (int)$user->getReceive_Emails();
            header('Location: /profil.php');
            exit();
        }
    }
}
header('Location: /profil.php');
exit();