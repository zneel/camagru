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
                    <form action="register" method="post">
                        <div class="field">
                            <div class="control">
                                <input name="username" class="input " type="text" placeholder="Votre pseudo" required
                                       autofocus="">
                            </div>
                        </div>
                        <div class="field">
                            <div class="control">
                                <input name="email" class="input " type="email" placeholder="Votre email" required
                                       autofocus="">
                            </div>
                        </div>
                        <div class="field">
                            <div class="control">
                                <input name="cemail" class="input " type="email" placeholder="Confirmer votre email"
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
                                <input name="password" class="input " type="password" required
                                       placeholder="Confirmer votre mot de passe">
                            </div>
                        </div>
                        <button class="button is-block is-info  is-fullwidth">Inscription</button>
                    </form>
                </div>
                <p class="has-text-grey">
                    <a href="login">Connection</a> &nbsp;·&nbsp;
                    <a href="reset">Mot de passe oublié</a> &nbsp;·&nbsp;
                </p>
            </div>
        </div>
    </div>
</section>
</body>
</html>
<?php require 'footer.php' ?>