<?php
/**
 * Created by PhpStorm.
 * User: ebouvier
 * Date: 2019-02-12
 * Time: 20:08
 */
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST)) {
    require_once '../config/setup.php';
    require_once ROOT . '/models/UserManager.php';
    require_once ROOT . '/services/RegisterForm.php';
    require_once ROOT . '/models/Db.php';
    require_once ROOT . '/config/database.php';
    require_once ROOT . '/services/Auth.php';
    $registerForm = new RegisterForm();
    $valid = $registerForm->validate($_POST);
    if ($valid) {
        $db = new Db($DB_DSN, $DB_NAME, $DB_USER, $DB_PASSWORD);
        $manager = new UserManager($db);
        $user = new User($_POST);
        $user->setEmailHash(bin2hex(random_bytes(20)));
        $auth = new Auth($db);
        $auth->sendConfirmationEmail($user);
        $manager->save($user);
        $_SESSION['flash']['email'] = 'Un email de confirmation vous a ete envoye';
        header('Location: /login.php');
    } else {
        $_SESSION['form']['reg'] = $_POST;
        $_SESSION['flash']['reg_err'] = [];
        $_SESSION['flash']['reg_err'] = $registerForm->getErrors();
        header('Location: /register.php');
        exit();
    }
}
