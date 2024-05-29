<?php $title = 'Formulaire'; ?>
<?php $description = 'Page du formulaire'; ?>
<div class="container">
    <?php if (isset($_GET['code'])) {echo $_GET['code'];} ?>
    <h1 class="text-center">Connectez - vous!</h1>
    <div class="container_form">
        <form action="<?= dirname(SCRIPTS) .
            '/login' ?>" method="POST" class="form-inscription">
            <fieldset>
                <legend>Vos identifiants : </legend>
                <div class="form-inscription">
                    <label for="login">Login : </label>

                    <p><input type="text" name="login" id="login" required placeholder="Login" minlength="6" maxlength="10">
                    </p>
                </div>
                <div class="form-inscription">
                    <label for="password">Mot de passe : </label>

                    <p><input type="password" name="password" id="password" required placeholder="Mot de passe" minlength="6" maxlength="10"></p>
                </div>
            </fieldset>
            <div class="form-inscription">
                <p><input type="submit" value="Se connecter!" name="connexion"></p>
                <p><input type="reset" value="Annuler" /></p>
            </div>

        </form>     
        <p>
            <a href="https://accounts.google.com/o/oauth2/v2/auth?scope=email&access_type=online&include_granted_scopes=true&response_type=code&redirect_uri=<?= urlencode(
     'http://localhost/ProjectTesting/ChessTeam/login') ?>&client_id=<?= GOOGLE_ID ?>">Se connecter avec Google</a>
        </p>   
    </div>