<?php
/**
 * Created by PhpStorm.
 * User: ebouvier
 * Date: 2019-03-01
 * Time: 15:06
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
        $inputImage = imagecreatefromjpeg($imageFile);
        list($w, $h) = getimagesize($imageFile);
        if ($w > $h) {
            $new_height = 600;
            $new_width = floor($w * ($new_height / $h));
            $crop_x = ceil(($w - $h) / 2);
            $crop_y = 0;
        } else {
            $new_width = 800;
            $new_height = floor($h * ($new_width / $w));
            $crop_x = 0;
            $crop_y = ceil(($h - $w) / 2);
        }
        $outputImage = imagecreatetruecolor(800, 600);
        imagecopyresampled($outputImage, $inputImage, 0, 0, $crop_x, $crop_y, $new_width, $new_height, $w, $h);
        $outImagePath = '/tmp/' . md5(time() . uniqid()) . ".jpg";
        imagejpeg($outputImage, $outImagePath);
        imagedestroy($outputImage);
        $imageChoice = parse_url($_POST['imageChoice']);
        $src = imagecreatefrompng($_SERVER['DOCUMENT_ROOT'] . $imageChoice['path']);
        $dest = imagecreatefromjpeg($outImagePath);
        imagecopy($dest, $src, 0, 0, 0, 0, 800, 600);
        $outFinalPath = $_SERVER['DOCUMENT_ROOT'] . '/uploads/' . md5(time() . uniqid()) . ".jpg";
        imagejpeg($dest, $outFinalPath);
        imagedestroy($dest);
        imagedestroy($src);
        unlink($imageFile);
        unlink($outImagePath);
        $image->setPath($outFinalPath);
        $image->setUser($_SESSION['user']['id']);
        $imageManager->save($image);
        header('Location: /index.php');
        exit();
    }
    die();
}