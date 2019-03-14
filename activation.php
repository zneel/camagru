<?php
/**
 * Created by PhpStorm.
 * User: ebouvier
 * Date: 2019-02-12
 * Time: 22:12
 */
require_once 'config/database.php';
require_once 'models/UserManager.php';
require_once 'models/Db.php';
require_once 'services/Auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET)) {
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