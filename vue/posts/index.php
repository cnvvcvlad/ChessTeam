<?php $title = 'Article du blog'; ?>
<?php $description = 'Cette page affiche tous les articles du site web'; ?>


<?php if (!empty($params['posts'])) : ?>

    <!-- <h1>Voici tous nos articles!<br>
        N'hésitez pas à nous donner votre avis dans les commentaires!</h1> -->

    <div class="top_article">
        <?php foreach ($params['posts'] as $key => $value) : ?>


            <h1><img src="<?= SCRIPTS .
                                'img' .
                                DIRECTORY_SEPARATOR .
                                'by_default' .
                                DIRECTORY_SEPARATOR .
                                'ico_epingle.png' ?>" alt="Catégorie" class="ico_categorie" /><?= $value->getArt_title() ?></h1>

            <div class="banniere_bouton">
                <?php if ($this->isConnected() && $_SESSION['statut'] === 1) : ?>
                    <div class="bouton_commande"><a href="<?= dirname(
                                                                SCRIPTS
                                                            ) ?>/posts/<?= $value->getId() ?>">Modifier</a>
                    </div>
                <?php endif; ?>
                <div class="bouton_commande">
                    <a href="<?= dirname(
                                    SCRIPTS
                                ) ?>/posts/<?= $value->getId() ?>" class="bouton_rouge">Voir l'article
                        <img src="<?= SCRIPTS .
                                        'img' .
                                        DIRECTORY_SEPARATOR .
                                        'by_default' .
                                        DIRECTORY_SEPARATOR .
                                        'flecheblanchedroite.png' ?>" alt="le bouton rouge" /></a>
                </div>
            </div>
            <p><span class="information"> Ecrit par</span>
                <span class="mark"><?= isset($user)
                                        ? $user->showNameAuthor($value->getArt_author())
                                        : '' ?></span>
                le <em><?= $value->getDate_creation() ?></em> <span class="information"> dans la catégorie</span>
                <strong><?= isset($category)
                            ? $category->showNameCategory($value->getCategory_id())
                            : '' ?></strong>
            </p>

            <div id="detail_art" class="justify_article">

                <a class="grand_image" href="<?= SCRIPTS .
                                                    'img' .
                                                    DIRECTORY_SEPARATOR .
                                                    'uploads' .
                                                    DIRECTORY_SEPARATOR .
                                                    $value->getArt_image() ?>"><img src="<?= SCRIPTS .
                                                                'img' .
                                                                DIRECTORY_SEPARATOR .
                                                                'uploads' .
                                                                DIRECTORY_SEPARATOR .
                                                                $value->getArt_image() ?>" alt="Image de l'article" title="Cliquez pour agrandir"></a>

                <h3><?= $value->getArt_description() ?></h3>
                <p>
                    <a href="<?= dirname(
                                    SCRIPTS
                                ) ?>/posts/<?= $value->getId() ?>">
                        (<?= isset($params['comment'])
                                ? count(
                                    $params['comment']->getAllCommentsOfArticle(
                                        $value->getId()
                                    )
                                )
                                : '' ?>) Commentaires
                    </a>
                </p>

            </div>
            <div class="separateur"></div>

        <?php endforeach; ?>
    </div>
    <?php if (isset($page)) : ?>
        <nav class="paginator">
            <li class="list_style page-item"><a href="?action=allArticles&amp;page=<?= $currentPage -
                                                                                        1 ?>" class="<?= $currentPage == 1
                                ? 'disabled'
                                : '' ?>">Précédente</a></li>
            <?php for ($page = 1; $page <= $nbPages; $page++) : ?>
                <li class="list_style page-item">
                    <a href="?action=allArticles&amp;page=<?= $page ?>" class="page-link-<?= $currentPage ==
                                                                                                $page
                                                                                                ? 'active'
                                                                                                : '' ?>"><?= $page ?>
                    </a>
                </li>
            <?php endfor; ?>
            <li class="list_style page-item"><a href="?action=allArticles&amp;page=<?= $currentPage +
                                                                                        1 ?>" class="<?= $currentPage == $nbPages
                                ? 'disabled'
                                : '' ?>">Suivante</a></li>
        </nav>
    <?php endif; ?>
    </div>
<?php endif; ?>
<div class="back-page">
    <?= $_SERVER['HTTP_REFERER']
        ? '<a href="' . $_SERVER['HTTP_REFERER'] . '">Retour</a>'
        : '' ?>
    <a href="<?= dirname(SCRIPTS) ?>">Retour à l'accueil</a>
</div