<?php ob_start(); ?>
<?php $title = 'Page de contact' ?>
<?php $description = 'Page de contact' ?>
<div class="container">
    <h1 class="text-center">Contactez-nous !</h1>

    <form action="../controller/controllerForm.php" method="post">
        <div class="form-group">
            <label for="author_name">Nom : </label>
            <input type="text" class="form-control" id="author_name" placeholder="nom" name="author_name" required>
        </div>
        <div class="form-group">
            <label for="mess_subject">Sujet : </label>
            <input type="text" class="form-control" id="mess_subject" placeholder="Sujet" name="mess_subject" required>
        </div>
        <div class="form-group">
            <label for="mess_author">E-mail : </label>
            <input type="email" class="form-control" id="mess_author" placeholder="E-mail" name="mess_author" required>
        </div>
        <div class="form-group">
            <label for="mess_content">Message : </label>
            <textarea id="mess_content" name="mess_content" class="form-control" required></textarea>
        </div>
        <input type="hidden" id="recaptchaResponse" name="recaptcha-response">
        <button type="submit" name="contact" class="btn btn-success">Envoyer</button>
<!--        <input type="submit" name="contact" class="btn btn-success" value="Envoyer">-->
    </form>    
    <div class="d-flex justify-content-end">
        <a class="btn mb-5 btn-primary" href="/ProjectTesting/ChessTeam/<?= substr(basename($_SERVER['HTTP_REFERER']), 0) ?>">Retour</a>
    </div>
</div>


<?php $mentions = ob_get_clean(); ?>
<?php require 'templates/tempBootstrap.php'; ?>
