<?php
/**
 * Created by PhpStorm.
 * User: ebouvier
 * Date: 2019-02-15
 * Time: 17:41
 */
require_once '../config/setup.php';
require_once ROOT . '/models/UserManager.php';
require_once ROOT . '/models/Db.php';
require_once ROOT . '/config/database.php';
require_once ROOT . '/services/Auth.php';

session_start();
if (isset($_SESSION['user'])) {
    header('Location: /index.php');
    exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST)) {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $db = new Db($DB_DSN, $DB_NAME, $DB_USER, $DB_PASSWORD);
        $manager = new UserManager($db);
        $user = $manager->getUserByUsername($_POST['username']);
        if (!empty($user)) {
            $auth = new Auth($db);
            if (empty($user->getVerifiedAt())) {
                var_dump($user->getVerifiedAt());
                die();
                $_SESSION['flash']['log_err'] = [];
                $_SESSION['flash']['log_err'] = 'Votre compte n\'est pas confirme.';
                header("Location: /login.php");
                exit();
            }
            $authenticated = $auth->authenticate($user, $_POST['password']);
            if ($authenticated) {
                $user->setPassword('');
                $_SESSION['user']['username'] = $user->getUsername();
            } else {
                $_SESSION['flash']['log_err'] = 'Mauvais nom d\'uttilisateur ou mot de passe.';
                header('Location: /login.php');
                exit();
            }
        }
        header('Location: /login.php');
        exit();
    }
}
