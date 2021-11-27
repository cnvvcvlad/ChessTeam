<?php ob_start() ?>

<?php $title = 'Articles d\'une seule catégorie'; ?>
<?php $description = 'Les textes sont triés par différents sous-domaine du monde des échecs'; ?>


    <div class="top_article">
        <?php if (!empty($articlesOfCategory)): ?>
            <?php foreach ($articlesOfCategory as $key => $value) : ?>

                <h1><?= $value->getArt_title() ?></h1>
                <p><span class="information"> Ecrit par</span>
                    <span class="mark"><?= isset($user) ? $user->showNameAuthor($value->getArt_author()) : '' ?></span>
                    le <em><?= $value->getArt_date_creation() ?></em> <span class="information"> dans la catégorie</span>
                    <strong><?= isset($category) ? $category->showNameCategory($value->getCategory_id()) : '' ?></strong></p>

                <h3>Description</h3>

                <div class="banniere_bouton">
                    <div class="bouton_commande">
                        <a href="?action=allArticles&amp;id=<?= $value->getId() ?>" class="bouton_rouge">Voir l'article
                            <img src="assets/img/by_default/flecheblanchedroite.png"
                                 alt="le bouton rouge"/></a>
                    </div>
                    <?php if (isAdmin()) : ?>
                        <div class="bouton_commande"><a href="?action=allArticles&amp;updateA=<?= $value->getId() ?>">Modifier</a></div>
                    <?php endif; ?>
                </div>

                <div class="justify_article">
                    <p><a class="grand_image" href="assets/img/uploads/<?= $value->getArt_image() ?>"><img src="assets/img/uploads/<?= $value->getArt_image() ?>" alt="Image de la catégorie" title="Cliquez pour agrandir"></a>

            <span>
                <?= $value->getArt_description() ?></span>
                    </p>

                    <p>
                        <a href="?action=allArticles&amp;id=<?= $value->getId() ?>">(<?= count(getAllCommentsOfArticle($value->getId())) ?>
                            ) Commentaires </a></p>

                </div>


            <?php endforeach; ?>
        <?php else : ?>
            <h3>Il n'y a pas d'articles dans cette catégorie</h3>

        <?php endif; ?>
    </div>
    <div class="back-page">
        <a href="<?= substr(basename($_SERVER['HTTP_REFERER']), 0) ?>">Retour</a>
        <a href="?action=home">Retour à l'accueil</a>
    </div>


<?php $template = ob_get_clean(); ?>
<?php require 'templates/tempAccueil.php'; ?>