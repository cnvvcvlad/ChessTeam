<?php $title =
    'Consultez les informations utiles et complétez le formulaire'; ?>
<?php $description =
    'Cette page affiche l\'information d\'un coach et permet de réserver une séance'; ?>

<?php if (isset($params['coach'])): ?>
<div class="container coach-data">
    <div class="container coach-description">
        <div>
        <a href="<?= SCRIPTS .
            'img' .
            DIRECTORY_SEPARATOR .
            'uploads' .
            DIRECTORY_SEPARATOR .
            $params['coach']['coach_image'] ?>">
        <img 
        src="<?= SCRIPTS .
            'img' .
            DIRECTORY_SEPARATOR .
            'uploads' .
            DIRECTORY_SEPARATOR .
            $params['coach']['coach_image'] ?>" 
        alt="Photo de profil" title="Cliquez pour agrandir" 
        class="image-coach">
        </a>
            <div class="coach-info">
                <h3><?= $params['coach']['first_name'] .
                    ' ' .
                    $params['coach']['last_name'] ?> </h3>
                <span><?= $params['coach']['price'] ?>€/h</span3>
            </div>
        </div>
        <div><?php for ($i = 0; $i < $params['coach']['nb_stars']; $i++) {
            echo '⭐';
        } ?><span> <?= $params['coach'][
    'nb_coachings'
] ?> coachings </span></div>
        <div class="coach-info">
            <h1>Présentation</h1>
            <p><?= $params['coach']['description'] ?></p>
        </div>
        <div class="">
            <h2>Avis</h2>
            <div class="opinion">
                <div>⭐⭐⭐⭐⭐<span><strong> Christian D.</strong></span></div>

                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Officia laudantium iusto,
                    ad hic repellendus nisi molestiae voluptatibus maxime maiores doloribus dolor, quis
                    accusamus modi cum quaerat voluptate! Dicta, iusto. Laboriosam.</p>
            </div>
        </div>
    </div>
    <div class="container">
        <h1>Où est-ce que <?= $params['coach'][
            'first_name'
        ] ?> doit vous rejoindre ?</h1>
        <form action="<?= dirname(SCRIPTS) .
            '/coachs/paiement' ?>" class="container" method="post">
            <div>
                <input type="text" name="town" placeholder="Ville" id="" class="coach-input">
                <input type="number" name="cp" placeholder="Code postal" id="" class="coach-input">
            </div>
            <input type="text" name="adress" placeholder="Adresse" id="" class="coach-input full-width">
            <input type="text" name="aditional" placeholder="Complément d'adresse" id="" class="coach-input full-width">
            <input type="submit" value="Procéder au paiement" class="coach-input full-width">
        </form>
    </div>
</div>
<?php else: ?>
<div class="container">
    <h1>Aucun coach trouvé</h1>
</div>
<?php endif; ?>
<div class="back-page">
    <a href="<?= dirname(SCRIPTS) ?>">Retour à l'accueil</a>
</div>