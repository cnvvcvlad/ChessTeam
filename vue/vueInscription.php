<?php ob_start(); ?>
<?php $title = 'Inscription blog Chess Team Nogent sur Marne'; ?>
<?php $description = '' ;?>

<?php  if(isset($_GET['alert']) AND $_GET['alert'] == 'image') {
    echo '<h4>Veuillez télecharger une image !</h4>';
} ?>
    <div>
        <h1>Bonjour ! Inscrivez-vous !</h1>
    </div>

    <div>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus consectetur, delectus distinctio suscipit a, quisquam amet labore nobis similique neque cupiditate excepturi? Quibusdam fuga sed dignissimos eveniet, quam ea voluptatibus!</p>
    </div>

    <form action="controller/controllerFrontEnd.php" method="POST" class="form-inscription" enctype="multipart/form-data">
        <div class="form-inscription">
            <label for="login">Login : </label>
            <p><input type="text" name="login" id="login" required placeholder="Login" minlength="6" maxlength="10"></p>
        </div>
        <div class="form-inscription">
            <label for="email">Email : </label>
            <p><input type="email" name="email" id="email" required placeholder="Email"  maxlength="25"></p>
        </div>
        <div class="form-inscription">
            <label for="password">Mot de passe : </label>
            <p><input type="password" name="password" id="password" required placeholder="Mot de passe" minlength="6" maxlength="10"></p>
        </div>
        <div class="form-inscription">
            <label for="image">Image : </label>
            <p><input type="file" name="image_membre" id="image" required accept='.gif, .png , .jpg'></p>
        </div>
        <div class="form-inscription">
            <p><input type="submit" value="S'inscrire !"  name="inscription"></p>
        </div>
    </form>



<?php $template = ob_get_clean(); ?>

<?php require 'templates/tempForm.php'; ?>
