<?php $title = 'Membres ChessTeam Nogent sur Marne'; ?>
<?php $description = 'Modifiez les informations des membres du blog'; ?>
<div class="container">
    <?php if ($this->isConnected() && $_SESSION['statut'] === 1) : ?>
        <h1>Voici tous les membres de ChessTeam</h1>
        <div class="justify_article">
            <a href="<?= dirname(
                            SCRIPTS
                        ) ?>/admin/members/create" class="">Créer un nouveau membre</a>
        </div>
        <?php if (isset($params['members'])) : ?>
            <table class="all_members">
                <?php foreach ($params['members'] as $key => $value) : ?>
                    <tr>
                        <th scope="col">Libellé</th>
                        <th scope="col">Login</th>
                        <th scope="col">Email</th>
                        <th scope="col">Image</th>
                        <th scope="col">Actions</th>
                    </tr>
                    <tr>
                        <th scope="row"><?= $value->getId_user() ?></th>
                        <td><?= $value->getLogin() ?></td>
                        <td><?= $value->getEmail() ?></td>
                        <td><a href="<?= SCRIPTS ?>/img/uploads/<?= $value->getUser_image() ?>"><img src="<?= SCRIPTS ?>/img/uploads/<?= $value->getUser_image() ?>" alt="Photo de profil" title="Cliquez pour agrandir" height="80em" /></a></td>
                        <td>
                            <div class="bouton_commande">
                                <a href="<?= dirname(SCRIPTS) ?>/profile/update/<?= $value->getId_user() ?>">Modifier le compte</a>
                            </div>
                            <form method="POST" onclick="return(confirm('Etes-vous sûr de vouloir supprimer votre compte?'));" action="<?= dirname(SCRIPTS) . "/profile/delete/" . $value->getId_user() ?>" class="bouton_commande">
                                <input type="submit" value="Supprimer le compte" name="delete">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    <?php endif; ?>
    <div class="back-page">
    <?= isset($_SERVER['HTTP_REFERER'])
        ? '<a href="' . $_SERVER['HTTP_REFERER'] . '">Retour</a>'
        : '' ?>
    <a href="<?= dirname(SCRIPTS) ?>">Retour à l'accueil</a>
</div>
</div>