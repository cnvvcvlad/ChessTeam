<?php ob_start() ?>

<?php $title = 'Articles d\'une seule catégorie'; ?>
<?php $description = 'Les textes sont triés par différents sous-domaine du monde des échecs'; ?>


    <div class="top_article">
        <?php if (!empty($articlesOfCategory)): ?>
        <?php foreach ($articlesOfCategory as $key => $value) : ?>

        <h1><?= $value->getArt_title() ?></h1>
        <p>Ecrit par <mark><?= showNameAuthor($value->getArt_author())?></mark> le <em><?= $value->getArt_date_creation() ?></em> dans le catégorie <strong><?= showNameCategory($value->getCategory_id())?></strong></p>
        <h3>Description</h3>
        <div class="justify_article">
        <p><img src="assets/img/uploads/<?= $value->getArt_image() ?>" alt="Image de la catégorie">
            <span>
                <?= $value->getArt_description() ?></span>
            </p>
                        <p><a href="?action=allArticles&amp;id=<?= $value->getId() ?>">(<?= count(getAllCommentsOfArticle($value->getId())) ?>) Commentaires </a></p>

    </div>

        <div class="bouton_commande">
                    <a href="?action=allArticles&amp;id=<?= $value->getId() ?>" class="bouton_rouge">Consulter l'article <img src="assets/img/by_default/flecheblanchedroite.png" alt="le bouton rouge" /></a>
                </div>
    <?php endforeach; ?>
    <?php else : ?>
        <h3>Il n'y a pas d'articles dans cette catégorie</h3>

    <?php endif; ?>
    </div>

<?php $template = ob_get_clean(); ?>
<?php require 'templates/tempAccueil.php'; ?>