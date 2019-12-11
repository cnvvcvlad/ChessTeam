<?php ob_start(); ?>
<?php $title = 'Membres ChessTeam Nogent sur Marne'; ?>
<?php $description = 'Modifiez les informations des membres du blog'; ?>

<?php if (isset($_GET['alert']) AND ($_GET['alert'] == 'aded')) {
    echo '<h4>Nouveau membre vient d\'être ajouté !</h4>';
}
?>

<?php if (isAdmin()) : ?>
    <h1>Tous les membres</h1>

    <?php if (isset($allMembers)) : ?>


        <table>
            <caption>Informations internaute</caption>
            <tr>
                <th scope="col">Libellé</th>
                <th scope="col"></th>
                <th scope="col">Actions</th>
            </tr>
            <?php foreach ($allMembers as $key => $value) : ?>

                <tr>
                    <th scope="row">Login
                        <button class="hidden-btn">Modifier</button>
                    </th>
                    <td><?= $value->getLogin() ?></td>
                    <td><a href="?action=allMembers&amp;memberId=<?= $value->getId_user() ?>">Modifier</a></td>
                </tr>
                <tr>
                    <th scope="row">Email
                        <button class="hidden-btn">Modifier</button>
                    </th>
                    <td><?= $value->getEmail() ?></td>
                    <td></td>
                </tr>
                <tr>
                    <th scope="row">Password
                        <button class="hidden-btn">Modifier</button>
                    </th>
                    <td><?= $value->getPassword() ?></td>
                    <td></td>
                </tr>
                <tr>
                    <th scope="row">Image
                        <button class="hidden-btn">Modifier</button>
                    </th>
                    <td><a href="assets/img/uploads/<?= $value->getUser_image() ?>"><img
                                src="assets/img/uploads/<?= $value->getUser_image() ?>" alt="Photo de profil"
                                title="Cliquez pour agrandir" height="80em"/></a></td>
                    <td><a href="?action=allMembers&amp;deleteM=<?= $value->getId_user() ?>">Supprimer le compte</a>
                    </td>
                </tr>


            <?php endforeach; ?>

        </table>

        <h2>Ajouter un nouveau membre :</h2>
        <div class="form-connexion">

            <form action="controller/controllerFrontEnd.php" method="POST" class="form-inscription"
                  enctype="multipart/form-data">
                <div class="form-inscription">
                    <label for="login">Login : </label>

                    <p><input type="text" name="login" id="login" required placeholder="Login" minlength="6"
                              maxlength="10"></p>
                </div>
                <div class="form-inscription">
                    <label for="email">Email : </label>

                    <p><input type="email" name="email" id="email" required placeholder="Email" maxlength="25"></p>
                </div>
                <div class="form-inscription">
                    <label for="password">Mot de passe : </label>

                    <p><input type="password" name="password" id="password" required placeholder="Mot de passe"
                              minlength="6"
                              maxlength="10"></p>
                </div>
                <div class="form-inscription">
                    <label for="image">Image : </label>

                    <p><input type="file" name="image_membre" id="image" required accept='.gif, .png , .jpg'></p>
                </div>
                <div class="form-inscription">
                    <p><input type="submit" value="Ajouter !" name="inscription"></p>

                    <p><input type="reset" value="Annuler"/></p>

                </div>
            </form>
        </div>


    <?php endif; ?>
<?php endif; ?>
<?php $template = ob_get_clean(); ?>

<?php require 'templates/tempAccueil.php'; ?>