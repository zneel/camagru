<?php
session_start();
?>
<html lang="fr">
<?php require 'head.php' ?>
<body>
<?php require 'navbar.php' ?>
<header class="container">
    <div class="title has-text-centered">
        <h1 class="">Bienvenue sur Catmagru</h1>
    </div>
    <div class="columns">
        <?php for ($i = 0; $i < 20; $i++) {
            echo "<div class='column'><p class='is-half'>Hello $i</p></div>";
        } ?>
    </div>
</header>
<?php require 'footer.php' ?>
</body>
</html>
