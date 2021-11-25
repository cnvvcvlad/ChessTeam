<?php ob_start(); ?>

<?php $title = 'Touvez un coach autour de vous'; ?>
<?php $description =
    'La carte Open Street Map permet de rechercher un coach autour d\'une adresse'; ?>

    <div id="map"></div>
    <div class="back-page">
        <a href="<?= substr(basename($_SERVER['HTTP_REFERER']), 0) ?>">Retour</a>
        <a href="?action=home">Retour à l'accueil</a>
    </div>

<?php $template = ob_get_clean(); ?>

<?php require 'templates/tempAccueil.php'; ?>
