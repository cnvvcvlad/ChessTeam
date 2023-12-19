<?php $title = 'Touvez un coach autour de vous'; ?>
<?php $description =
    'La carte Open Street Map permet de rechercher un coach autour d\'une adresse'; ?>

    <div id="map"></div>
    <div class="back-page">
    <?= isset($_SERVER['HTTP_REFERER'])
        ? '<a href="' . $_SERVER['HTTP_REFERER'] . '">Retour</a>'
        : '' ?>
        <a href="<?= dirname(SCRIPTS) ?>">Retour à l'accueil</a>
    </div>