<?php ob_start(); ?>
<?php $title = 'Inscription blog Chess Team Nogent sur Marne'; ?>
<?php $description = ''; ?>


<div class="form-connexion">


    <form action="controller/controllerFrontEnd.php" method="POST" class="form-inscription"
          enctype="multipart/form-data">
        <h1>Inscrivez-vous !</h1>
        <fieldset>
            <legend>Vos coordonnées : </legend>
            <div class="form-inscription">
                <label for="login">Login : </label>

                <p><input type="text" name="login" id="login" required placeholder="Login" minlength="6" maxlength="10">
                </p>
            </div>
            <div class="form-inscription">
                <label for="email">Email : </label>

                <p><input type="email" name="email" id="email" required placeholder="Email" maxlength="25"></p>
            </div>
            <div class="form-inscription">
                <label for="password">Mot de passe : </label>

                <p><input type="password" name="password" id="password" required placeholder="Mot de passe"
                          minlength="6"
                          maxlength="10"></p>
            </div>
            <div class="form-inscription">
                <label for="image">Choisir une image</label>
                <p><input type="file" name="image_membre" class="image" id="image" required accept='.gif, .png , .jpg'></p>
            </div>
        </fieldset>
        <div class="form-inscription">
            <p><input type="submit" value="S'inscrire !" name="inscription"></p>

            <p><input type="reset" value="Annuler"/></p>
        </div>
    </form>
</div>


<?php $template_form = ob_get_clean(); ?>

<?php require 'templates/tempForm.php'; ?>
