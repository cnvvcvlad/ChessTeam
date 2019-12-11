<?php ob_start(); ?>

<?php $title = 'Catégories des articles du blog ChessTeam'; ?>
<?php $description = 'Retrouvez toutes les catégories des articles publiés sur le site, regardez ses articles et ses commentaires'; ?>



        <h1>Toutes les catégories</h1>
    <div class="view">
        <?php if (isset($allCategory)) : ?>
            <?php foreach ($allCategory as $key => $value) : ?>
                <ul>
                    <li><a href="?action=categoryId&amp;id=<?= $value->getId() ?>">Catégorie
                            : <?= $value->getTitle() ?></a>
                    </li>
                </ul>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
<?php if (isAdmin()) : ?>
        <h2>Créer une nouvelle catégorie</h2>

        <form action="controller/controllerFrontEnd.php" method="post" class="form-create"
              enctype="multipart/form-data">
            <fieldset>
                <legend>Introduisez vos informations</legend>
                <div class="form-create">
                    <label for="">Titre de la catégorie
                        <p><input type="text" name="cat_title" value="" placeholder="Titre de la catégorie"></p>
                    </label>
                </div>
                <div class="form-create">
                    <label for="">Description de la catégorie
                        <p><textarea name="cat_description" placeholder="Description de la catégorie" rows="5"
                                     cols="33"></textarea></p>
                    </label>
                </div>
                <div class="form-create">
                    <label for="">Image de la catégorie
                        <p><input type="file" name="image_category" accept='.gif, .png , .jpg' required></p>
                    </label>
                </div>
                <p><input type="hidden" name="id_user" value="<?= htmlspecialchars($_SESSION['id_user']) ?>"></p>

                <div class="form-create">
                    <input type="submit" value="Envoyer" name="categoryCreation">
                    <p><input type="reset" value="Annuler" /></p>

                </div>
            </fieldset>
        </form>

<?php endif; ?>
<?php $template_form = ob_get_clean(); ?>

<?php require 'templates/tempForm.php'; ?>