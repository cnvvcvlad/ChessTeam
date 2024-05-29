<?php $title = 'Consulter un billet de ChessTeam'; ?>
<?php $description = 'Trouvez votre article de blog préféré'; ?>

<div class="top_article">

    <?php if (!empty($params['post'])) : ?>
        <?php foreach ($params['post'] as $key => $value) : ?>
            <h1><?= $value->getArt_title() ?></h1>
            <div class="banniere_bouton">
                <?php if (
                    isset($_SESSION['statut']) && $_SESSION['statut'] === 1
                ) : ?>
                    <div class="bouton_commande updateBtn"><a href="<?= dirname(
                                                                        SCRIPTS
                                                                    ) .
                                                                        '/admin/posts/edit/' .
                                                                        $value->getId() ?>">Modifier</a></div>
                    <form method="POST" action="<?= dirname(SCRIPTS) .
                                                    '/admin/posts/delete/' .
                                                    $value->getId() ?>" class="bouton_commande">
                        <input type="submit" value="Supprimer" name="delete" onclick="return(confirm('Etes-vous sûr de vouloir supprimer?'));">
                    </form>
                <?php endif; ?>
            </div>
            <p><span class="information"> Ecrit par</span>
                <span class="mark"><?= $this->showNameAuthor($value->getArt_author()) ?></span>
                le <em><?= $value->getDate_creation() ?></em><span class="information"> dans la catégorie</span>
                <strong><?= isset($value)
                            ? $this->showNameCategory($value->getCategory_id())
                            : '' ?></strong>
            </p>
            <div id="detail_art" class="justify_article">

                <img src="<?= SCRIPTS .
                                'img' .
                                DIRECTORY_SEPARATOR .
                                'uploads' .
                                DIRECTORY_SEPARATOR .
                                $value->getArt_image() ?>" alt="Image de l'article">
                <span><?= $value->getArt_description() ?><br><a href="#cache"> [Lire la suite...] </a></span>

                <div id="cache"><span><?= $value->getArt_content() ?><br><a href="#detail_art"> [Voir moins]</a></span>
                </div>

            </div>


            <div class="comment-block">

                <h3 class="comment-libelle">(<?= isset($params['commentsOfArticle'])
                                                    ? count($params['commentsOfArticle'])
                                                    : '' ?>) Commentaire<?= count($params['commentsOfArticle']) == 1
                                                                            ? ''
                                                                            : 's' ?></h3>
                <?php foreach ($params['commentsOfArticle'] as $keys => $values) : ?>
                    <div class="comment-added">

                        <div class="comment-author">
                            <p>
                                <mark><?= isset($user)
                                            ? $user->showNameAuthor(
                                                $values->getCom_author()
                                            )
                                            : '' ?></mark>
                                le ( <?= $values->getCom_date_creation() ?> )
                            </p>
                        </div>
                        <div class="comment-description">
                            <p><?= $values->getCom_content() ?></p>
                        </div>
                        <?php if (isset($_SESSION['statut']) && $_SESSION['statut'] === 1) : ?>
                            <div class="comment-modify">
                                <a href="<?= dirname(SCRIPTS)?>/admin/comments/edit/<?= $values->getId() ?>" class="comment-modify">Modifier</a>
                            </div>
                        <?php endif; ?>

                    </div>
                <?php endforeach; ?>

                <?php if (isset($_SESSION['id_user']) && null !== $_SESSION['id_user']) : ?>
                    <div class="comment-block">
                        <div class="comment-add">
                            <fieldset>
                                <legend>Ajouter un commentaire</legend>
                                <form action="<?= dirname(SCRIPTS) .
            '/profile/add-comment' ?>" method="POST" class="form-inscription">
                                    <p><input type="hidden" name="com_author" value="<?= htmlspecialchars(
                                                                                            $_SESSION['id_user']
                                                                                        ) ?>"></p>
                                    <input type="hidden" name="article_id" value="<?= $value->getId() ?>">
                                    <textarea minlength="5" required class="comment-text" name="com_content" id="" cols="40" rows="5" placeholder="Commenter" wrap="off"></textarea>

                                    <p><input type="submit" name="commentCreation" value="Envoyer"></p>
                                </form>
                            </fieldset>
                        </div>

                    </div>
                <?php else : ?>
                    <p class="comment-foruser">Vous ne pouvez pas commenter si vous n'êtes pas connecté</p>
                <?php endif; ?>
                <div class="back-page">
                    <?= isset($_SERVER['HTTP_REFERER'])
                        ? '<a href="' . $_SERVER['HTTP_REFERER'] . '">Retour</a>'
                        : '' ?>
                    <a href="<?= dirname(SCRIPTS) ?>">Retour à la page d'accueil</a>
                </div>
            </div>
</div>
<?php endforeach; ?>
<?php endif; ?>