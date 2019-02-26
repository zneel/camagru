<?php
/**
 * Created by PhpStorm.
 * User: ebouvier
 * Date: 2019-02-26
 * Time: 10:54
 */
require_once '../config/setup.php';
require_once ROOT . '/models/UserManager.php';
require_once ROOT . '/models/Db.php';
require_once ROOT . '/config/database.php';
require_once ROOT . '/services/ResetPasswordForm.php';
require_once ROOT . '/services/Auth.php';
if (!isset($_SESSION)) {
    session_start();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST)) {
    if (isset($_POST['username']) && isset($_POST['key'])) {
        $form = new ResetPasswordForm();
        $valid = $form->validate($_POST);
        if ($valid) {
            $db = new Db($DB_DSN, $DB_NAME, $DB_USER, $DB_PASSWORD);
            $userManager = new UserManager($db);
            $auth = new Auth();
            $user = $userManager->getUserByUsernameAndPasswordHash(htmlspecialchars($_POST['username']), htmlspecialchars($_POST['key']));
            $user->setPassword($auth->hashPassword($_POST['password']));
            $userManager->changePassword($user);
            header('Location: /login.php');
            exit();
        } else {
            $_SESSION['flash'] = [];
            $_SESSION['flash']['err'] = $form->getErrors();
            header(htmlspecialchars('Location: /reset_password.php?login=' . $_POST['username'] . '&key=' . $_POST['key']));
            exit();
        }
    }
}