<?php $title = 'Articles d\'une seule catégorie'; ?>
<?php $description =
    'Les textes sont triés par différents sous-domaine du monde des échecs'; ?>


    <div class="top_article">
        <?php if (!empty($params['posts'])): ?>
            <?php foreach ($params['posts'] as $key => $value): ?>

                <h1><?= $value->getArt_title() ?></h1>
                <p><span class="information"> Ecrit par</span>
                    <span class="mark"><?= isset($user)
                        ? $user->showNameAuthor($value->getArt_author())
                        : '' ?></span>
                    le <em><?= $value->getDate_creation() ?></em> <span class="information"> dans la catégorie</span>
                    <strong><?= isset($category)
                        ? $category->showNameCategory($value->getCategory_id())
                        : '' ?></strong></p>

                <div class="banniere_bouton">
                    <div class="bouton_commande">
                        <a href="<?= dirname(
                            SCRIPTS
                        ) ?>/posts/<?= $value->getId() ?>" class="bouton_rouge">Voir l'article
                            <img src="<?= SCRIPTS .
                                'img' .
                                DIRECTORY_SEPARATOR .
                                'by_default' .
                                DIRECTORY_SEPARATOR .
                                'flecheblanchedroite.png' ?>" alt="le bouton rouge"/></a>

                    </div>
                    <?php if (isset($_SESSION['statut']) && $_SESSION['statut'] === 1): ?>
                        <div class="bouton_commande"><a href="<?= dirname(
                                                                        SCRIPTS
                                                                    ) .
                                                                        '/admin/posts/edit/' .
                                                                        $value->getId() ?>">Modifier</a></div>
                    <?php endif; ?>
                </div>

                <div class="justify_article">
                    <p>
                        <a class="grand_image" href="<?= SCRIPTS .
                            'img' .
                            DIRECTORY_SEPARATOR .
                            'uploads' .
                            DIRECTORY_SEPARATOR .
                            $value->getArt_image() ?>">
                    <img src="<?= SCRIPTS .
                        'img' .
                        DIRECTORY_SEPARATOR .
                        'uploads' .
                        DIRECTORY_SEPARATOR .
                        $value->getArt_image() ?>" alt="Image de la catégorie" title="Cliquez pour agrandir">
                </a>

            <span>
                <?= $value->getArt_description() ?></span>
                    </p>

                    <p>
                        <a href="<?= dirname(
                            SCRIPTS
                        ) ?>/posts/<?= $value->getId() ?>">(<?= isset(
    $params['comment']
)
    ? count($params['comment']->getAllCommentsOfArticle($value->getId()))
    : '' ?>
                            ) Commentaires </a></p>

                </div>
            <div class="separateur"></div>



            <?php endforeach; ?>
        <?php else: ?>
            <h3>Il n'y a pas d'articles dans cette catégorie</h3>

        <?php endif; ?>
    </div>
    <div class="back-page">        
        <?= isset($_SERVER['HTTP_REFERER'])
            ? '<a href="' . $_SERVER['HTTP_REFERER'] . '">Retour</a>'
            : '' ?>
        <a href="?action=home">Retour à l'accueil</a>
    </div>