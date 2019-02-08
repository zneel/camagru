<html lang="fr">
<?php require 'head.php' ?>
<body>
<?php require 'navbar.php' ?>
<section class="hero is-fullheight">
    <div class="hero-body">
        <div class="container has-text-centered">
            <div class="column is-4 is-offset-4">
                <h3 class="title has-text-grey">Connection</h3>
                <div class="box">
                    <form action="login" method="post">
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
                    <a href="register">Inscription</a> &nbsp;·&nbsp;
                    <a href="reset">Mot de passe oublié</a> &nbsp;·&nbsp;
                </p>
            </div>
        </div>
    </div>
</section>
</body>
</html>
<?php require 'footer.php' ?>