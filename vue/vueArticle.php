<?php ob_start(); ?>

<?php $title = 'Article du blog'; ?>
<?php $description = 'Cette page affiche tous les articles du site web'; ?>


<?php if (!empty($allArticles)): ?>

    <!-- <h1>Voici tous nos articles!<br>
        N'hésitez pas à nous donner votre avis dans les commentaires!</h1> -->

    <div class="top_article">
        <?php foreach ($allArticles as $key => $values): ?>


            <h1><img src="assets/img/by_default/ico_epingle.png" alt="Catégorie"
                     class="ico_categorie"/><?= $values->getArt_title() ?></h1>

            <div class="banniere_bouton">
                <?php if (isAdmin()): ?>
                    <div class="bouton_commande"><a href="?action=allArticles&amp;updateA=<?= $values->getId() ?>">Modifier</a>
                    </div>
                <?php endif; ?>
                <div class="bouton_commande">
                    <a href="?action=allArticles&amp;id=<?= $values->getId() ?>" class="bouton_rouge">Voir l'article
                        <img src="assets/img/by_default/flecheblanchedroite.png" alt="le bouton rouge"/></a>
                </div>
            </div>
            <p><span class="information"> Ecrit par</span>
                <span class="mark"><?= isset($user) ? $user->showNameAuthor(
                    $values->getArt_author()
                ) : '' ?></span>
                le <em><?= $values->getArt_date_creation() ?></em> <span class="information"> dans la catégorie</span>
                <strong><?= isset($category) ? $category->showNameCategory(
                    $values->getCategory_id()
                ) : '' ?></strong></p>

            <div id="detail_art" class="justify_article">

                <a class="grand_image" href="assets/img/uploads/<?= $values->getArt_image() ?>"><img
                        src="assets/img/uploads/<?= $values->getArt_image() ?>" alt="Image de l'article"
                        title="Cliquez pour agrandir"></a>

                <span><h3><?= $values->getArt_description() ?></h3><br><a class="lire_suite" href="#cache"> [Lire la
                        suite...] </a></span>

                <div id="cache"><span><?= $values->getArt_content() ?><br><a href="#detail_art"> [Voir moins]</a></span>
                </div>
                <p>
                    <a href="?action=allArticles&amp;id=<?= $values->getId() ?>">
                        (<?= isset($comment) ?  count(
                            $comment->getAllCommentsOfArticle($values->getId())
                        ) : '' ?>) Commentaires
                    </a>
                </p>

            </div>
            <div class="separateur"></div>


        <?php endforeach; ?>
    </div>
    <nav class="paginator">
        <li class="list_style page-item"><a href="?action=allArticles&amp;page=<?= $currentPage - 1 ?>" class="<?= ($currentPage == 1) ? 'disabled' : '' ?>">Précédente</a></li>
        <?php for($page = 1; $page <= $nbPages; $page++): ?>
            <li class="list_style page-item">
                <a href="?action=allArticles&amp;page=<?= $page ?>" class="page-link-<?= ($currentPage == $page) ? 'active' : '' ?>"><?= $page ?>
            </a>
        </li>
        <?php endfor; ?>
        <li class="list_style page-item"><a href="?action=allArticles&amp;page=<?= $currentPage + 1 ?>" class="<?= ($currentPage == $nbPages) ? 'disabled' : '' ?>">Suivante</a></li>
    </nav>

<?php endif; ?>
<div class="back-page">
    <a href="<?= substr(basename($_SERVER['HTTP_REFERER']), 0) ?>">Retour</a>
    <a href="?action=home">Retour à l'accueil</a>
</div>


<?php $template = ob_get_clean(); ?>

<?php require 'templates/tempAccueil.php'; ?>
