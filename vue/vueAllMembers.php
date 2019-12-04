<?php ob_start(); ?>
<?php $title = 'Membres ChessTeam Nogent sur Marne'; ?>
<?php $description = 'Consultez et modifiez les informations de tous les membres du blog'; ?>

<?php if (isAdmin()) : ?>
    <h1>Tous les membres</h1>

    <?php if (isset($allMembers)) : ?>


        <table>
            <caption>Informations internaute</caption>
            <tr>
                <th scope="col">Libellé</th>
                <th scope="col">Valeur</th>
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
                </tr>
                <tr>
                    <th scope="row">Password
                        <button class="hidden-btn">Modifier</button>
                    </th>
                    <td><?= $value->getPassword() ?></td>
                </tr>
                <tr>
                    <th scope="row">Image
                        <button class="hidden-btn">Modifier</button>
                    </th>
                    <td><a href="assets/img/uploads/<?= $value->getUser_image() ?>"><img
                                src="assets/img/uploads/<?= $value->getUser_image() ?>" alt="Photo de profil"
                                title="Cliquez pour agrandir" height="80em"/></a></td>
                </tr>
                <tr>
                    <th><a href="?action=allMembers&amp;deleteM=<?= $value->getId_user() ?>">Supprimer le compte</a></th>

                </tr>


            <?php endforeach; ?>

        </table>


    <?php endif; ?>
<?php endif; ?>
<?php $template = ob_get_clean(); ?>

<?php require 'templates/tempAccueil.php'; ?>