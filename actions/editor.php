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

function imageCreateFromFilename(string $filename, string $ext = null)
{
    if (!file_exists($filename)) {
        throw new InvalidArgumentException('File "' . $filename . '" not found.');
    }
    if ($ext == null) {
        $explode = explode(".", $filename);
        $ext = end($explode);
    }
    switch ($ext) {
        case 'jpeg':
        case 'jpg':
            return imagecreatefromjpeg($filename);
            break;
        case 'png':
            return imagecreatefrompng($filename);
            break;
        default:
            throw new InvalidArgumentException('File "' . $filename . '" is not valid jpg, png image.');
            break;
    }
}

function handleImage(string $tmp_path, string $ext = null)
{
    $inputImage = imageCreateFromFilename($tmp_path, $ext);
    if (!$inputImage) {
        die("cannot create image from filename");
    }
    list($w, $h) = getimagesize($tmp_path);
    if ($w > $h) {
        $new_height = 600;
        $new_width = floor($w * ($new_height / $h));
    } else {
        $new_width = 800;
        $new_height = floor($h * ($new_width / $w));
    }
    $outputImage = imagecreatetruecolor(800, 600);
    imagecopyresampled($outputImage, $inputImage, 0, 0, 0, 0, $new_width, $new_height, $w, $h);
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
    unlink($tmp_path);
    unlink($outImagePath);
    return $outFinalPath;
}

if (!isset($_SESSION)) {
    session_start();
}
if (empty($_SESSION['user'])) {
    header('Location: /login.php');
    exit();
}

/**
 * @TODO: Handle file image upload handle errors.
 * @TODO: Check forms?
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST)) {
    if ((!empty($_POST['webcamImage']) || !empty($_FILES)) && !empty($_POST['imageChoice'])) {
        $imageFile = null;
        if (!empty($_POST['webcamImage'])) {
            $imageFile = $_SERVER['DOCUMENT_ROOT'] . '/uploads/' . md5(time() . uniqid()) . ".jpg";
            $explode = explode(';base64', $_POST['webcamImage']);
            $decoded64 = base64_decode($explode[1]);
            $ext = substr($explode[0], 11);
            file_put_contents($imageFile, $decoded64);
            $outFinalPath = handleImage($imageFile, $ext);
        } elseif ($_FILES["fileUpload"]["error"] == 0) {
            $mimeTypes = ['png' => 'image/png',
                'jpe' => 'image/jpeg',
                'jpeg' => 'image/jpeg',
                'jpg' => 'image/jpeg'];
            if (in_array(mime_content_type($_FILES["fileUpload"]['tmp_name']), $mimeTypes)
                && $_FILES["fileUpload"]['size'] <= 2000000) {
                $name = $_FILES["fileUpload"]["name"];
                $explode = explode(".", $name);
                $end = end($explode);
                $ext = strtolower($end);
                $outFinalPath = handleImage($_FILES['fileUpload']['tmp_name'], $ext);
            }
        } else {
            header('Location: /editor.php');
            exit();
        }
        $image = new Image();
        $db = new Db($DB_DSN, $DB_NAME, $DB_USER, $DB_PASSWORD);
        $imageManager = new ImageManager($db);
        $user = new User($_SESSION['user']);
        $image->setPath($outFinalPath);
        $image->setUser($_SESSION['user']['id']);
        $imageManager->save($image);
        header('Location: /index.php');
        exit();
    }
    header('Location: /editor.php');
    exit();
}
