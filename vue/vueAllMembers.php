<?php ob_start(); ?>
<?php $title = 'Membres ChessTeam Nogent sur Marne'; ?>
<?php $description = 'Modifiez les informations des membres du blog'; ?>

<?php if (isset($_GET['alert']) AND ($_GET['alert'] == 'aded')) {
    echo '<h4>Nouveau membre vient d\'être ajouté !</h4>';
}
?>

<?php if (isAdmin()) : ?>
    <h1>Voici tous les membres de ChessTeam</h1>

    <?php if (isset($allMembers)) : ?>


        <table class="all_members">

            <caption>Informations internaute</caption>
            <?php foreach ($allMembers as $key => $value) : ?>
                <tr>
                    <th scope="col">Libellé</th>
                    <th scope="col"></th>
                    <th scope="col">Actions</th>
                </tr>


                <tr>
                    <th scope="row">Login
                        <a href="?action=allMembers&amp;memberId=<?= $value->getId_user() ?>" class="hidden-btn">Modifier
                            le compte</a>
                    </th>
                    <td><?= $value->getLogin() ?></td>
                    <td><a href="?action=allMembers&amp;memberId=<?= $value->getId_user() ?>">Modifier le compte</a>
                    </td>

                </tr>

                <tr>
                    <th scope="row">Email
                        <a href="?action=allMembers&amp;deleteM=<?= $value->getId_user() ?>" onclick="return(confirm('Etes-vous sûr de vouloir supprimer?'));" class="hidden-btn">Supprimer
                            le compte</a>
                    </th>
                    <td><?= $value->getEmail() ?></td>
                    <td><a href="?action=allMembers&amp;deleteM=<?= $value->getId_user() ?>" onclick="return(confirm('Etes-vous sûr de vouloir supprimer?'));">Supprimer le compte</a></td>

                </tr>
                <tr>
                    <th scope="row">Password
                        <a href="?action=myArticlesId&amp;idAuthor=<?= $value->getId_user() ?>" class="hidden-btn">Articles</a>
                    </th>
                    <td><input type="password" value="<?= $value->getPassword() ?>"</td>
                    <td>                        <a href="?action=myArticlesId&amp;idAuthor=<?= $value->getId_user() ?>">Articles
                    </td>
                </tr>
                <tr>
                    <th scope="row">Image
                    </th>
                    <td><a href="assets/img/uploads/<?= $value->getUser_image() ?>"><img
                                src="assets/img/uploads/<?= $value->getUser_image() ?>" alt="Photo de profil"
                                title="Cliquez pour agrandir" height="80em"/></a></td>
                    <td></td>

                </tr>


            <?php endforeach; ?>


        </table>

        <h2>Ajouter un nouveau membre :</h2>
        <div class="form-connexion">

            <form action="controller/controllerFrontEnd.php" method="POST" class="form-inscription"
                  enctype="multipart/form-data">
                <div class="form-inscription">
                    <label for="login">Login :

                    <p><input type="text" name="login" id="login" required placeholder="Login" minlength="6"
                              maxlength="10"></p></label>
                </div>
                <div class="form-inscription">
                    <label for="email">Email :

                    <p><input type="email" name="email" id="email" required placeholder="Email" maxlength="25"></p></label>
                </div>
                <div class="form-inscription">
                    <label for="password_members">Mot de passe :

                    <p><input type="password" name="password" id="password_members" required placeholder="Mot de passe"
                              minlength="6"
                              maxlength="10"></p></label>
                </div>
                <div class="form-inscription">
                    <label class="form-inscription" for="image_members">Choisir un image</label>

                    <p><input type="file" name="image_membre" class="image" id="image_members" required accept='.gif, .png , .jpg'></p>
                </div>
                <div class="form-inscription">
                    <p><input type="submit" value="Ajouter !" name="inscription"></p>

                    <p><input type="reset" value="Annuler"/></p>

                </div>
            </form>
        </div>


    <?php endif; ?>
<?php endif; ?>
    <div class="back-page">
        <div class="back-page"><a href="?action=home">Retour à l'accueil</a></div>


    </div>
<?php $template = ob_get_clean(); ?>

<?php require 'templates/tempAccueil.php'; ?>