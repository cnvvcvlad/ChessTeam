<?php ob_start(); ?>
<?php $title = 'Connexion sur le blog du ChessTeam Nogent sur Marne'; ?>
<?php $description =
    'Connéctez-vous en tant que membre pour interagir avec les autres'; ?>

<?php if (isset($_GET['alert']) and $_GET['alert'] == 'inscrit') {
    echo '<h4>Vous êtes bien inscrit !</h4>';
} ?>
<div class="container">
    <h1 class="text-center">Connectez - vous!</h1>
    <div class="container_form">
        <form action="?action=controllerFrontEnd" method="POST" class="form-inscription">
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
    <div class="">
        <a class="" href="/ProjectTesting/ChessTeam/<?= substr(
            basename($_SERVER['HTTP_REFERER']),
            0
        ) ?>">Retour</a>
    </div>
</div>


<?php $template_form = ob_get_clean(); ?>

<?php require 'templates/tempForm.php'; ?>
