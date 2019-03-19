<?php
/**
 * Created by PhpStorm.
 * User: ebouvier
 * Date: 2019-03-19
 * Time: 09:57
 */

require_once '../config/database.php';
require_once '../models/CommentManager.php';
require_once '../models/Comment.php';
require_once '../services/CommentForm.php';
require_once '../models/Db.php';

if (!isset($_SESSION)) {
    session_start();
}

if (empty($_SESSION['user'])) {
    header('Location: /index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET)) {
    $db = new Db($DB_DSN, $DB_NAME, $DB_USER, $DB_PASSWORD);
    $commentManager = new CommentManager($db);
    $comment = $commentManager->get(intval($_GET['comment_id']));
    if (!empty($comment) && $_SESSION['user']['id'] == $comment['user_id']) {
        $commentManager->delete($comment['id']);
    }
    header('Location: /comment.php?id=' . $_SESSION['image_id']);
    exit();
}