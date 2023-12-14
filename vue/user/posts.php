<?php $title = 'Articles ajoutés par des membres'; ?>
<?php $description = 'Retrouvez la listes des billets proposées par les internautes'; ?>

<div class="container">
    <?php if ($this->isConnected()) : ?>
        <h1>Voici vos créations ! </h1>
        <div class="top_article">
            <?php if (!empty($params['posts'])) : ?>
                <?php foreach ($params['posts'] as $key => $value) : ?>
                    <h1><img src="<?= SCRIPTS ?>/img/by_default/ico_epingle.png" alt="Catégorie" class="ico_categorie" /><?= $value->getArt_title() ?></h1>
                    <div class="banniere_bouton">
                        <?php if ($this->isConnected() && $_SESSION['statut'] === 1) : ?>
                            <div class="bouton_commande"><a href="<?= dirname(SCRIPTS) . '/admin/posts/edit/' . $value->getId() ?>">Modifier</a>
                            </div>
                        <?php endif; ?>
                        <div class="bouton_commande">
                            <a href="<?= dirname(SCRIPTS) ?>/posts/<?= $value->getId() ?>" class="bouton_rouge">Voir l'article
                                <img src="<?= SCRIPTS ?>/img/by_default/flecheblanchedroite.png" alt="le bouton rouge" /></a>
                        </div>
                    </div>
                    <p><span class="information"> Ecrit par</span>
                        <span class="mark"><?= isset($user) ? $user->showNameAuthor($value->getArt_author()) : '' ?></span>
                        le <em><?= $value->getDate_creation() ?></em> <span class="information"> dans la catégorie</span>
                        <strong><?= isset($category) ? $category->showNameCategory($value->getCategory_id()) : '' ?></strong>
                    </p>
                    <div class="justify_article">
                        <p>
                            <a class="grand_image" href="assets/img/uploads/<?= $value->getArt_image() ?>"><img src="<?= SCRIPTS ?>/img/uploads/<?= $value->getArt_image() ?>" alt="Image de l'article" title="Cliquez pour agrandir"></a>

                            <span>
                                <h3><?= $value->getArt_description() ?></h3><br><a class="lire_suite" href="#cache"> [Lire la suite...] </a>
                            </span>
                        <div id="cache"><span><?= $value->getArt_content() ?><br><a href="#detail_art"> [Voir moins]</a></span>
                        </div>
                        </p>
                        <p>
                            <a href="?action=allArticles&amp;id=<?= $value->getId() ?>">(<?= isset($comment) ? count($comment->getAllCommentsOfArticle($value->getId())) : '' ?>
                                ) Commentaires </a>
                        </p>
                    </div>
                    <div class="separateur"></div>
                <?php endforeach; ?>
            <?php else : ?>
                <h1>Vous n'avez pas des articles</h1>
            <?php endif; ?>
        </div>
    <?php endif ?>
</div>