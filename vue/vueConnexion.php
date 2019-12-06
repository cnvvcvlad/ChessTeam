<?php ob_start(); ?>
<?php $title = 'Conexion blog Chess Team Nogent sur Marne'; ?>
<?php $description = ''; ?>

<?php if (isset($_GET['alert']) AND ($_GET['alert'] == 'inscrit')) {
    echo '<h4>Vous êtes bien inscrit !</h4>';
}
?>


    <div class="form-connexion">
        <h1>Connectez - vous!</h1>

        <form action="controller/controllerFrontEnd.php" method="POST" class="form-connexion">
            <div class="form-connexion">
                <label for="login">Login : </label>

                <p><input type="text" name="login" id="login" required placeholder="Login" minlength="6" maxlength="10">
                </p>
            </div>
            <div class="form-connexion">
                <label for="password">Mot de passe : </label>

                <p><input type="password" name="password" id="password" required placeholder="Mot de passe"
                          minlength="6" maxlength="10"></p>
            </div>
            <div class="form-connexion">
                <p><input type="submit" value="Se connecter!" name="connexion"></p>
            </div>
        </form>
    </div>


<?php $template = ob_get_clean(); ?>

<?php
//require 'templates/program.php';

require 'templates/tempAccueil.php';

//require 'templates/header.php';

//require 'templates/main.php';

//require 'templates/footer.php';
?>