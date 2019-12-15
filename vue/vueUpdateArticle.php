<?php ob_start(); ?>

<?php $title = 'Mis à jour d\'un article de ChessTeam'; ?>
<?php $description = 'Enregistrez les modifications apportées aux informations publiées sur le site web'; ?>


    <div class="top_article">
        <?php foreach ($articleId as $key => $values) : ?>
            <h1><?= $values->getArt_title() ?></h1>
            <div class="banniere_bouton">

                <div class="bouton_commande"><a href="?action=allArticles&amp;deleteA=<?= $values->getId() ?>"
                                                onclick="return(confirm('Etes-vous sûr de vouloir supprimer?'));">Supprimer</a>
                </div>

            </div>
            <p>Ecrit par
                <mark><?= showNameAuthor($values->getArt_author()) ?></mark>
                le <em><?= $values->getArt_date_creation() ?></em> dans la catégorie
                <strong><?= showNameCategory($values->getCategory_id()) ?></strong></p>
            <div class="justify_article">
                <h3><?= $values->getArt_description() ?></h3>

                <p>
                    <img src="assets/img/uploads/<?= $values->getArt_image() ?>" alt="Image de l'article">
                    <span><?= $values->getArt_content() ?></span>
                </p>
            </div>


            <div class="comment-block">

                <h3 class="comment-libelle"> Modifier l'article : </h3>

                <form action="controller/controllerFrontEnd.php" method="post" class="form-inscription"
                      enctype="multipart/form-data">
                    <fieldset>
                        <legend>Introduisez vos informations</legend>
                        <div class="form-inscription">
                            <label for="">Titre de l'article
                                <input type="hidden" name="id" value="<?= $values->getId() ?>">

                                <p><input type="text" name="art_title" value="<?= $values->getArt_title() ?>"></p>
                            </label>
                        </div>
                        <div class="form-inscription">
                            <label for="">Description de l'article
                                <p><textarea name="art_description" placeholder="Description de l'article" rows="5"
                                             cols="33"><?= $values->getArt_description() ?></textarea></p>
                            </label>
                        </div>
                        <div class="form-inscription">
                            <label for="">Contenu de l'article
                                <p><textarea name="art_content" placeholder="Contenu de l'article" rows="5"
                                             cols="33"><?= $values->getArt_content() ?></textarea></p>
                            </label>
                        </div>
                        <div class="form-inscription">
                            <label class="form-inscription" for="image">Choisir une image</label>
                            <input type="file" class="image" id="image" name="art_image"
                                   accept='.gif, .png , .jpg' required>

                        </div>
                        <p><input type="hidden" name="art_author" value="<?= $values->getArt_author() ?>"></p>

                        <p><input type="hidden" name="category_id" value="<?= $values->getCategory_id() ?>"></p>

                        <div class="form-inscription">
                            <p><input type="submit" value="Envoyer" name="updateArticle"></p>

                            <p><input type="reset" value="Annuler"/></p>
                        </div>
                    </fieldset>
                </form>
            </div>
        <?php endforeach; ?>

    </div>
    <div class="back-page">
        <div class="back-page">
            <a href="?action=allArticles">Retour</a>
            <a href="?action=home">Retour à l'accueil</a>
        </div>
    </div>


<?php $template = ob_get_clean(); ?>
<?php require 'templates/tempAccueil.php'; ?>