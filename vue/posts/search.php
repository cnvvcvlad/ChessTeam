<?php $title = 'Résultats de la recherche'; ?>
<?php $description = 'Page des résultats de la recherche'; ?>
<div class="container">
    <h1>Resultats de la recherche :</h1>
    <div>
        <?php if(isset($params['posts']) && $params['posts'] != null): ?>
        <ul>
            <?php foreach ($params['posts'] as $key => $value) : ?>
                <li>
                    <a href="<?= dirname(SCRIPTS) ?>/posts/<?= $value->getId() ?>">
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