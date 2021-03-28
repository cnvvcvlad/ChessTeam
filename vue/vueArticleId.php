<?php ob_start(); ?>
<?php $title = 'Articles ajoutés par des membres'; ?>
<?php $description = 'Retrouvez la listes des billets proposées par les internautes'; ?>

<?php if (\Democvidev\App\ControllerStatut::isConnected()) : ?>

<h1>Voici vos créations ! </h1>

    <div class="top_article">

        <?php if (!empty($myArticles)) : ?>

            <?php foreach ($myArticles as $key => $value) : ?>
                <h1><img src="assets/img/by_default/ico_epingle.png" alt="Catégorie"
                         class="ico_categorie"/><?= $value->getArt_title() ?></h1>


                <div class="banniere_bouton">
                    <?php if (\Democvidev\App\ControllerStatut::isAdmin()) : ?>
                        <div class="bouton_commande"><a href="?action=allArticles&amp;updateA=<?= $value->getId() ?>">Modifier</a>
                        </div>
                    <?php endif; ?>
                    <div class="bouton_commande">
                        <a href="?action=allArticles&amp;id=<?= $value->getId() ?>" class="bouton_rouge">Voir l'article
                            <img src="assets/img/by_default/flecheblanchedroite.png" alt="le bouton rouge"/></a>
                    </div>
                </div>
                <p><span class="information"> Ecrit par</span>
                    <span class="mark"><?= \Democvidev\App\ControllerUser::showNameAuthor($value->getArt_author()) ?></span>
                    le <em><?= $value->getArt_date_creation() ?></em> <span class="information"> dans la catégorie</span>
                    <strong><?= \Democvidev\App\ControllerCategory::showNameCategory($value->getCategory_id()) ?></strong></p>
                <div class="justify_article">
                    <p>
                        <a class="grand_image" href="assets/img/uploads/<?= $value->getArt_image() ?>"><img src="assets/img/uploads/<?= $value->getArt_image() ?>" alt="Image de l'article" title="Cliquez pour agrandir"></a>

                    <span><h3><?= $value->getArt_description() ?></h3><br><a class="lire_suite" href="#cache"> [Lire la suite...] </a></span>
                    <div id="cache"><span><?= $value->getArt_content() ?><br><a href="#detail_art"> [Voir moins]</a></span>
                    </div>
                    </p>
                    <p>
                        <a href="?action=allArticles&amp;id=<?= $value->getId() ?>">(<?= count(\Democvidev\App\ControllerComments::getAllCommentsOfArticle($value->getId())) ?>
                            ) Commentaires </a></p>
                </div>


<!--                <h3 class="button_creation"><a href="?action=createArticleId">Créer un article</a></h3>-->
                <div class="separateur"></div>


            <?php endforeach; ?>
        <?php else : ?>
            <h1>Vous n'avez pas des articles</h1>
        <?php endif; ?>
    </div>
    <div class="back-page">
    <div class="back-page"><a href="?action=home">Retour à l'accueil</a></div>
    <div class="back-page"><a href="<?= $_SERVER['HTTP_REFERER']; ?>">Retour</a></div>
    </div>


<?php endif; ?>

<?php $template = ob_get_clean(); ?>

<?php require 'templates/tempAccueil.php'; ?>