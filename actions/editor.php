<?php
/**
 * Created by PhpStorm.
 * User: ebouvier
 * Date: 2019-03-01
 * Time: 15:06
 */

if (!isset($_SESSION)) {
    session_start();
}
//if (empty($_SESSION['user'])) {
//    header('Location: /index.php');
//    exit();
//}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST)) {
    var_dump($_POST);
    die();
}