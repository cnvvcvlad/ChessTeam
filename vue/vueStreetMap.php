<?php ob_start(); ?>

<?php $title = 'Touvez un coach autour de vous'; ?>
<?php $description =
    'La carte Open Street Map permet de rechercher un coach autour d\'une adresse'; ?>

    <div id="map"></div>

<?php $template = ob_get_clean(); ?>

<?php require 'templates/tempAccueil.php'; ?>
