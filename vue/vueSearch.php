<?php ob_start(); ?>
<?php $title = 'Résultats de la recherche'; ?>
<?php $description = 'Page de résultats de la recherche'; ?>
<div class="container">
    <h1>Resultats de la recherche :</h1>
    <div>
        <?php if(isset($searchResults) && $searchResults != null): ?>
        <ul>
            <?php foreach ($searchResults as $key => $value) : ?>
                <li>
                    <a href="?action=allArticles&amp;id=<?= $value->getId() ?>">
                        <?= $value->getArt_title() ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
        <?php else : ?>
            <p>Aucun résultat</p>
        <?php endif; ?>
    </div>
</div>
<div class="back-page">
    <a href="<?= substr(
        basename($_SERVER['HTTP_REFERER']),
        0
    ) ?>">Retour</a>
    <a href="?action=home">Retour à l'accueil</a>
</div>
<?php $template_form = ob_get_clean(); ?>
<?php require 'templates/tempForm.php'; ?>