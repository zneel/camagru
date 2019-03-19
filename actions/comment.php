<?php
/**
 * Created by PhpStorm.
 * User: ebouvier
 * Date: 2019-03-18
 * Time: 13:59
 */

require_once '../config/database.php';
require_once '../models/CommentManager.php';
require_once '../models/Comment.php';
require_once '../models/ImageManager.php';
require_once '../services/CommentForm.php';
require_once '../models/Db.php';
require_once '../services/MailService.php';

if (!isset($_SESSION)) {
    session_start();
}

if (empty($_SESSION['user'])) {
    header('Location: /index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST)) {
    $commentForm = new CommentForm();
    $post = [];
    $post['comment'] = strip_tags($_POST['comment']);
    if ($commentForm->validate($post)) {
        $db = new Db($DB_DSN, $DB_NAME, $DB_USER, $DB_PASSWORD);
        $commentManager = new CommentManager($db);
        $imageManager = new ImageManager($db);
        $comment = new Comment();
        $comment->setUser($_SESSION['user']['id']);
        $comment->setComment($_POST['comment']);
        $comment->setImage($_SESSION['image_id']);
        $user = $imageManager->getUserFromImageId($_SESSION['image_id']);
        if (intval($user['receive_emails']) == 1) {
            MailService::notificationEmail($user['email']);
        }
        $commentManager->save($comment);
        header('Location: /comment.php?id=' . $_SESSION['image_id']);
        exit();
    }
    header('Location: /index.php');
    exit();
}