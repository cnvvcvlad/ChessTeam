<?php ob_start() ; ?>

<?php $title = 'Modifier le commentaire d\'un article'; ?>
<?php $description ='Gérez les avis des utilisateurs en réspectant la liberté de l\'expression'; ?>

<?php if (isset($modifyComment)) : ?>


<div class="comment-block">

    <h3 class="comment-libelle"> Modifier le commentaire : </h3>
    <?php foreach ($modifyComment as $key => $value) : ?>
    <form action="controller/controllerFrontEnd.php" method="post" class="form-inscription">
        <fieldset>
            <legend>Commentaire</legend>

            <div class="form-inscription">
                <label for="">
                    <p><textarea name="com_content" class="comment-text" placeholder="Contenu du commentaire" rows="5"
                                 cols="33"><?= $value->getCom_content() ?></textarea></p>
                </label>
            </div>
            <p><input type="hidden" name="id" value="<?= $value->getId() ?>"></p>

        </fieldset>
        <div class="form-inscription">
            <input type="submit" value="Envoyer" name="updateComment">
            <p><input type="reset" value="Annuler" /></p>
            <p class="deleteCom"><a href="?action=allComments&amp;deleteCom=<?= $value->getId()?>" onclick="return(confirm('Supprimer le commentaire?'))" class="deleteCom">Supprimer</a></p>
        </div>
    </form>
    <?php endforeach ; ?>


</div>


<?php endif; ?>
<?php $template_form = ob_get_clean(); ?>
<?php require 'templates/tempForm.php' ; ?>
