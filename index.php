<?php
require_once 'config/setup.php';
require_once ROOT . '/models/UserManager.php';
require_once ROOT . '/models/Db.php';
require_once ROOT . '/config/database.php';
require_once ROOT . '/services/Auth.php';
require_once 'home.php';
if (!isset($_SESSION)) {
    session_start();
}