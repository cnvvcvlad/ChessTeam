<?php ob_start(); ?>
<?php $title = 'Catégorie des articles'; ?>
<?php $description =
    'Découvrez les catégories disponible pour trouver les informations utiles'; ?>


    <div class="top_article">
        <?php if (!empty($CategoryId)): ?>
            <?php foreach ($CategoryId as $key => $value): ?>
                <h1>Catégorie : <?= $value->getTitle() ?> </h1>
                <?php if (isAdmin()): ?>
                    <div class="banniere_bouton">
                        <div class="bouton_commande" ><a href="?action=allCategory&amp;deleteC=<?= $value->getId() ?>" onclick="return(confirm('Etes-vous sûr de vouloir supprimer?'));">Supprimer cette catégorie</a>
                        </div>
                    </div>
                <?php endif; ?>
                <p><span class="information">Ecrit par</span>
                    <span class="mark"><?= showNameAuthor(
                        $value->getCat_author()
                    ) ?></span>
                    le <em><?= $value->getCat_date_creation() ?></em></p>

                <div class="justify_article">
                    <a class="grand_image" href="assets/img/uploads/<?= $value->getCategory_image() ?>"><img src="assets/img/uploads/<?= $value->getCategory_image() ?>" alt="Image de la catégorie" title="Cliquez pour agrandir"></a>
                    <span><h3><?= $value->getDescription() ?></h3></span>
                </div>


            <?php endforeach; ?>


        <?php endif; ?>
    </div>

<?php if (isAdmin()): ?>
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
                <label class="form-create" for="image_cat">Choisir une image</label>
                    <p><input type="file" name="category_image" class="image" id="image_cat" accept='.gif, .png , .jpg' required></p>

            </div>
            <p><input type="hidden" name="cat_author"  value="<?= htmlspecialchars(
                $_SESSION['id_user']
            ) ?>"></p>

            <div class="form-create">
                <p><input type="submit" value="Envoyer" name="updateCategory"></p>
                <p><input type="reset" value="Annuler" /></p>

            </div>
        </fieldset>
    </form>
<?php endif; ?>
        <div class="back-page">
            <a href="<?= substr(
                basename($_SERVER['HTTP_REFERER']),
                9
            ) ?>">Retour</a>
            <a href="?action=articlesOfCategory&amp;id=<?= $value->getId() ?>" class="bouton_rouge">Consulter
                les articles de cette catégorie <img src="assets/img/by_default/flecheblanchedroite.png"
                                                     alt="le bouton rouge"/></a>
        </div>


<?php $template = ob_get_clean(); ?>
<?php require 'templates/tempAccueil.php'; ?>
