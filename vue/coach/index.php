<?php $title = 'Trouvez le mentor de vos rêves en quelques clics'; ?>
<?php $description = 'Cette page affiche le top des coachs'; ?>

<div class="coach-container">
    <div class="meet-coach">
        <h1 class="tag-coach">Trouvez le mentor de vos rêves en quelques clics</h1>
        <form action="<?= dirname(SCRIPTS) . "/coachs/map" ?>" method="POST" class="form-coach">
            <label for="">
                <input type="text" name="city" placeholder="VILLE" id="">
                <p class="tag-coach">Plus de critères</p>
            </label>
            <input type="submit" value="Je meetmon Coach" class="coach-button">
        </form>
    </div>
    <?php if (isset($params['coaches'])): ?>
        <div class="top-coachs">
            <h2>Les coachs du mois</h2>
            <ul class="coach-list">
            <?php foreach ($params['coaches'] as $coach => $value): ?>
            <li>
                <a href="<?= dirname(SCRIPTS) ?>/coachs/<?= $value['id'] ?>">
                    <img src="<?= SCRIPTS . 'img' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . $value['coach_image'] ?>" alt="" class="image-coach">
                    <div class="coach-info">
                        <h3><?= $value['first_name'] .
                            ' ' .
                            $value['last_name'] ?></h3>
                        <span><?= $value['price'] ?>€/h</span3>
                    </div>
                    <div><?php for($i = 0; $i < $value['nb_stars']; $i++) {echo '⭐';} ?></div>
                </a>
            </li>            
            <?php endforeach; ?>
        </ul>
    </div>
    <?php else : ?>
        <p>Aucun coach trouvé</p>
    <?php endif; ?>
</div>
<div class="back-page">
<?= $_SERVER['HTTP_REFERER']
    ? '<a href="' . $_SERVER['HTTP_REFERER'] . '">Retour</a>'
    : '' ?>
    <a href="<?= dirname(SCRIPTS) ?>">Retour à la page d'accueil</a>
</div>