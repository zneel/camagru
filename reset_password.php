<?php
/**
 * Created by PhpStorm.
 * User: ebouvier
 * Date: 2019-02-26
 * Time: 09:24
 */

if (!isset($_SESSION)) {
    session_start();
    if (!empty($_SESSION['user'])) {
        header('Location: /index.php');
        exit();
    }
}
?>
<html lang="fr">
<?php require 'head.php' ?>
<body>
<?php require 'navbar.php' ?>
<section class="hero is-fullheight">
    <div class="hero-body">
        <div class="container has-text-centered">
            <div class="column is-4 is-offset-4">
                <h3 class="title has-text-grey">Reinitialiser le mot de passe</h3>
                <div class="box">
                    <form action="actions/reset_password.php" method="post">
                        <div class="field">
                            <div class="control">
                                <input name="password" class="input" type="password" placeholder="Nouveau mot de passe"
                                       required
                                       autofocus="">
                            </div>
                        </div>
                        <div class="field">
                            <div class="control">
                                <input name="cpassword" class="input" type="password"
                                       placeholder="Confirmer votre nouveau mot de passe" required
                                >
                            </div>
                        </div>
                        <input type="hidden" name='username' value=<?php echo htmlspecialchars($_GET['login']) ?>>
                        <input type="hidden" name='key' value=<?php echo htmlspecialchars($_GET['key']) ?>>
                        <button class="button is-block is-info  is-fullwidth">Reinitialiser le mot de passe</button>
                    </form>
                    <ul>
                        <?php
                        if (!empty($_SESSION['flash']['err'])) {
                            foreach ($_SESSION['flash']['err'] as $a) {
                                foreach ($a as $k => $v) {
                                    echo '<li class="has-text-danger has-text-left-desktop">' . $v . '</li>';
                                }
                            }
                        }
                        ?>
                    </ul>
                </div>
                <p class="has-text-grey">
                    <a href="/login.php">Connexion</a>
                </p>
            </div>
        </div>
    </div>
</section>
<?php require 'footer.php' ?>
</body>
</html>
<?php $_SESSION['flash'] = [] ?>