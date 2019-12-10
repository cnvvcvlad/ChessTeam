<?php ob_start(); ?>
<?php $title = 'Categorie des articles'; ?>
<?php $description = ''; ?>


    <div class="top_article">
        <?php if (!empty($CategoryId)): ?>
            <?php foreach ($CategoryId as $key => $value) : ?>
                <h1>Categorie : <?= $value->getTitle() ?> </h1>
                <?php if (isAdmin()) : ?>
                    <div class="banniere_bouton">
                        <div class="bouton_commande"><a href="?action=allCategory&amp;deleteC=<?= $value->getId() ?>">Supprimer</a>
                        </div>
                    </div>
                <?php endif ?>
                <p>Ecrit par
                    <mark><?= showNameAuthor($value->getCat_author()) ?></mark>
                    le <em><?= $value->getCat_date_creation() ?></em></p>
                <div class="justify_article">
                    <p>
                        <img src="assets/img/uploads/<?= $value->getCategory_image() ?>" alt="Image de la catégorie">

                        <span><?= $value->getDescription() ?></span>
                    </p>

                </div>
                <div class="back-page">
                    <div class="back-page">
                        <a href="?action=articlesOfCategory&amp;id=<?= $value->getId() ?>" class="bouton_rouge">Consulter
                            les articles de cette catégorie <img src="assets/img/by_default/flecheblanchedroite.png"
                                                                 alt="le bouton rouge"/></a>
                    </div>
                    <div class="back-page"><a href="<?= $_SERVER['HTTP_REFERER'] ?>">Retour</a></div>
                </div>

            <?php endforeach; ?>


        <?php endif; ?>
    </div>

<?php if (isAdmin()) : ?>
    <h3>Modifier cette catégorie</h3>
    <form action="controller/controllerFrontEnd.php" method="post" class="form-create"
          enctype="multipart/form-data">
        <fieldset>
            <legend>Introduisez vos informations</legend>
            <div class="form-create">
                <label for="">Titre de la catégorie
                    <input type="hidden" name="id" value="<?= $value->getId() ?>">

                    <p><input type="text" required name="title" value="<?= $value->getTitle() ?>"></p>
                </label>
            </div>
            <div class="form-create">
                <label for="">Description de la catégorie
                    <p><textarea required name="description" placeholder="Description de la catégorie" rows="5"
                                 cols="33"><?= $value->getDescription() ?></textarea></p>
                </label>
            </div>
            <div class="form-create">
                <label for="">Image de la catégorie
                    <p><input type="file" name="category_image" accept='.gif, .png , .jpg' required></p>
                </label>
            </div>
            <p><input type="hidden" name="cat_author" value="<?= htmlspecialchars($_SESSION['id_user']) ?>"></p>

            <div class="form-create">
                <input type="submit" value="Envoyer" name="updateCategory">
                <p><input type="reset" value="Annuler" /></p>

            </div>
        </fieldset>
    </form>
<?php endif; ?>
<?php $template = ob_get_clean(); ?>
<?php require 'templates/tempAccueil.php'; ?>