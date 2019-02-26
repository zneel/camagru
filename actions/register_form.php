<?php
/**
 * Created by PhpStorm.
 * User: ebouvier
 * Date: 2019-02-12
 * Time: 20:08
 */
require_once '../config/setup.php';
require_once ROOT . '/models/UserManager.php';
require_once ROOT . '/services/RegisterForm.php';
require_once ROOT . '/models/Db.php';
require_once ROOT . '/config/database.php';
require_once ROOT . '/services/Auth.php';
if (!isset($_SESSION)) {
    session_start();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST)) {
    $registerForm = new RegisterForm();
    $valid = $registerForm->validate($_POST);
    if ($valid) {
        $db = new Db($DB_DSN, $DB_NAME, $DB_USER, $DB_PASSWORD);
        $manager = new UserManager($db);
        $user = new User($_POST);
        $auth = new Auth();
        $user->setEmail_Hash($auth->generateHash());
        $user->setPassword($auth->hashPassword($user->getPassword()));
        try {
            $manager->save($user);
            $auth->sendConfirmationEmail($user);
            $_SESSION['flash']['email'] = 'Un email de confirmation vous a ete envoye';

            header('Location: /login.php');
            exit();
        } catch (PDOException $e) {
            if ($e->errorInfo[1] == 1062) {
                $_SESSION['flash']['reg_err'] = [];
                array_push($_SESSION['flash']['reg_err'], ['Email ou nom d\'uttilisateur déjà utilisé']);
                header('Location: /register.php');
                exit();
            }
        }
    } else {
        foreach ($_POST as $k => $v) {
            $_POST[$k] = htmlspecialchars($v);
        }
        $_SESSION['form']['reg'] = $_POST;
        $_SESSION['flash']['reg_err'] = [];
        $_SESSION['flash']['reg_err'] = $registerForm->getErrors();
        header('Location: /register.php');
        exit();
    }
}
