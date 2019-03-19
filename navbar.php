<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<nav class="navbar is-fixed-top has-shadow" role="navigation" aria-label="main navigation">
    <div class="container">
        <div class="navbar-brand">
            <a class="navbar-item" href="/">
                <img src="http://pluspng.com/img-png/letter-c-png-1600.png" alt="">
            </a>
            <a class="navbar-item" href="/">
                Camagru
            </a>
            <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false"
               data-target="">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>
        <div id="" class="navbar-menu">
            <a class="navbar-item is-tab" href="/editor.php">
                <i style="padding-right: 3px;" class="fas fa-camera-retro"></i>
                Editeur
            </a>
            <hr>
            <?php if (empty($_SESSION['user'])) {
                echo <<<HTML
<div class="navbar-end">
                    <a class="navbar-item is-tab" href="register.php">
                    <i style="padding-right: 3px;" class="fas fa-user-plus"></i>
                        Inscription
                    </a>
                    <a class="navbar-item is-tab" href="login.php">
                    <i style="padding-right: 3px;" class="fas fa-sign-in-alt"></i>
                        Connexion
                    </a>
        </div>
HTML;
            } else {
                echo <<<HTML
<div class="navbar-end">
                    <a class="navbar-item is-tab" href="/profile.php">
                    <i style="padding-right: 3px" class="fas fa-user-astronaut"></i>
{$_SESSION['user']['username']}</a>
                    <a class="navbar-item is-tab" href="/logout.php">
                    <i style="padding-right: 3px" class="fas fa-sign-out-alt"></i>
                        Deconnexion
                    </a>
        </div>
HTML;
            } ?>
        </div>
    </div>
</nav>