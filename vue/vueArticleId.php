<?php ob_start(); ?>
<?php $title ='Articles  membres'; ?>
<?php $description = '' ;?>

<?php if(isConnected()) : ?>



<div class="top_article">           

<?php if (!empty($myArticles)) : ?>
    <h1>Voici vos articles</h1>
<?php foreach ($myArticles as $key => $value) : ?>
    <h1><img src="assets/img/by_default/ico_epingle.png" alt="Catégorie" class="ico_categorie" /><?= $value->getArt_title() ?></h1> 

<h2><?= $value->getArt_description() ?></h2>

        <div class="banniere_bouton">
                <?php if (isAdmin()) : ?>
                    <div class="bouton_commande"><a href="?action=allArticles&amp;updateA=<?= $value->getId() ?>">Modifier</a></div>
                <?php endif; ?>
                <div class="bouton_commande">
                    <a href="?action=allArticles&amp;id=<?= $value->getId() ?>" class="bouton_rouge">Voir l'article <img src="assets/img/by_default/flecheblanchedroite.png" alt="le bouton rouge" /></a>
                </div>
            </div>
        <p>Ecrit par <mark><?= showNameAuthor($value->getArt_author()) ?></mark> le <em><?= $value->getArt_date_creation() ?></em> dans la catégorie <strong><?= showNameCategory($value->getCategory_id()) ?></strong></p>  
        <div class="justify_article">
            <p>
            <img src="assets/img/uploads/<?= $value->getArt_image()?>" alt="Image de l'article">

                <span><?= $value->getArt_description() ?></span>
            </p>
            <p><a href="?action=allArticles&amp;id=<?= $value->getId() ?>">(<?= count(getAllCommentsOfArticle($value->getId())) ?>) Commentaires </a></p>
        </div>

        <h3 class="button_creation"><a href="?action=createArticleId">Créer un article</a></h3>

<?php endforeach; ?>
<?php else : ?>
    <h1>Vous n'avez pas des articles</h1>
<?php endif ; ?>
</div>

<?php endif; ?>
<?php $template = ob_get_clean(); ?>

<?php require 'templates/tempAccueil.php'; ?>