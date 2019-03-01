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
    <div style="margin-top: 10px" class="columns box">
        <div class="column is-three-fifths">
            <h3 class="has-text-weight-bold">Webcam:</h3>
            <div>
                <video style="position: absolute" class="image" onclick="snapshot(this);" width="680" height="383"
                       id="video" autoplay></video>
                <canvas style="position: relative" class="image" width="680" height="383" id="videoCanvas"></canvas>
            </div>
            <div style="margin: 10px 0">
                <figure class="image is-64x64" style="display: flex; flex-direction: row;margin: 10px 0;">
                    <?php getImages() ?>
                </figure>
                <button id="captureButton" class="button is-warning" onclick="snapshot();" disabled>Prendre une photo
                </button>
            </div>
            <form action="actions/editor.php" method="post">
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
                <input type="hidden" name="imageChoice" id="imageChoice" hidden>
                <input type="hidden" name="webcamImage" id="webcamImage" hidden>
                <button style="margin: 10px 0" class="button" type="submit">Envoyer mon montage</button>
            </form>
            <figure class="is-16by9 has-shadow">
                <canvas class="" id="canvas" width="480" height="270"></canvas>
            </figure>
        </div>
        <div style="margin-left: 10px;" class="column is-two-fifths box">
            <h3 class="has-text-weight-bold">Mes photos:</h3>
        </div>
    </div>
</section>
<script src="assets/js/webcam.js" type="text/javascript"></script>
<?php require 'footer.php' ?>
</body>
</html>