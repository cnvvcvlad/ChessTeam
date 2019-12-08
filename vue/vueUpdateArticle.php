<?php ob_start(); ?>

<?php $title = 'Consulter un article de ChessTeam'; ?>
<?php $description = ''; ?>


    <div class="top_article">
        <?php foreach ($articleId as $key => $values) : ?>
            <h1><?= $values->getArt_title() ?></h1>
            <div class="banniere_bouton">

                <div class="bouton_commande"><a
                        href="?action=allArticles&amp;deleteA=<?= $values->getId() ?>">Supprimer</a></div>
                <!--        <div class="bouton_commande"><a href="">Modifier</a></div>-->

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
                        <label for="">Image de l'article
                            <p><input type="file" name="art_image" accept='.gif, .png , .jpg' required></p>
                        </label>
                    </div>
                    <p><input type="hidden" name="art_author" value="<?= $values->getArt_author() ?>"></p>
                    <p><input type="hidden" name="category_id" value="<?= $values->getCategory_id() ?>"></p>

                    <div class="form-inscription">
                        <input type="submit" value="Envoyer" name="updateArticle">
                    </div>
                </fieldset>
            </form>


        </div>
        <?php endforeach; ?>
    </div>

<?php $template = ob_get_clean(); ?>
<?php require 'templates/tempAccueil.php'; ?>