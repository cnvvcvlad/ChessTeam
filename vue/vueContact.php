<?php ob_start(); ?>
<?php $title = 'Page de contact'; ?>
<?php $description = 'Page de contact'; ?>
<div class="container">
    <h1 class="text-center">Contactez-nous !</h1>
    <div class="container_form">

        <form action="../controller/controllerForm.php" method="post" class="form-inscription">
        <fieldset>
        <legend>Vos identifiants : </legend>
            <div class="form-inscription">
                <label for="author_name">Nom : </label>
                <p><input type="text" class="form-control" id="author_name" placeholder="Nom" name="author_name" required></p>
            </div>
            <div class="form-inscription">
                <label for="mess_subject">Sujet : </label>
                <p><input type="text" class="form-control" id="mess_subject" placeholder="Sujet" name="mess_subject" required></p>
            </div>
            <div class="form-inscription">
                <label for="mess_author">E-mail : </label>
                <p><input type="email" class="form-control" id="mess_author" placeholder="E-mail" name="mess_author" required></p>
            </div>
            <div class="">
                <label for="mess_author">Message : </label>
                <p><textarea id="mess_content" name="mess_content" class="form-control" placeholder="Message" rows="5"
                                 cols="33" required></textarea></p>
            </div>
            <input type="hidden" id="recaptchaResponse" name="recaptcha-response">
            <!-- <button type="submit" name="contact" class="btn btn-success">Envoyer</button> -->
        </fieldset>
            <p><input type="submit" name="contact" class="btn btn-success" value="Envoyer"></p>
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
