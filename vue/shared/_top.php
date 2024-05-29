<div class="en-tete">
    <div class="logo">
        <a href="<?= dirname(SCRIPTS) ?>">
            <!-- <img src="assets/img/logo/logo.png" alt="Le logo du Chess Team Nogent sur Marne" title="Logo" /> -->
            <img src="<?= SCRIPTS .
                'img' .
                DIRECTORY_SEPARATOR .
                'logo' .
                DIRECTORY_SEPARATOR .
                'logo.png' ?>" alt="Le logo du Chess Team Nogent sur Marne" title="Logo" />

        </a>
    </div>
    <div class="objet">
        <nav class="navigation">
            <div id="menu-bar">
                <div id="menu" onclick="onClickMenu()">
                    <div id="bar1" class="bar"></div>
                    <div id="bar2" class="bar"></div>
                    <div id="bar3" class="bar"></div>
                </div>
                <ul class="navigate" id="navigate">
                    <li>
                        <div class="list_style"><a href="<?= dirname(
                            SCRIPTS
                        ) ?>">Accueil</a></div>
                    </li>
                    <li class="has-children">
                        <div class="list_style"><a href="<?= dirname(
                            SCRIPTS
                        ) ?>/categories">Catégories</a>
                        </div>
                        <ul class="sous-menu">
                            <?php foreach (
                                $GLOBALS['allCategories']
                                as $cat => $values
                            ): ?>
                                <li>
                                    <div class="list_style">
                                        <a href="<?= dirname(
                                            SCRIPTS
                                        ) ?>/categories/<?= $values->getId() ?>">
                                            <?= $values->getTitle() ?>
                                        </a>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <li>
                        <div class="list_style"><a href="<?= dirname(
                            SCRIPTS
                        ) ?>/posts">Articles</a></div>
                    </li>
                    <li>
                        <div class="list_style"><a href="<?= dirname(
                            SCRIPTS
                        ) ?>/coachs">ChessCoach</a></div>
                    </li>

                    <?php                                
                        if (isset($_SESSION['id_user'])): ?>
                        <li>
                            <div class="list_style"><a href="<?= dirname(
                                SCRIPTS
                            ) ?>/profile">Mon Compte</a>
                            </div>
                        </li>
                        <li>
                            <div class="list_style"><a href="<?= dirname(
                                SCRIPTS
                            ) ?>/profile/posts">Mes
                                    articles</a>
                            </div>
                        </li>
                        <li>
                            <div class="list_style"><a href="<?= dirname(
                                SCRIPTS
                            ) ?>/admin/posts/create">Créer article</a></div>
                        </li>


                        <?php if (
                            isset($_SESSION['statut']) &&
                            $_SESSION['statut'] === 1
                        ): ?>

                            <li>
                                <div class="list_style"><a href="<?= dirname(
                                    SCRIPTS
                                ) ?>/admin/members">Membres</a></div>
                            </li>
                            <li>
                                <div class="list_style"><a href="<?= dirname(
                                    SCRIPTS
                                ) ?>/admin/comments">Commentaires</a></div>
                            </li>
                        <?php endif; ?>
                        <li>
                            <div class="list_style"><a href="<?= dirname(
                                SCRIPTS
                            ) ?>/logout">Déconnexion</a></div>
                        </li>

                    <?php else: ?>
                        <li>
                            <div class="list_style"><a href="<?= dirname(
                                SCRIPTS
                            ) ?>/login">Connection</a></div>
                        </li>
                        <li>
                            <div class="list_style"><a href="<?= dirname(
                                SCRIPTS
                            ) ?>/register">Inscription</a></div>
                        </li>
                    <?php endif; ?>


                </ul>
            </div>
        </nav>
        <div class="search">
            <form action="<?= dirname(
                SCRIPTS
            ) ?>/search" method="post">
                <input type="text" name="search" placeholder="Rechercher un article" required />
                <input type="submit" value="Rechercher" />
            </form>
        </div>
        <?php  ?>
    </div>
    <div class="menu-bg" id="menu-bg"></div>
    <div class="photo">
        <?php if (empty($_SESSION['user_image'])): ?>
            <a href="<?= SCRIPTS .
                'img' .
                DIRECTORY_SEPARATOR .
                'logo' .
                DIRECTORY_SEPARATOR .
                'pawn_logo.jpg' ?>">
                <img src="<?= SCRIPTS .
                    'img' .
                    DIRECTORY_SEPARATOR .
                    'logo' .
                    DIRECTORY_SEPARATOR .
                    'pawn_logo.jpg' ?>" alt="Photo de profil" title="Cliquez pour agrandir" />
            </a>
        <?php else: ?>
            <a href="<?= SCRIPTS .
                'img' .
                DIRECTORY_SEPARATOR .
                'uploads' .
                DIRECTORY_SEPARATOR .
                $_SESSION['user_image'] ?>">
                <img src="<?= SCRIPTS .
                    'img' .
                    DIRECTORY_SEPARATOR .
                    'uploads' .
                    DIRECTORY_SEPARATOR .
                    $_SESSION[
                        'user_image'
                    ] ?>" alt="Photo de profil" title="Cliquez pour agrandir" height="100em" />
            </a>
        <?php endif; ?>
    </div>
</div>