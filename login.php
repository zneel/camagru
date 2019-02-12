<?php
session_start();
?>
<html lang="fr">
<?php require 'head.php' ?>
<body>
<?php require 'navbar.php' ?>
<section class="hero is-fullheight">
    <div class="hero-body">
        <div class="container has-text-centered">
            <div class="column is-4 is-offset-4">
                <?php echo isset($_SESSION['flash']['email']) ? "<p id='mail-notif' class='notification is-primary'><button onclick='hideNotif()' class='delete'></button>
" . $_SESSION['flash']['email'] . "</p>" : null ?>
                <h3 class="title has-text-grey">Connection</h3>
                <div class="box">
                    <form action="index.php" method="post">
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
                        <button class="button is-block is-info  is-fullwidth">Connection</button>
                    </form>
                </div>
                <p class="has-text-grey">
                    <a href="index.php">Inscription</a> &nbsp;·&nbsp;
                    <a href="index.php">Mot de passe oublié</a> &nbsp;·&nbsp;
                </p>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function (event) {
            event.preventDefault();
            const hideNotif = function () {
                const x = document.getElementById('mail-notif');
                x.style.display = 'none';
            }
        });
    </script>
</section>
<?php require 'footer.php' ?>
</body>
</html>
