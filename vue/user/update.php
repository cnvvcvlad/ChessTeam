<?php $title = 'Mettre à jour un membre'; ?>
<?php $description =
    'Mettre à jour les informations personnelles'; ?>

<div class="container">
    <h1>Formulaire de mise à jour</h1>
    <?php if (isset($params['user'])) : ?>
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
                        <label>Nouveau mot de passe :<input type="text" required name="password" minlength="6" maxlength="10" value=""></label>
                    </p>
                </div>
                <div class="form-create">
                    <p><label class="form-create" for="user_image">Choisir une image</label>
                        <input class="image" type="file" id="user_image" name="image_membre" required accept='.gif, .png , .jpg'>
                    </p>
                </div>
                <input type="hidden" name="id_user" value="<?= $params['user'][0]->getId_user() ?>">
            </fieldset>
            <div class="form-create">
                <input type="submit" value="Modifier" name="update">

                <p><input type="reset" value="Annuler" /></p>
            </div>
        </form>
    <?php endif ?>
</div>