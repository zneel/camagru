<?php
/**
 * Created by PhpStorm.
 * User: ebouvier
 * Date: 2019-02-27
 * Time: 11:24
 */

require_once 'config/database.php';
require_once 'models/ImageManager.php';
require_once 'models/Db.php';
$db = new Db($DB_DSN, $DB_NAME, $DB_USER, $DB_PASSWORD);
function getImages()
{
    $dir = array_diff(scandir('./assets/filters'), array('..', '.', '.DS_Store'));
    foreach ($dir as $k) {
        echo <<< HTML
            <img onclick="turfu(this);" src="assets/filters/{$k}" alt="{$k}"</img>        
HTML;
    }
}

function getMyImages($db, $user_id)
{
    if ($user_id !== null) {
        $imageManager = new ImageManager($db);
        $images = $imageManager->getImagesByUserId($user_id);
        if (!empty($images)) {
            foreach ($images as $key => $image) {
                $image['path'] = str_replace("/var/www/camagru/", "", $image['path']);
                echo <<< HTML
                <div class="column">
                 <figure class="image is-128x128">
                    <div style="position: relative">
                        <a style="position: absolute; left: 92%; bottom: 90%;" href="actions/delete_image.php?image_id={$image['id']}" class="delete is-medium"></a>
                        <img class="img-responsive" src="{$image['path']}" alt="camagru-image">
                    </div>
                 </figure>
                </div>
HTML;
            }
        }
    }
}

if (!isset($_SESSION)) {
    session_start();
}
if (empty($_SESSION['user'])) {
    header('Location: /login.php');
    exit();
}

?>
<html lang="fr">
<?php require 'head.php' ?>
<style>
    #canvas {
        max-width: 100%;
        height: auto;
    }

    .img-responsive {
        display: block;
        max-width: 100%;
        height: auto;
    }
</style>
<body>
<?php require 'navbar.php' ?>
<section class="section">
    <div style="margin: 35px 0" class="is-centered tabs is-toggle is-toggle-rounded">
        <ul>
            <li id="webCamClick" onclick="showWebcam()" class="is-active">
                <a>
                    <span class="icon is-small"><i class="fas fa-camera"></i></span>
                    <span>Webcam</span>
                </a>
            </li>
            <li id="uploadClick" onclick="showUpload()">
                <a>
                    <span class="icon is-small"><i class="fas fa-upload"></i></span>
                    <span>Upload</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="columns">
        <div style="" class="column box is-full-mobile">
            <div id="content">
                <div id="webCamSide">
                    <h3 class="has-text-weight-bold">Webcam:</h3>
                    <figure class="img-responsive">
                        <video id="video" width="800" height="600" autoplay></video>
                    </figure>
                    <figure class="img-responsive">
                        <canvas id="canvas" width="800" height="600" ></canvas>
                    </figure>
                    <hr>
                    <button id="captureButton" class="button is-warning" onclick="snapshot();" disabled>Prendre une
                        photo
                    </button>
                    <form action="actions/editor.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="imageChoice" class="imageChoice" hidden>
                        <input type="hidden" name="webcamImage" id="webcamImage" hidden>
                        <button id="submitWebcam" style="margin: 10px 0" class="button is-primary" disabled
                                type="submit">Envoyer mon montage
                        </button>
                    </form>
                </div>
            </div>
            <div id="fileUploadSide" class="is-hidden">
                <form action="actions/editor.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="MAX_FILE_SIZE" value="2000000"/>
                    <div class="file">
                        <label class="file-label">
                            <input id="fileInput" class="file-input" required type="file"
                                   accept="image/x-png,image/jpg,image/jpeg"
                                   name="fileUpload">
                            <span class="file-cta">
                                <span class="file-icon">
        <i class="fas fa-upload"></i>
      </span>
                                    <span class="file-label">
                                        Uploader une photo
                                    </span>
                                </span>
                        </label>
                    </div>
                    <input type="hidden" name="imageChoice" class="imageChoice" hidden>
                    <button id="submitUpload" style="margin: 10px 0" class="button is-primary"
                            type="submit">Envoyer mon montage
                    </button>
                </form>
            </div>
            <div style="margin: 10px 0;overflow: auto;">
                <figure id="imageList" class="image is-64x64"
                        style="display: flex; flex-direction: row;margin: 10px 0;">
                    <?php getImages() ?>
                </figure>
            </div>
        </div>
        <div style="margin-bottom: 20px" class="column box">
            <h3 class="has-text-weight-bold">Mes photos:</h3>
            <div class="columns is-multiline">
                <?php getMyImages($db, $_SESSION['user']['id']) ?>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript" src="assets/js/webcam.js"></script>
<?php require 'footer.php' ?>
</body>
</html>