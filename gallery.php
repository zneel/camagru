<?php
/**
 * Created by PhpStorm.
 * User: ebouvier
 * Date: 2019-02-27
 * Time: 09:29
 */
require_once 'config/setup.php';
require_once 'models/ImageManager.php';
require_once 'models/Db.php';
require_once 'config/database.php';
if (isset($_GET['page'])) {
    $offset = $_GET['page'];
} else {
    $offset = 1;
}

$db = new Db($DB_DSN, $DB_NAME, $DB_USER, $DB_PASSWORD);
$limit = 6;
function getPagination($db, $inc)
{
    $imageManager = new ImageManager($db);
    $nb = ceil((int)$imageManager->countImages() / $inc);

    for ($i = 1; $i <= $nb; $i++) {
        echo <<<HTML
            <li>
                <a class="pagination-link" aria-label="Page {$i}" href="index.php?page={$i}" aria-current="page">$i</a>
            </li>
HTML;
    }
}

function getImages($db, $limit, $offset)
{
    $imageManager = new ImageManager($db);
    foreach ($imageManager->get6($limit, $offset) as $row) {
        $date = new DateTime($row['created_at']);
        $row['path'] = str_replace($_SERVER['DOCUMENT_ROOT'], "", $row['path']);
        echo <<<HTML
             <div class='column is-4'>
                <div class="card">  
                    <div class="card-image">
                        <figure class="image is-4by3">
                            <img src="{$row['path']}" alt="camagru image">
                        </figure>
                    </div>
                    <div class="content">
                        <div style="margin: 5px 0" class="level">
                            <p style="margin: 0" class="level-left">{$row['username']}</p>
                            <p class="has-text-right level-right">
                                <a class="button is-default"><i class="fa fa-thumbs-up"></i> 5254</a>
                                <a class="button is-default"><i class="fa fa-thumbs-down"></i> 1</a>
                            </p>
                        </div>
                        <time datetime="2016-1-1">{$date->format('H:i:s l jS F Y')}</time>
                    </div>
                </div>
            </div>
HTML;
    }
}

if (!isset($_SESSION)) {
    session_start();
}
?>
<div class="container">
    <h2 class="subtitle has-text-centered has-text-white">Nos photos</h2>
    <div class='columns is-multiline'>
        <?php
        getImages($db, $limit, $offset);
        ?>
        <div class="column is-full">
            <nav class="pagination is-centered" role="navigation" aria-label="pagination">
                <ul class="pagination-list">
                    <?php getPagination($db, $limit) ?>
                </ul>
            </nav>
        </div>
    </div>
</div>