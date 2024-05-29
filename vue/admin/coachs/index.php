<?php $title = 'Coachs ChessTeam Nogent sur Marne'; ?>
<?php $description = 'Modifiez les informations des coachs'; ?>
<div class="container">
    <?php if ($this->isConnected() && $_SESSION['statut'] === 1) : ?>
        <h1>Voici tous les coachs de ChessTeam</h1>
        <div class="justify_article">
            <a href="<?= dirname(
                            SCRIPTS
                        ) ?>/admin/coachs/create" class="">Créer un nouveau coach</a>
        </div>
        <?php if (isset($params['coachs'])) : ?>
            <table class="all_members">
                <?php foreach ($params['coachs'] as $key => $value) : ?>
                    <tr>
                        <th scope="col">Libellé</th>
                        <th scope="col">Last name</th>
                        <th scope="col">First name</th>
                        <th scope="col">City</th>
                        <th scope="col">Image</th>
                        <th scope="col">Actions</th>
                    </tr>
                    <tr>
                        <th scope="row"><?= $value['id'] ?></th>
                        <td><?= $value['last_name'] ?></td>
                        <td><?= $value['first_name'] ?></td>
                        <td><?= $value['city'] ?></td>
                        <td><a href="<?= SCRIPTS ?>/img/uploads/<?= $value['coach_image'] ?>"><img src="<?= SCRIPTS ?>/img/uploads/<?= $value['coach_image'] ?>" alt="Photo de profil" title="Cliquez pour agrandir" height="80em" /></a></td>
                        <td>
                            <div class="bouton_commande">
                                <a href="<?= dirname(SCRIPTS) ?>/admin/coachs/edit/<?= $value['id'] ?>">Modifier le compte</a>
                            </div>
                            <form method="POST" onclick="return(confirm('Etes-vous sûr de vouloir supprimer votre compte?'));" action="<?= dirname(SCRIPTS) . "/admin/coachs/delete/" . $value['id'] ?>" class="bouton_commande">
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