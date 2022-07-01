<?php $title = 'Trouvez le mentor de vos rêves en quelques clics'; ?>
<?php $description = 'Cette page affiche le top des coachs'; ?>

<div class="coach-container">
    <div class="meet-coach">
        <h1 class="tag-coach">Trouvez le mentor de vos rêves en quelques clics</h1>
        <form action="<?= dirname(SCRIPTS) .
            '/coachs/map' ?>" method="POST" class="form-coach" name="coachForm" id="coachCriteria">
            <div>
                <label for="city">
                    <input type="text" name="city" placeholder="VILLE" id="city">
                </label>
                <label for="price">
                    <select name="price" class="coach-criteria" id="price">
                        <option value="">Prix €</option>
                        <option value="<50">moins de 50</option>
                        <option value="<75">moins de 75</option>
                        <option value="<100">moins de 100</option>
                        <option value=">=100">plus de 100</option>
                    </select>
                </label>
                <label for="stars">
                    <select name="stars" class="coach-criteria" id="stars">
                        <option value="">Etoiles</option>
                        <option value="<3">moins de 3</option>
                        <option value="<4">moins de 4</option>
                        <option value="<5">moins de 5</option>
                        <option value=">=5">5 et plus</option>
                    </select>
                </label>
                <label for="coachs">
                    <select name="coachings" class="coach-criteria" id="coachs">
                        <option value="">Missions</option>
                        <option value="<10">moins de 10</option>
                        <option value="<50">moins de 50</option>
                        <option value="<100">moins de 100</option>
                        <option value=">100">100 et plus</option>
                    </select>
                </label>
            </div>
            <div class="coach-input">
                <input type="button" id="criteria" value="" class="coach-button">
                <input
                 type="submit" 
                 id="coachMeeting"                  
                 value="Je meet mon Coach" class="coach-button">
            </div>
        </form>
    </div>
    <?php if (isset($params['coaches'])): ?>
        <div class="top-coachs">
            <h2>Les coachs du mois</h2>
            <ul class="coach-list">
            <?php foreach ($params['coaches'] as $coach => $value): ?>
            <li>
                <a href="<?= dirname(SCRIPTS) ?>/coachs/<?= $value['id'] ?>">
                    <img src="<?= SCRIPTS .
                        'img' .
                        DIRECTORY_SEPARATOR .
                        'uploads' .
                        DIRECTORY_SEPARATOR .
                        $value['coach_image'] ?>" alt="" class="image-coach">
                    <div class="coach-info">
                        <h3><?= $value['first_name'] .
                            ' ' .
                            $value['last_name'] ?></h3>
                        <span><?= $value['price'] ?>€/h</span3>
                    </div>
                    <div><?php for ($i = 0; $i < $value['nb_stars']; $i++) {
                        echo '⭐';
                    } ?></div>
                </a>
            </li>            
            <?php endforeach; ?>
        </ul>
    </div>
    <?php else: ?>
        <p>Aucun coach trouvé</p>
    <?php endif; ?>
</div>
<div class="back-page">
<?= $_SERVER['HTTP_REFERER']
    ? '<a href="' . $_SERVER['HTTP_REFERER'] . '">Retour</a>'
    : '' ?>
    <a href="<?= dirname(SCRIPTS) ?>">Retour à la page d'accueil</a>
</div>