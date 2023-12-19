<?php $title = 'Modifier le commentaire d\'un article'; ?>
<?php $description =
    'Gérez les avis des utilisateurs en réspectant la liberté de l\'expression'; ?>
<div class="container">
    <?php if (isset($params['comment'])) : ?>
        <div class="comment-block">
            <h3 class="comment-libelle"> Modifier le commentaire : </h3>
            <?php foreach ($params['comment'] as $key => $value) : ?>
                <form action="<?= dirname(SCRIPTS) ?>/admin/comments/edit/<?= $value->getId() ?>" method="post" class="form-inscription">
                    <fieldset>
                        <legend>Commentaire</legend>

                        <div class="form-inscription">
                            <label for="">
                                <p><textarea maxlength="50" minlength="5" required name="com_content" class="comment-text" placeholder="Contenu du commentaire" rows="5" cols="33"><?= $value->getCom_content() ?></textarea></p>
                            </label>
                        </div>
                        <p><input type="hidden" name="id" value="<?= $value->getId() ?>"></p>

                    </fieldset>
                    <div class="form-inscription">
                        <input type="submit" value="Envoyer" name="updateComment">
                        <input type="reset" value="Annuler" />

                    </div>
                </form>
                <div class="deleteCom">
                    <form action="<?= dirname(SCRIPTS) ?>/admin/comments/delete/<?= $value->getId() ?>" method="POST">
                        <input type="submit" value="Supprimer le commentaire" name="delete">
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>