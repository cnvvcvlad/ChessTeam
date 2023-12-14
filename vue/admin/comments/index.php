<?php $title = 'Liste des commentaires'; ?>
<?php $description =
    'Voir les commentaires des internautes sur différents sujets des échecs'; ?>

<div class="container">
    <?php if ($this->isConnected() && $_SESSION['statut'] === 1) : ?>
        <?php if (isset($params['comments'])) : ?>
            <h1>Voici tous les commentaires postés</h1>
            <div class="top_article">
                <?php foreach ($params['comments'] as $key => $value) : ?>
                    <div class="comment-added">
                        <div class="comment-author">
                            <p>
                                <span class="mark"><?= isset($user)
                                                        ? $user->showNameAuthor($value->getCom_author())
                                                        : '' ?></span>
                                le ( <?= $value->getCom_date_creation() ?> )
                            </p>
                        </div>
                        <div class="comment-description">
                            <p><?= $value->getCom_content() ?></p>
                        </div>
                        <div class="comment-modify">
                            <a href="<?= dirname(SCRIPTS) ?>/admin/comments/edit/<?= $value->getId() ?>" class="comment-modify">Modifier</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>