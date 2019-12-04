<?php ob_start(); ?>

<?php $title = 'Catégories des articles du blog ChessTeam'; ?>
<?php $description = 'Retrouvez tous les catégories des articles publiés sur le blog, consultez ses articles et ses commentaires'; ?>

<?php if (isAdmin()) : ?>

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
        <h2>Créer une nouvelle catégorie</h2>

        <form action="controller/controllerFrontEnd.php" method="post" class="form-inscription"
              enctype="multipart/form-data">
            <fieldset>
                <legend>Introduisez vos informations</legend>
                <div class="form-inscription">
                    <label for="">Titre de la catégorie
                        <p><input type="text" name="cat_title" value="" placeholder="Titre de la catégorie"></p>
                    </label>
                </div>
                <div class="form-inscription">
                    <label for="">Description de la catégorie
                        <p><textarea name="cat_description" placeholder="Description de la catégorie" rows="5"
                                     cols="33"></textarea></p>
                    </label>
                </div>
                <div class="form-inscription">
                    <label for="">Image de la catégorie
                        <p><input type="file" name="image_category" accept='.gif, .png , .jpg' required></p>
                    </label>
                </div>
                <p><input type="hidden" name="id_user" value="<?= htmlspecialchars($_SESSION['id_user']) ?>"></p>

                <div class="form-inscription">
                    <input type="submit" value="Envoyer" name="categoryCreation">
                </div>
            </fieldset>
        </form>

<?php endif; ?>
<?php $template = ob_get_clean(); ?>

<?php require 'templates/tempAccueil.php'; ?>