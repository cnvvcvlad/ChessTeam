<?php ob_start(); ?>

<?php $title = 'Consulter un billet de ChessTeam'; ?>
<?php $description = 'Trouvez votre article de blog préféré'; ?>


    <div class="top_article">

<?php if (!empty($articleId)): ?>
    <?php foreach ($articleId as $key => $value): ?>
        <h1><?= $value->getArt_title() ?></h1>
        <div class="banniere_bouton">
            <?php if (isAdmin()): ?>
                <div class="bouton_commande"><a href="?action=allArticles&amp;updateA=<?= $value->getId() ?>" >Modifier</a></div>
                <div class="bouton_commande"><a
                        href="?action=allArticles&amp;deleteA=<?= $value->getId() ?>" onclick="return(confirm('Etes-vous sûr de vouloir supprimer?'));">Supprimer</a></div>

            <?php endif; ?>
        </div>
        <p><span class="information"> Ecrit par</span>
            <span class="mark"><?= isset($user) ? $user->showNameAuthor(
                $value->getArt_author()
            ) : '' ?></span>
            le <em><?= $value->getArt_date_creation() ?></em><span class="information"> dans la catégorie</span>
            <strong><?= showNameCategory(
                $value->getCategory_id()
            ) ?></strong></p>
        <div id="detail_art" class="justify_article">

                <img src="assets/img/uploads/<?= $value->getArt_image() ?>" alt="Image de l'article">
            <span><?= $value->getArt_description() ?><br><a href="#cache"> [Lire la suite...] </a></span>

            <div id="cache"><span><?= $value->getArt_content() ?><br><a href="#detail_art"> [Voir moins]</a></span>
            </div>

        </div>


        <div class="comment-block">

            <h3 class="comment-libelle">(<?php numberCommentsOfArticle(
                $commentsOfArticle
            ); ?>) Commentaires </h3>
            <?php foreach ($commentsOfArticle as $keys => $values): ?>
                <div class="comment-added">

                    <div class="comment-author">
                        <p>
                            <mark><?= isset($user) ? $user->showNameAuthor(
                                $values->getCom_author()
                            ) : '' ?></mark>
                            le ( <?= $values->getCom_date_creation() ?> )
                        </p>
                    </div>
                    <div class="comment-description"><p><?= $values->getCom_content() ?></p></div>
                    <?php if (isAdmin()): ?>
                    <div class="comment-modify">
                        <a href="?action=allComments&amp;modifyC=<?= $values->getId() ?>" class="comment-modify">Modifier</a>
                    </div>
                    <?php endif; ?>

                </div>
            <?php endforeach; ?>

            <?php if (isConnected()): ?>
                <div class="comment-block">
                    <div class="comment-add">
                        <fieldset>
                            <legend>Ajouter un commentaire</legend>
                            <form action="src/controller/controllerFrontEnd.php" method="POST" class="form-inscription">
                                <p><input type="hidden" name="com_author"
                                          value="<?= htmlspecialchars(
                                              $_SESSION['id_user']
                                          ) ?>"></p>
                                <input type="hidden" name="article_id"
                                       value="<?= $value->getId() ?>">
                                <textarea class="comment-text" name="com_content" id="" cols="40" rows="5"
                                          placeholder="Commenter" wrap="off"></textarea>

                                <p><input type="submit" name="commentCreation" value="Envoyer"></p>
                            </form>
                        </fieldset>
                    </div>

                </div>
            <?php else: ?>
                <p class="comment-foruser">Vous ne pouvez pas commenter si vous n'êtes pas connecté</p>
            <?php endif; ?>
            <div class="back-page">
                <a href="<?= substr(
                    basename($_SERVER['HTTP_REFERER']),
                    0
                ) ?>">Retour</a>
                <a href="?action=home">Retour à l'accueil</a>
                <!-- <a href="?action=allArticles">Consulter les articles du blog</a> -->
            </div>
        </div>
    </div>
    <?php endforeach; ?>
<?php endif; ?>
<?php $template = ob_get_clean(); ?>
<?php require 'templates/tempAccueil.php'; ?>
