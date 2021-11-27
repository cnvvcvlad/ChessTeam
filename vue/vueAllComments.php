<?php ob_start(); ?>

<?php $title = 'Liste des commentaires'; ?>
<?php $description =
    'Voir les commentaires des internautes sur différents sujets des échecs'; ?>

<?php if ($role->isAdmin()): ?>
<?php if (isset($allComments)): ?>
    <h1>Voici tous les commentaires postés</h1>
    <div class="top_article">
    <?php foreach ($allComments as $key => $value): ?>

        <div class="comment-added">

            <div class="comment-author">
                <p>
                    <span class="mark"><?= isset($user) ? $user->showNameAuthor(
                        $value->getCom_author()
                    ) : '' ?></span>
                    le ( <?= $value->getCom_date_creation() ?> )
                </p>
            </div>
            <div class="comment-description"><p><?= $value->getCom_content() ?></p></div>

            <div class="comment-modify">
                <a href="?action=allComments&amp;modifyC=<?= $value->getId() ?>" class="comment-modify">Modifier</a>
            </div>

        </div>
        <?php endforeach; ?>

<?php endif; ?>
<?php endif; ?>
    </div>
    <div class="back-page">
        <a href="<?= substr(basename($_SERVER['HTTP_REFERER']), 0) ?>">Retour</a>
        <a href="?action=home">Retour à l'accueil</a>
    </div>


<?php $template = ob_get_clean(); ?>

<?php require 'templates/tempAccueil.php'; ?>
