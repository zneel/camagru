<?php
/**
 * Created by PhpStorm.
 * User: ebouvier
 * Date: 2019-03-20
 * Time: 16:15
 */

require_once '../config/database.php';
require_once '../models/ImageManager.php';
require_once '../models/Image.php';
require_once '../models/Db.php';

if (!isset($_SESSION)) {
    session_start();
}

if (empty($_SESSION['user'])) {
    header('Location: /login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET) && !is_string($_GET['page'])) {
    $db = new Db($DB_DSN, $DB_NAME, $DB_USER, $DB_PASSWORD);
    $imageManager = new ImageManager($db);
    $image = $imageManager->get(intval(abs(intval($_GET['image_id']))));
    if (!empty($image) && $_SESSION['user']['id'] == $image['user_id']) {
        unlink($image['path']);
        $imageManager->delete($image['id']);
    }
    header('Location: /editor.php');
    exit();
}
header('Location: /editor.php');
exit();