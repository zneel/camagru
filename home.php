<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<html class="has-navbar-fixed-top" lang="fr">
<?php require 'head.php' ?>
<body>
<?php require 'navbar.php' ?>
<header class="container">
    <div class="title has-text-centered">
        <h1>Bienvenue sur le Camagru</h1>
    </div>
</header>
<section class="section">
    <?php require 'gallery.php' ?>
</section>
<?php require 'footer.php' ?>
</body>
</html>
