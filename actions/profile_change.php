<?php
/**
 * Created by PhpStorm.
 * User: ebouvier
 * Date: 2019-02-24
 * Time: 14:50
 */
require_once '../config/setup.php';
require_once ROOT . '/models/UserManager.php';
require_once ROOT . '/models/Db.php';
require_once ROOT . '/config/database.php';
require_once ROOT . '/services/ProfileForm.php';
require_once ROOT . '/services/Auth.php';

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
            $auth = new Auth($db);
            $_POST['password'] = !empty($_POST['password']) ? $auth->hashPassword($_POST['password']) : '';
            $user = $manager->updateProfile($_SESSION['user']['id'], $_POST, !empty($_POST['password']));
            $_SESSION['user']['username'] = $user->getUsername();
            $_SESSION['user']['email'] = $user->getEmail();
            $_SESSION['user']['receive_emails'] = (int)$user->getReceive_Emails();
            header('Location: /profile.php');
            exit();
        } else {
            header('Location: /profile.php');
            exit();
        }
    }
}
header('Location: /404.php');
exit();