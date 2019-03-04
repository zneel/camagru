<?php
/**
 * Created by PhpStorm.
 * User: ebouvier
 * Date: 2019-03-01
 * Time: 15:06
 */

if (!isset($_SESSION)) {
    session_start();
}
if (empty($_SESSION['user'])) {
    header('Location: /login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST)) {
    var_dump($_FILES);
    if ((!empty($_POST['webcamImage']) || !empty($_POST['fileUpload'])) && !empty($_POST['imageChoice'])) {
        if (!empty($_POST['webcamImage'])) {
            $outputFile = $_SERVER['DOCUMENT_ROOT'] . '/uploads/' . md5(time() . uniqid()) . ".jpg";
            $explode = explode(';base64', $_POST['webcamImage']);
            $decoded64 = base64_decode($explode[1]);
            file_put_contents($outputFile, $decoded64);
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
    }
    die();
}