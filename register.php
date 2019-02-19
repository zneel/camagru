<?php
if (!isset($_SESSION)) {
    session_start();
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
                <h3 class="title has-text-grey">Inscription</h3>
                <p class="subtitle has-text-grey">Inscrivez vous des maintenant!</p>
                <div class="box">
                    <form action="actions/register_form.php" method="post">
                        <div class="field">
                            <div class="control">
                                <input name="username" class="input " type="text" placeholder="Votre pseudo" required
                                       value="<?php echo isset($_SESSION['form']['reg']) ? $_SESSION['form']['reg']['username']
                                           : null ?>"
                                       autofocus="">
                            </div>
                        </div>
                        <div class="field">
                            <div class="control">
                                <input name="email" class="input " type="email" placeholder="Votre email" required
                                       value="<?php echo isset($_SESSION['form']['reg']) ? $_SESSION['form']['reg']['email']
                                           : null ?>"
                                       autofocus="">
                            </div>
                        </div>
                        <div class="field">
                            <div class="control">
                                <input name="cemail" class="input " type="email" placeholder="Confirmer votre email"
                                       value="<?php echo isset($_SESSION['form']['reg']) ? $_SESSION['form']['reg']['cemail']
                                           : null ?>"
                                       required
                                       autofocus="">
                            </div>
                        </div>
                        <div class="field">
                            <div class="control">
                                <input name="password" class="input " type="password" required
                                       placeholder="Votre mot de passe">
                            </div>
                        </div>
                        <div class="field">
                            <div class="control">
                                <input name="cpassword" class="input " type="password" required
                                       placeholder="Confirmer votre mot de passe">
                            </div>
                        </div>
                        <button class="button is-block is-info  is-fullwidth">Inscription</button>
                        <?php if (!empty($_SESSION['flash']['reg_err'])) {
                            foreach ($_SESSION['flash']['reg_err'] as $keys) {
                                echo '<ul>';
                                foreach ($keys as $key => $val) {
                                    echo '<li class="has-text-danger has-text-left-desktop">' . $val . '</li>';
                                }
                                echo '</ul>';
                            }
                        } ?>
                    </form>
                </div>
                <p class="has-text-grey">
                    <a href="/login.php">Connexion</a> &nbsp;·&nbsp;
                    <a href="/reset_password.php">Mot de passe oublié</a> &nbsp;·&nbsp;
                </p>
            </div>
        </div>
    </div>
</section>
<?php require 'footer.php' ?>
</body>
</html>
<?php $_SESSION['flash']['reg_err'] = [] ?>
