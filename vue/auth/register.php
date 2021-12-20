<?php $title = 'Inscription blog Chess Team Nogent sur Marne'; ?>
<?php $description = 'Inscrivez-vous pour publier des actualités liés aux échecs'; ?>

<div class="container">
    <h1 class="text-center">Inscrivez-vous !</h1>
    <div class="container_form">
        <form action="<?= dirname(SCRIPTS) . "/register" ?>" method="POST" class="form-inscription" enctype="multipart/form-data">
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

                    <p><input type="password" name="password" id="password" required placeholder="Mot de passe" minlength="6" maxlength="10"></p>
                </div>
                <div class="form-inscription">
                    <label class="form-inscription" for="image_inscription">Choisir une image</label>
                    <p><input type="file" name="image_membre" class="image" id="image_inscription" required accept='.gif, .png , .jpg'></p>
                </div>
            </fieldset>
            <div class="form-inscription">
                <p><input type="submit" value="S'inscrire !" name="inscription"></p>

                <p><input type="reset" value="Annuler" /></p>
            </div>
        </form>
    </div>
</div>