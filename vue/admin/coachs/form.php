<?php $title = 'Création d\'un coach pour le blog Chess Team Nogent sur Marne'; ?>
<?php $description = 'Les coachs peuvent être contacteés par les utilisateurs'; ?>

<div class="container">
    <h1 class="text-center"><?= isset($params['coach']) ? 'Modifier les informations du coach ' . $params['coach']['first_name'] . ' ' . $params['coach']['last_name'] : 'Créer un nouveau coach' ?></h1>
    <div class="container_form">
        <form action="<?= isset($params['coach']) ? dirname(SCRIPTS) . "/admin/coachs/update/" . $params['coach']['id'] : dirname(SCRIPTS) . "/admin/coachs/create" ?>" method="POST" class="form-inscription" enctype="multipart/form-data">
            <fieldset>
                <legend>Les coordonnées : </legend>
                <div class="form-inscription">
                    <label for="first_name">First name : </label>
                    <input type="hidden" name="id" value="<?= isset($params['coach']) ? $params['coach']['id'] : '' ?>">
                    <input type="hidden" name="old_coach_image" value="<?= isset($params['coach']) ? $params['coach']['coach_image'] : '' ?>">
                    <p><input type="text" name="first_name" value="<?= isset($params['coach']) ? $params['coach']['first_name'] : '' ?>" id="first_name" required placeholder="First name" minlength="3" maxlength="50">
                    </p>
                </div>
                <div class="form-inscription">
                    <label for="last_name">Last name : </label>
                    <p><input type="text" name="last_name" value="<?= isset($params['coach']) ? $params['coach']['last_name'] : '' ?>" id="last_name" required placeholder="Last name" minlength="3" maxlength="50">
                    </p>
                </div>
                <div class="form-inscription">
                    <label for="email">Email : </label>
                    <p><input type="email" name="email" value="<?= isset($params['coach']) ? $params['coach']['email'] : '' ?>" id="email" required placeholder="Email" maxlength="25"></p>
                </div>
                <div class="form-inscription">
                    <label for="password">Mot de passe : </label>
                    <p><input type="password" name="password" id="password" required placeholder="Mot de passe" minlength="6" maxlength="10"></p>
                </div>
                <div class="form-inscription">
                    <label for="city">City : </label>
                    <p><input type="text" name="city" value="<?= isset($params['coach']) ? $params['coach']['city'] : '' ?>" id="city" required placeholder="City" minlength="3" maxlength="50"></p>
                </div>
                <div class="form-inscription">
                    <label for="price">Price : </label>
                    <p><input class="price" type="number" name="price" value="<?= isset($params['coach']) ? $params['coach']['price'] : '' ?>" id="price" required placeholder="Price €/h " min="0">
                    </p>
                </div>
                <div class="form-inscription">
                    <label for="">Description :</label>
                    <p><textarea maxlength="100" minlength="5" required name="description" placeholder="Description" rows="5" cols="33"><?= isset($params['coach']) ? $params['coach']['description'] : '' ?></textarea></p>

                </div>
                <div class="form-inscription">
                    <label for="stars">Stars : </label>
                    <p><input class="price" type="number" name="nb_stars" value="<?= isset($params['coach']) ? $params['coach']['nb_stars'] : '' ?>" id="stars" required placeholder="Stars" min="0" max="5"></p>
                </div>
                <div class="form-inscription">
                    <label for="coachings">Coachings :</label>
                    <p><input class="price" type="number" name="nb_coachings" value="<?= isset($params['coach']) ? $params['coach']['nb_coachings'] : '' ?>" id="coachings" required placeholder="Coachings" min="0"></p>
                </div>
                <div class="form-inscription">
                    <label for="lat">Coordonnées (lat) :</label>
                    <p><input type="text" name="lat" value="<?= isset($params['coach']) ? $params['coach']['lat'] : '' ?>" id="lat" required pattern="^-?([0-8]?\d(\.\d{1,6})?|90(\.0{1,6})?)$" title="Invalid latitude. Example: -90 to 90" maxlength="9" /></p>
                </div>
                <div class="form-inscription">
                    <label for="lon">Coordonnées (lon) :</label>
                    <p><input type="text" name="lon" value="<?= isset($params['coach']) ? $params['coach']['lon'] : '' ?>" id="lon" required pattern="^-?((1[0-7]\d(\.\d{1,6})?)|180(\.0{1,6})?|[0-9]?\d(\.\d{1,6})?)$" title="Invalid longitude. Example: -180 to 180" /></p>
                </div>
                <div class="form-inscription">
                    <label class="form-inscription" for="coach_image">Choisir une image</label>
                    <p><input type="file" name="coach_image" class="image" id="coach_image" <?= isset($params['coach']) ? '' : 'required' ?> accept='.gif, .png , .jpg'></p>
                    <?php if (isset($params['coach']['coach_image'])) : ?>
                        <img src="<?= dirname(SCRIPTS) . '/public/img/uploads/' . $params['coach']['coach_image'] ?>" alt="coach image" width="100" />
                    <?php endif ?>
                </div>
                <div class="form-inscription">
                    <p><input type="submit" value="<?= isset($params['coach']) ? 'Modifier' : 'Créer' ?>" name="<?= isset($params['coach']) ? 'updateCoach' : 'createCoach' ?>"></p>
                    <p><input type="reset" value="Annuler" /></p>
                </div>
            </fieldset>
        </form>
    </div>
    <div class="back-page">
        <?= isset($_SERVER['HTTP_REFERER'])
            ? '<a href="' . $_SERVER['HTTP_REFERER'] . '">Retour</a>'
            : '' ?>
        <a href="<?= dirname(SCRIPTS) ?>">Retour à l'accueil</a>
    </div>
</div>