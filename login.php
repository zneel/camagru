<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!empty($_SESSION['user'])) {
    header('Location: /index.php');
    exit();
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
                <?php echo !empty($_SESSION['flash']['email']) ? "<p id='mail-notif' class='notification is-primary'><button id='delete-button' class='delete'></button>
" . $_SESSION['flash']['email'] . "</p>" : null ?>
                <h3 class="title has-text-grey">Connexion</h3>
                <div class="box">
                    <form action="actions/login_form.php" method="post">
                        <div class="field">
                            <div class="control">
                                <input name="username" class="input is-large" type="text" placeholder="Votre pseudo"
                                       required autofocus="">
                            </div>
                        </div>
                        <div class="field">
                            <div class="control">
                                <input name="password" class="input is-large" type="password" required
                                       placeholder="Votre mot de passe">
                            </div>
                        </div>
                        <button type="submit" class="button is-block is-info
                        is-fullwidth">Connexion
                        </button>
                        <?php if (!empty($_SESSION['flash']['log_err'])) {
                            echo '<p class="has-text-danger has-text-left-desktop">' . $_SESSION['flash']['log_err'] . '</p>';
                        } ?>
                    </form>
                </div>
                <p class="has-text-grey">
                    <a href="/register.php">Inscription</a> &nbsp;·&nbsp;
                    <a href="/forgot_password.php">Mot de passe oublié</a> &nbsp;·&nbsp;
                </p>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function (event) {
            event.preventDefault();
            const delButton = document.getElementById('delete-button');
            if (delButton) {
                document.getElementById('delete-button').addEventListener('click', () => delButton.parentElement.style
                    .display = 'none');
            }
        });
    </script>
</section>
<?php require 'footer.php' ?>
</body>
</html>
<?php $_SESSION['flash'] = [] ?>
