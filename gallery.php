<?php
/**
 * Created by PhpStorm.
 * User: ebouvier
 * Date: 2019-02-27
 * Time: 09:29
 */
require_once 'config/database.php';
require_once 'models/ImageManager.php';
require_once 'models/Db.php';
if (isset($_GET['page']) && ctype_digit($_GET['page']) && $_GET['page'] != 0) {
    $offset = abs(intval($_GET['page']));
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
        $user_id = !empty($_SESSION['user']) ? $_SESSION['user']['id'] : 0;
        $row['path'] = str_replace($_SERVER['DOCUMENT_ROOT'], "", $row['path']);
        if (!file_exists($_SERVER['DOCUMENT_ROOT'].$row['path'])) {
            $row["path"] = "https://i1.wp.com/www.ecommerce-nation.com/wp-content/uploads/2018/10/404-error.jpg?fit=800%2C600&ssl=1";
        }
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
                            <p style="margin: 0" class="level-left">Par: {$row['username']}</p>
                            <p style="padding-right: 5px; padding-top: 5px" class="has-text-right level-right">
                                <a href="actions/likehandler.php?image_id={$row['id']}&user_id={$user_id}" class="button is-primary"><i style="padding-right: 3px" class="fa fa-thumbs-up"></i> {$row['likes']}</a>
                            </p>
                        </div>
                        <p style="margin: 5px;" class="is-pulled-right">
                            <a href="comment.php?id={$row['id']}" class=""><i style="padding-right: 3px" class="fas fa-comments"></i>Commentaires</a>
                        </p>
                        <time datetime="{$date->format('Y-MM-DD H:i')}">{$date->format('H:i:s l jS F Y')}</time>
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
    <h2 class="subtitle has-text-centered">Nos photos</h2>
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