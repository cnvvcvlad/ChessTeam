<?php $title = 'Formulaire'; ?>
<?php $description = 'Page du formulaire'; ?>
<div class="container">
    <h1 class="text-center">Connectez - vous!</h1>
    <div class="container_form">
        <form action="<?= dirname(SCRIPTS) . "/login" ?>" method="POST" class="form-inscription">
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
    </div>