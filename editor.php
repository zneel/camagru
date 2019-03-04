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
    $dir = array_diff(scandir('./assets/filters'), array('..', '.'));
    foreach ($dir as $k) {
        echo <<< HTML
            <img onclick="turfu(this);" src="assets/filters/{$k}"</img>        
HTML;

    }
}

?>
<html lang="fr">
<?php require 'head.php' ?>
<body>
<?php require 'navbar.php' ?>
<section class="container">
    <style>
        video, canvas {
            max-width: 400px;
            height: auto;
            margin: 0;
            padding: 0;
        }
    </style>
    <div style="margin: 25px 0" class="is-centered tabs is-toggle is-toggle-rounded">
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
        <div style="" class="column box is-three-quarters is-full-mobile">
            <div id="content">
                <div id="webCamSide" class="column">
                    <h3 class="has-text-weight-bold">Webcam:</h3>
                    <div style="position: relative;">
                        <video style="position: absolute" onclick="snapshot(this);"
                               id="video" autoplay></video>
                        <canvas style="position: relative" id="videoCanvas"></canvas>
                    </div>
                    <br>
                    <br><br><br><br><br><br><br><br><br><br><br><br>
                    <div class="is-4by3">
                        <canvas id="canvas"></canvas>
                    </div>
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
                <figure class="image is-64x64" style="display: flex; flex-direction: row;margin: 10px 0;">
                    <?php getImages() ?>
                </figure>
            </div>
        </div>
        <div class="column is-one-quarter box">
            <h3 class="has-text-weight-bold">Mes photos:</h3>
        </div>
    </div>
</section>
<?php require 'footer.php' ?>
</body>
</html>