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
    var_dump($_POST);
    die();
    if (isset($_POST['username'])) {
        $db = new Db($DB_DSN, $DB_NAME, $DB_USER, $DB_PASSWORD);
        $manager = new UserManager($db);
        $form = new ProfileForm();
        $valid = $form->validate($_POST);
        $user = $manager->get($_SESSION['user']['id']);
    }
}