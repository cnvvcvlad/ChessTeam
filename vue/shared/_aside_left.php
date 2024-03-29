<aside class="form_view">
    <div class="top_article_form">
        <?php if (!empty($lastArticle_one)): ?>
            <?php foreach ($lastArticle_one as $key => $value): ?>
                <h2><img src="assets/img/by_default/ico_epingle.png" alt="Catégorie" class="ico_categorie" /><?= $value->getArt_title() ?></h2>
                <?php if ($this->role->isAdmin()): ?>
                    <div class="bouton_commande"><a href="">Modifier</a></div>
                <?php endif; ?>
                <div class="bouton_commande">
                    <a href="?action=allArticles&amp;id=<?= $value->getId() ?>" class="bouton_rouge">Voir
                        l'article <img src="assets/img/by_default/flecheblanchedroite.png" alt="le bouton rouge" /></a>
                </div>
                <p>Ecrit par
                    <span class="mark"><?= isset($user)
                        ? $user->showNameAuthor($value->getArt_author())
                        : '' ?></span>
                    le <em><?= $value->getDate_creation() ?></em> dans la catégorie
                    <strong><?= $this->category->showNameCategory(
                        $value->getCategory_id()
                    ) ?></strong>
                </p>
                <div id="detail_art" class="justify_form">
                    <img src="assets/img/uploads/<?= $value->getArt_image() ?>" alt="Image de l'article">
                    <span><a href="#cache"> [Lire la suite...] </a></span>
                    <div id="cache">
                        <span><?= $value->getArt_description() ?><br>
                            <a href="#detail_art">[Voir moins]</a>
                        </span>
                    </div>
                    <p><a href="?action=allArticles&amp;id=<?= $value->getId() ?>">Commentaires
                            (<?= count(
                                $this->comment->getAllCommentsOfArticle(
                                    $value->getId()
                                )
                            ) ?>)</a>
                    </p>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</aside>