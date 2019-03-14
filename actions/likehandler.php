<?php
/**
 * Created by PhpStorm.
 * User: ebouvier
 * Date: 2019-03-14
 * Time: 10:31
 */

require_once '../config/database.php';
require_once '../models/LikeManager.php';
require_once '../models/ImageManager.php';
require_once '../models/Db.php';


if (!isset($_SESSION)) {
    session_start();
}

if (empty($_SESSION['user'])) {
    header('Location: /login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET)) {
    if (isset($_GET['image_id']) && isset($_GET['user_id'])) {
        if ((int)$_SESSION['user']['id'] !== (int)$_GET['user_id']) {
            header('Location: /index.php');
            exit();
        }
        $db = new Db($DB_DSN, $DB_NAME, $DB_USER, $DB_PASSWORD);
        $likesManager = new LikeManager($db);
        $imageManager = new ImageManager($db);
        if ($imageManager->get((int)$_GET['image_id']) != NULL) {
            $likesManager->likeDislike((int)$_GET['user_id'], (int)$_GET['image_id']);
        }
        header('Location: /index.php');
        exit();
    }
}