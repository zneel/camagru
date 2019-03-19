<?php
/**
 * Created by PhpStorm.
 * User: ebouvier
 * Date: 2019-03-18
 * Time: 09:37
 */
require_once 'config/database.php';
require_once 'models/ImageManager.php';
require_once 'models/CommentManager.php';
require_once 'models/Db.php';
$db = new Db($DB_DSN, $DB_NAME, $DB_USER, $DB_PASSWORD);
if (!isset($_SESSION)) {
    session_start();
}
$imageManager = new ImageManager($db);
$commentManager = new CommentManager($db);
$image = $imageManager->get(intval($_GET['id']));
if (empty($image)) {
    header('Location: /index.php');
    exit();
}
$comments = $commentManager->getComments($image['id']);
$_SESSION['image_id'] = $image['id'];
$date = new DateTime($image['created_at']);
$user_id = !empty($_SESSION['user']) ? $_SESSION['user']['id'] : 0;
$image['path'] = (str_replace($_SERVER['DOCUMENT_ROOT'], "", $image['path']));
?>
    <html lang="fr">
    <?php require 'head.php' ?>
    <body>
    <?php require 'navbar.php' ?>
    <div class="container">
        <h2 class="subtitle has-text-centered has-text-white">Nos photos</h2>
        <div class='columns'>
            <div class='column'>
                <div class="card">
                    <div class="card-image">
                        <figure class="image is-4by3">
                            <img src="<?php echo $image['path'] ?>" alt="camagru image">
                        </figure>
                    </div>
                    <div class="content">
                        <div style="margin: 5px 0" class="level">
                            <p style="margin: 0" class="level-left">Par: <?php echo $image['username'] ?></p>
                            <p style="padding-right: 5px; padding-top: 5px" class="has-text-right level-right">
                                <a href="actions/likehandler.php?image_id=<?php echo $image['id'] ?>&user_id=<?php echo $user_id ?>"
                                   class="button is-primary"><i style="padding-right: 3px"
                                                                class="fa fa-thumbs-up"></i><?php echo $image['likes'] ?>
                                </a>
                            </p>
                        </div>
                        <time datetime="<?php echo $date->format('Y-m-d H:i') ?>"><?php echo $date->format('H:i:s l jS F Y') ?></time>
                    </div>
                    <form action="actions/comment.php" method="POST">
                        <label for="comment">Ajouter un commentaire: </label>
                        <textarea style="margin-top: 5px" required class="textarea" name="comment"
                                  placeholder="Entrer votre commentaire"
                                  maxlength="1000" autofocus></textarea>
                        <button type="submit" style="margin-top: 5px" class="button is-success is-pulled-right">
                            Envoyer
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <?php
        if (!empty($comments)) {
            foreach ($comments as $comment) {
                $comment['comment'] = htmlentities($comment['comment']);
                if (intval($comment['user_id']) == intval($_SESSION['user']['id'])) {
                    echo <<< HTML
                    <article class="media">
                        <div class="media-content">
                            <div class="content">
                                <p>
                                    <strong>{$comment['username']}</strong>
                                    <br>
                                        {$comment['comment']}
                                    <br>
                                    <small><a href="actions/delete_comment.php?comment_id={$comment['id']}">Supprimer</a></small>
                                </p>
                            </div>
                        </div>
                    </article>
HTML;
                } else {
                    echo <<< HTML
                    <article class="media">
                        <div class="media-content">
                            <div class="content">
                                <p>
                                    <strong>{$comment['username']}</strong>
                                    <br>
                                        {$comment['comment']}
                                    <br>
                                </p>
                            </div>
                        </div>
                    </article>
HTML;
                }
            }
        } ?>
    </div>
    <?php require 'footer.php' ?>
    </body>
    </html>
<?php $_SESSION['flash'] = [] ?>