<?php
/**
 * Created by PhpStorm.
 * User: ebouvier
 * Date: 2019-03-01
 * Time: 15:06
 */

require_once '../config/setup.php';
require_once ROOT . '/models/ImageManager.php';
require_once ROOT . '/services/ImageService.php';
require_once ROOT . '/models/Image.php';
require_once ROOT . '/models/Db.php';
require_once ROOT . '/config/database.php';

if (!isset($_SESSION)) {
    session_start();
}
if (empty($_SESSION['user'])) {
    header('Location: /login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST)) {
    if ((!empty($_POST['webcamImage']) || !empty($_POST['fileUpload'])) && !empty($_POST['imageChoice'])) {
        $imageFile = null;
        if (!empty($_POST['webcamImage'])) {
            $imageFile = $_SERVER['DOCUMENT_ROOT'] . '/uploads/' . md5(time() . uniqid()) . ".jpg";
            $explode = explode(';base64', $_POST['webcamImage']);
            $decoded64 = base64_decode($explode[1]);
            file_put_contents($imageFile, $decoded64);
        } else if (!empty($_POST['fileUpload'])) {
            $mimeTypes = ['png' => 'image/png',
                'jpe' => 'image/jpeg',
                'jpeg' => 'image/jpeg',
                'jpg' => 'image/jpeg'];
            if (in_array(mime_content_type($_POST['fileUpload']), $mimeTypes)) {
                var_dump($_POST['fileUpload']);
                die();
            }
        } else {
            header('Location: /editor.php');
        }
        $image = new Image();
        $db = new Db($DB_DSN, $DB_NAME, $DB_USER, $DB_PASSWORD);
        $imageManager = new ImageManager($db);
        $user = new User($_SESSION['user']);
        $image->setPath($imageFile);
        $image->setUser($_SESSION['user']['id']);
        $imageManager->save($image);
        $imageService = new ImageService($image->getPath(), $_POST['imageChoice']);
        $imageService->merge();
        header('Content-type: image/png');
        imagepng($imageService->getImage());
        imagedestroy($imageService->getImage());
        die();
    }
    die();
}