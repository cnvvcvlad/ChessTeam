<?php ob_start(); ?>

<?php $title = 'Accueil Membre'; ?>
<?php $description = 'Administrez les informations personnelles et actualisez-les'; ?>
<h1> Bienvenue dans l'espace <?php if (isAdmin()) : ?> administrateur <?php else : ?> membre<?php endif; ?></h1>

<div class="top_article">

    <h3>Vous trouverez ci-dessus une barre de navigation qui vous permettra de:</h3>

    <div class="view">

        <?php if (isConnected()) : ?>
            <ul>
                <li>consulter et modifier ses informations personnelles</li>
            </ul>
            <ul>
                <li>consulter ses articles</li>
            </ul>
            <ul>
                <li>consulter tous les articles</li>
            </ul>
            <ul>
                <li>consulter toutes les catégories des articles</li>
            </ul>
            <ul>
                <li>ajouter des nouveaux articles</li>
            </ul>
            <ul>
                <li>consulter et écrire des commentaires</li>
            </ul>

            <?php if (isAdmin()) : ?>

                <ul>
                    <li>consulter la liste des membres</li>
                </ul>
                <ul>
                    <li>modifier les informations ou les supprimer</li>
                </ul>
                <ul>
                    <li>ajouter un nouveau membre</li>
                </ul>
            <?php endif; ?>
        <?php endif; ?>

    </div>


    <h2>Mettez à jour vos données !</h2>


    <?php if (isset($myAccount)) : ?>

        <?php foreach ($myAccount as $key => $value) : ?>
            <div class="table-update">
                <div>
                    <table class="table-update">
                        <caption>Informations internaute</caption>
                        <tr>
                            <th scope="col">Libellé</th>
                            <th scope="col">Valeur</th>
                        </tr>
                        <tr>
                            <th scope="row"><p>Login</p>
                            </th>
                            <td><input type="text" readonly name="login" value="<?= $value->getLogin() ?>"></td>

                        </tr>
                        <tr>
                            <th scope="row"><p>Email</p>
                            </th>
                            <td><input type="text" readonly name="email" value="<?= $value->getEmail() ?>"></td>

                        </tr>

                        <tr>
                            <th scope="row"><p>Image</p>
                            </th>
                            <td>
                                <a href="assets/img/uploads/<?= $value->getUser_image() ?>"><img
                                        src="assets/img/uploads/<?= $value->getUser_image() ?>"
                                        alt="Photo de profil" title="Cliquez pour agrandir" height="80em"/></a>
                                <input type="text" readonly name="image"
                                       value="<?= $value->getUser_image() ?>">
                            </td>

                        </tr>
                        <?php if (!isAdmin()) : ?>
                            <tr>
                                <th><a href="?action=allMembers&amp;deleteM=<?= $_SESSION['id_user'] ?>" class="comment-modify" onclick="return(confirm('Supprimer vraiment?'))">Supprimer
                                        mon compte</a></th>
                            </tr>
                        <?php endif ?>
                    </table>
                    <form action="controller/controllerFrontEnd.php" method="POST" enctype="multipart/form-data"
                          class="form-create">
                        <fieldset>
                            <legend>Introduisez vos informations</legend>
                            <div class="form-create"><p>
                                <label>Login :<input type="text" required name="login" minlength="6"
                                                             maxlength="10"
                                                             value="<?= $value->getLogin() ?>"></label></p>
                            </div>
                            <div class="form-create">
                                <p><label>Email :<input type="text" required name="email" maxlength="25"
                                                                value="<?= $value->getEmail() ?>"></label></p>
                            </div>
                            <div class="form-create"><p>
                                    <label>Nouveau mot de passe :<input type="text" required name="password"
                                                                                minlength="6"
                                                                                maxlength="10"
                                                                                value=""></label></p>
                            </div>
                            <div class="form-create">
                                <p><label class="form-create" for="user_image">Choisir une image</label>
                                    <input class="image" type="file" id="user_image" name="user_image" required
                                           accept='.gif, .png , .jpg'></p>
                            </div>
                            <input type="hidden" name="id_user" value="<?= $value->getId_user() ?>">
                        </fieldset>
                        <div class="form-create">
                            <input type="submit" value="Modifier" name="update">

                            <p><input type="reset" value="Annuler"/></p>
                        </div>
                    </form>
                </div>
            </div>

        <?php endforeach; ?>
    <?php endif; ?>

</div>
<div class="back-page">
    <a href="<?= substr(basename($_SERVER['HTTP_REFERER']), 0) ?>">Retour</a>
    <a href="?action=home">Retour à l'accueil</a>
</div>


<?php $template = ob_get_clean(); ?>

<?php require 'templates/tempAccueil.php'; ?>
