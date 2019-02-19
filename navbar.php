<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<nav class="navbar" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        <a class="navbar-item" href="#">
            <!--            <img alt="norminet" src="https://pbs.twimg.com/media/Db8uqDaX4AE6vA3.jpg" width="112" height="28">-->
        </a>
        <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false"
           data-target="">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>
    <div id="" class="navbar-menu">
        <div class="navbar-start">
            <a class="navbar-item" href="/">
                Accueil
            </a>
        </div>
        <?php if (empty($_SESSION['user'])) {
            echo <<<HTML
<div class="navbar-end">
            <div class="navbar-item">
                <div class="buttons">
                    <a class="button is-danger" href="register.php">
                        <strong>Inscription</strong>
                    </a>
                    <a class="button is-warning" href="login.php">
                        Connexion
                    </a>
                </div>
            </div>
        </div>
HTML;
        } else {
            echo <<<HTML
<div class="navbar-end">
            <div class="navbar-item">
                <div class="buttons">
                    <a class="button is-warning" href="/logout.php">
                        Deconnexion
                    </a>
                </div>
                <p>
                <a href="/profile/" {$_SESSION['user']['username']} ></a>
</p>
            </div>
        </div>
HTML;
        } ?>
    </div>
</nav>
<script>
    (function () {
        const burger = document.querySelector('.navbar-burger');
        const menu = document.querySelector('.navbar-menu');
        burger.addEventListener('click', function () {
            burger.classList.toggle('is-active');
            menu.classList.toggle('is-active');
        });
    })();
</script>