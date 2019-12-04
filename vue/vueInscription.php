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
    <div class="program">
        <section class="content">
            <h2 class="myColor">Qui sommes-nous ?</h2>
            <p><span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos, explicabo neque odit repellat debitis eum mollitia dolor ducimus nulla saepe recusandae sint aspernatur omnis porro fuga officia quod quasi rem?</span><span>Error placeat molestias debitis pariatur molestiae atque dolores. Debitis, sint eaque. Cumque ipsa, ad blanditiis porro quas adipisci voluptatum? Quisquam expedita in minus id nulla, adipisci facere praesentium. Amet, deleniti?</span></p>
        </section>
        <section class="content">
            <h2 class="myColor">Nos actualités</h2>
            <p><span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nesciunt praesentium vel deleniti quasi itaque voluptatibus delectus magnam harum, voluptate, non doloremque facilis quam iure eum, illum provident reprehenderit repellat laudantium?</span><span>Reprehenderit enim eaque sapiente excepturi maxime error recusandae illum? Amet sint sapiente omnis cupiditate iure quod optio, suscipit consectetur cumque deserunt illo molestias repellendus voluptatem error nesciunt assumenda provident! Molestias!</span></p>
        </section>
        <section class="content">
            <h2 class="myColor">Les sites partenaires</h2>
            <p><span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima laborum reiciendis adipisci quasi sit in ut esse tenetur repudiandae ea minus totam enim eligendi explicabo, rerum mollitia omnis vel aspernatur.</span><span>Autem iste hic est ipsa, aliquam at sit earum sapiente dignissimos beatae deleniti quis laudantium, quisquam, voluptate possimus aut repellendus doloremque reprehenderit error id asperiores! Aspernatur quibusdam mollitia commodi perferendis!</span></p>
        </section>
    </div>   


<?php $template = ob_get_clean(); ?>

<?php require 'templates/tempAccueil.php'; ?>
