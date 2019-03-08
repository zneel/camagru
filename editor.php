<?php
/**
 * Created by PhpStorm.
 * User: ebouvier
 * Date: 2019-02-27
 * Time: 11:24
 */
if (!isset($_SESSION)) {
    session_start();
}
if (empty($_SESSION['user'])) {
    header('Location: /login.php');
    exit();
}

function getImages()
{
    $dir = array_diff(scandir('./assets/filters'), array('..', '.', '.DS_Store'));
    foreach ($dir as $k) {
        echo <<< HTML
            <img onclick="turfu(this);" src="assets/filters/{$k}" alt="{$k}"</img>        
HTML;

    }
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
                        <video id="video" autoplay></video>
                    </figure>
                    <figure class="img-responsive">
                        <canvas id="canvas"></canvas>
                    </figure>
                    <hr>
                    <button id="captureButton" class="button is-warning" onclick="snapshot();" disabled>Prendre une
                        photo
                    </button>
                    <form action="actions/editor.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="imageChoice" id="imageChoice" hidden>
                        <input type="hidden" name="webcamImage" id="webcamImage" hidden>
                        <button id="submitWebcam" style="margin: 10px 0" class="button is-primary" disabled
                                type="submit">Envoyer mon montage
                        </button>
                    </form>
                </div>
            </div>
            <div id="fileUploadSide" class="is-hidden">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="file">
                        <label class="file-label">
                            <input class="file-input" type="file" accept="image/*" name="fileUpload">
                            <span class="file-cta">
                                    <span class="file-label">
                                        Uploader une photo
                                    </span>
                                </span>
                        </label>
                    </div>
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
        </div>
    </div>
</section>
<script type="text/javascript" src="assets/js/webcam.js"></script>
<?php require 'footer.php' ?>
</body>
</html>