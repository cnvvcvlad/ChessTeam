<?php ob_start(); ?>

<?php $title = 'Trouvez le mentor de vos rêves en quelques clics'; ?>
<?php $description = 'Cette page affiche le top des coachs'; ?>

<div class="coach-container">
    <div class="meet-coach">
        <h1 class="tag-coach">Trouvez le mentor de vos rêves en quelques clics</h1>
        <form action="" class="form-coach">
            <label for="">
                <input type="text" name="city" placeholder="VILLE" id="">
                <p class="tag-coach">Plus de critères</p>
            </label>
            <input type="submit" value="Je meetmon Coach" class="coach-button">
        </form>
    </div>
    <div class="top-coachs">
        <h2>Les coachs du mois</h2>
        <ul class="coach-list">
            <li>
                <a href="?action=coach&amp;id_coach=1">
                    <img src="./assets/img/uploads/ma_photo.png" alt="" class="image-coach">
                    <div class="coach-info">
                        <h3>John Doe</h3>
                        <span>72€/h</span3>
                    </div>
                    <div>⭐⭐⭐⭐⭐</div>
                </a>
            </li>
            <li>
                <a href="http://">
                    <img src="./assets/img/uploads/ma_photo.png" alt="" class="image-coach">
                    <div class="coach-info">
                        <h3>John Doe</h3>
                        <span>72€/h</span3>
                    </div>
                    <div>⭐⭐⭐⭐⭐</div>
                </a>
            </li>
            <li>
                <a href="http://">
                    <img src="./assets/img/uploads/ma_photo.png" alt="" class="image-coach">
                    <div class="coach-info">
                        <h3>John Doe</h3>
                        <span>72€/h</span3>
                    </div>
                    <div>⭐⭐⭐⭐⭐</div>
                </a>
            </li>
        </ul>
    </div>
</div>

<?php $template = ob_get_clean(); ?>

<?php require 'templates/tempAccueil.php'; ?>
