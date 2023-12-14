<?php $title = 'Accueil Membre'; ?>
<?php $description =
    'Administration des informations personnelles'; ?>
<div class="container">
    <h1> Bienvenue dans votre espace !</h1>

    <div class="top_article">
        <h3>Vous trouverez ci-dessus une barre de navigation qui vous permettra de:</h3>
        <div class="view">
            <?php if ($this->isConnected()) : ?>
                <ul>
                    <li>consulter et modifier ses informations personnelles</li>
                </ul>
                <ul>
                    <li>consulter vos articles</li>
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

                <?php if ($this->isConnected() && $_SESSION['statut'] === 1) : ?>

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
    </div>
    <?php if (isset($params['user'])) : ?>
        <?php foreach ($params['user'] as $key => $value) : ?>
            <div class="table-update">
                <div>
                    <table class="table-update">
                        <caption>Informations de l'internaute <?= $value->getLogin() ?></caption>
                        <tr>
                            <th scope="col">Libellé</th>
                            <th scope="col">Valeur</th>
                            <th scope="col">Actions</th>
                        </tr>
                        <tr>
                            <th scope="row">
                                <p>Login</p>
                            </th>
                            <td><input type="text" readonly name="login" value="<?= $value->getLogin() ?>"></td>
                            <td>
                                <div class="bouton_commande">
                                    <a href="<?= dirname(SCRIPTS) . "/profile/update/" . $value->getId_user() ?>">Modifier mes infos</a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <p>Email</p>
                            </th>
                            <td><input type="text" readonly name="email" value="<?= $value->getEmail() ?>"></td>
                            <td>
                                <form method="POST" action="<?= dirname(SCRIPTS) . "/profile/delete/" . $value->getId_user() ?>" class="bouton_commande">
                                    <input type="submit" value="Supprimer mon compte" name="delete">
                                </form>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">
                                <p>Image</p>
                            </th>
                            <td>
                                <a href="<?= SCRIPTS .
                                                'img' .
                                                DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR .
                                                $value->getUser_image() ?>">

                                    <img src="<?= SCRIPTS .
                                                    'img' .
                                                    DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR .
                                                    $value->getUser_image() ?>" alt="Photo de profil" title="Cliquez pour agrandir" height="50em" /></a>
                                <input type="text" readonly name="image" value="<?= $value->getUser_image() ?>">
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>