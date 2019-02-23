<?php
/**
 * Created by PhpStorm.
 * User: ebouvier
 * Date: 2019-02-23
 * Time: 15:00
 */

require_once '../config/setup.php';
require_once ROOT . '/models/UserManager.php';
require_once ROOT . '/services/ResetPasswordForm.php';
require_once ROOT . '/models/Db.php';
require_once ROOT . '/config/database.php';
require_once ROOT . '/services/Auth.php';
if (!isset($_SESSION)) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST)) {
    $form = new ResetPasswordForm();
    $form->validate($_POST);
    var_dump($form);
    die();
}