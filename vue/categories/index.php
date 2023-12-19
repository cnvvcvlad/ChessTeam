<?php $title = 'Catégories des articles du blog ChessTeam'; ?>
<?php $description =
    'Retrouvez toutes les catégories des articles publiés sur le site, regardez ses articles et ses commentaires'; ?>
<h1>Voici toutes nos catégories dédiées aux jeux d'échecs</h1>
<div class="top_article">
    <div class="view">
        <?php if (isset($params['categories'])): ?>
            <?php foreach ($params['categories'] as $key => $value): ?>
                <ul>
                    <li><a href="<?= dirname(
                        SCRIPTS
                    ) ?>/categories/<?= $value->getId() ?>"><?= $value->getTitle() ?></a>
                    </li>
                </ul>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div> 
<div class="back-page">
<?php isset($_SERVER['HTTP_REFERER'])
    ? '<a href="' . $_SERVER['HTTP_REFERER'] . '">Retour</a>'
    : '' ?>
    <a href="<?= dirname(SCRIPTS) ?>/">Retour à l'accueil</a>
</div>