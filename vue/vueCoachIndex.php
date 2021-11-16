<?php ob_start(); ?>

<?php $title = 'Trouvez le mentor de vos rêves en quelques clics'; ?>
<?php $description = 'Cette page affiche le top des coachs'; ?>

<div class="coach-container">
    <div class="meet-coach">
        <h1 class="tag-coach">Trouvez le mentor de vos rêves en quelques clics</h1>
        <form action="controller/controllerFrontEnd.php" method="GET" class="form-coach">
            <label for="">
                <input type="text" name="city" placeholder="VILLE" id="">
                <p class="tag-coach">Plus de critères</p>
            </label>
            <input type="submit" value="Je meetmon Coach" class="coach-button">
        </form>
    </div>
    <?php if (isset($coachs)): ?>
        <div class="top-coachs">
            <h2>Les coachs du mois</h2>
            <ul class="coach-list">
            <?php foreach ($coachs as $coach => $value): ?>
            <li>
                <a href="?action=coach&amp;id_coach=<?= $value['id'] ?>">
                    <img src="./assets/img/uploads/<?= $value['coach_image'] ?>" alt="" class="image-coach">
                    <div class="coach-info">
                        <h3><?= $value['first_name'] .
                            ' ' .
                            $value['last_name'] ?></h3>
                        <span>72€/h</span3>
                    </div>
                    <div>⭐⭐⭐⭐⭐</div>
                </a>
            </li>            
            <?php endforeach; ?>
        </ul>
    </div>
    <?php else : ?>
        <p>Aucun coach trouvé</p>
    <?php endif; ?>
</div>

<?php $template = ob_get_clean(); ?>

<?php require 'templates/tempAccueil.php'; ?>
