<?php
/**
 * Created by PhpStorm.
 * User: ebouvier
 * Date: 2019-02-23
 * Time: 17:00
 */

if (!isset($_SESSION)) {
    session_start();
}
if (empty($_SESSION['user'])) {
    header('Location: /index.php');
    exit();
}
$checkbox = $_SESSION['user']['receive_emails'] ? "<input  type=\"checkbox\" name=\"receive_emails\" checked>" : "<input  type=\"checkbox\" name=\"receive_emails\">"
?>
<html lang="fr">
<?php require 'head.php' ?>
<body>
<?php require 'navbar.php' ?>
<section class="hero is-fullheight">
    <div class="hero-body">
        <div class="container">
            <div class="column is-4 is-offset-4">
                <h3 class="title has-text-grey">Profile</h3>
                <?php
                if (!empty($_SESSION['user'])) {
                    echo <<<HTML
                    <form action="actions/profile_change.php" method="post">
                <div class="field">
                  <label class="label">Nom d'utilisateur</label>
                  <div class="control">
                    <input name="username" class="input" autocomplete="username" type="text" placeholder="Nom d'uttilisateur" 
                    value="{$_SESSION['user']['username']}">
                  </div>
                </div>
                <div class="field">
                  <label class="label">Email</label>
                  <div class="control">
                    <input name="email" class="input" type="email" autocomplete="email" placeholder="Email"
                    value="{$_SESSION['user']['email']}">
                  </div>
                </div>
                <div class="field">
                  <label class="label">Mot de passe</label>
                  <div class="control">
                    <input name="password" class="input" autocomplete="current-password" type="password" placeholder="Mot de passe">
                  </div>
                </div>
                <div class="field">
                  <label class="checkbox">
                    <input type="hidden" name="receive_emails" class="checkbox" value="{$_SESSION['user']['receive_emails']}">
                    {$checkbox}
                            Recevoir notifications
                </label>
                </div>
                    <button class="button is-info" type="submit">
                        <strong>Valider</strong>
                    </button>
</form>
HTML;
                } else {
                    header('Location: /login.php');
                    exit();
                }
                ?>
            </div>
        </div>
    </div>
</section>
<?php require 'footer.php' ?>
</body>
</html>