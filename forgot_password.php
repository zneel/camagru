<?php
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
                    <h3 class="title has-text-grey">Mot de passe oublié ?</h3>
                    <p class="subtitle has-text-grey">What a shame...</p>
                    <div class="box">
                        <form action="actions/forgot_password.php" method="post">
                            <div class="field">
                                <div class="control">
                                    <input name="email" class="input " type="email" placeholder="Votre email" required
                                           autofocus="">
                                </div>
                            </div>
                            <button class="button is-block is-info  is-fullwidth">Reinitialiser le mot de passe</button>
                        </form>
                        <?php
                        if (isset($_SESSION['flash']['message'])) {
                            $message = $_SESSION['flash']['message'];
                            echo isset($message) ? '<p class="has-text-danger has-text-left-desktop">' . $message . '</p>' : '';
                        }
                        ?>
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