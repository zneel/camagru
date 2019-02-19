<?php
/**
 * Created by PhpStorm.
 * User: ebouvier
 * Date: 2019-02-12
 * Time: 22:12
 */

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET)) {
    require_once 'config/setup.php';
    require_once ROOT . '/models/UserManager.php';
    require_once ROOT . '/models/Db.php';
    require_once ROOT . '/config/database.php';
    require_once ROOT . '/services/Auth.php';
    $db = new Db($DB_DSN, $DB_NAME, $DB_USER, $DB_PASSWORD);
    $userManager = new UserManager($db);
    if (isset($_GET['login']) && isset($_GET['key'])) {
        $userManager->activateUser($_GET['login'], $_GET['key']);
        header('Location: /login.php');
        exit();
    } else {
        var_dump($_GET);
        die();
    }
}