<?php $title = 'Mettre à jour un membre'; ?>
<?php $description =
    'Mettre à jour les informations personnelles'; ?>

<div class="container">
    <h1>Formulaire de mise à jour</h1>
    <?php  if (isset($params['user'])) : ?>
        <form action="<?= dirname(SCRIPTS) . "/profile/update/" . $params['user'][0]->getId_user() ?>" method="POST" enctype="multipart/form-data" class="form-create">
            <fieldset>
                <legend>Introduisez vos informations</legend>
                <div class="form-create">
                    <p>
                        <label>Login :<input type="text" required name="login" minlength="6" maxlength="10" value="<?= $params['user'][0]->getLogin() ?>"></label>
                    </p>
                </div>
                <div class="form-create">
                    <p><label>Email :<input type="text" required name="email" maxlength="25" value="<?= $params['user'][0]->getEmail() ?>"></label></p>
                </div>
                <div class="form-create">
                    <p>
                        <label>Nouveau mot de passe :<input type="password" required name="password" minlength="6" maxlength="10" value=""></label>
                    </p>
                </div>
                <div class="form-create">
                    <p><label class="form-create" for="user_image">Choisir une image</label>
                        <input class="image" type="file" id="user_image" name="image_membre" accept='.gif, .png , .jpg'>
                    </p>
                    <?php if (
                    isset($params['user'][0]) and
                    !empty($params['user'][0]->getUser_image())
                ): ?>
                    <img src="<?= dirname(SCRIPTS) .
                        '/public/img/uploads/' .
                        $params[
                            'user'
                        ][0]->getUser_image() ?>" alt="" width="100">
                <?php endif; ?>
                </div>
                <input type="hidden" name="id_user" value="<?= $params['user'][0]->getId_user() ?>">
                <input type="hidden" name="old_image" value="<?= isset(
                $params['user'][0]
            )
                ? $params['user'][0]->getUser_image()
                : '' ?>">
            </fieldset>
            <div class="form-create">
                <input type="submit" value="Modifier" name="update">

                <p><input type="reset" value="Annuler" /></p>
            </div>
        </form>
    <?php endif ?>
    <div class="back-page">
    <?= isset($_SERVER['HTTP_REFERER'])
        ? '<a href="' . $_SERVER['HTTP_REFERER'] . '">Retour</a>'
        : '' ?>
        <a href="<?= dirname(SCRIPTS) ?>">Retour à l'accueil</a>
    </div>
</div>