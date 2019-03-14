<?php

require_once 'config/database.php';
require_once 'models/UserManager.php';
require_once 'models/Db.php';
require_once 'services/Auth.php';
require_once 'home.php';
if (!isset($_SESSION)) {
    session_start();
}