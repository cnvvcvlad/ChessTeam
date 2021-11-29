<header>
    <div class="header-body">
        <div class="countdown-body">
            <h3 class="title-chess whitesmoke">La journée mondiale du jeu d'échecs arrive dans</h3>
            <div class="countdown-container">
                <div class="countdown-el days-c">
                    <p class="big-text whitesmoke" id="days">0</p>
                    <span class="whitesmoke">jours</span>
                </div>
                <div class="countdown-el hours-c">
                    <p class="big-text whitesmoke" id="hours">0</p>
                    <span class="whitesmoke">heures</span>
                </div>
                <div class="countdown-el minutes-c">
                    <p class="big-text whitesmoke" id="minutes">0</p>
                    <span class="whitesmoke">minutes</span>
                </div>
                <div class="countdown-el seconds-c">
                    <p class="big-text whitesmoke" id="seconds">0</p>
                    <span class="whitesmoke">secondes</span>
                </div>
            </div>
        </div>
        <div class="en-tete">
            <div class="logo">
                <a href="?action=home">
                    <img src="assets/img/logo/logo.png" alt="Le logo du Chess Team Nogent sur Marne" title="Logo" />
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
                                <div class="list_style"><a href="?action=home">Accueil</a></div>
                            </li>
                            <li class="has-children">
                                <div class="list_style"><a href="?action=allCategory">Catégories</a>
                                </div>

                                <ul class="sous-menu">
                                    <?php foreach ($allCategory
                                        as $cat => $values) : ?>
                                        <li>
                                            <div class="list_style">
                                                <a href="?action=categoryId&amp;id=<?= $values->getId() ?>">
                                                    <?= $values->getTitle() ?>
                                                </a>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </li>
                            <li>
                                <div class="list_style"><a href="?action=allArticles">Articles</a></div>
                            </li>
                            <li>
                                <div class="list_style"><a href="?action=coach">ChessCoach</a></div>
                            </li>

                            <?php if ($this->role->isConnected()) : ?>
                                <li>
                                    <div class="list_style"><a href="?action=myAccount&amp;id=<?= $_SESSION['id_user'] ?>">Mon Compte</a>
                                    </div>
                                </li>
                                <li>
                                    <div class="list_style"><a href="?action=myArticlesId&amp;id=<?= $_SESSION['id_user'] ?>">Mes
                                            articles</a>
                                    </div>
                                </li>
                                <li>
                                    <div class="list_style"><a href="?action=createArticleId">Créer article</a></div>
                                </li>


                                <?php if ($this->role->isAdmin()) : ?>

                                    <li>
                                        <div class="list_style"><a href="?action=allMembers">Membres</a></div>
                                    </li>
                                    <li>
                                        <div class="list_style"><a href="?action=allComments">Commentaires</a></div>
                                    </li>
                                    <li>
                                        <div class="list_style"><a href="?action=allVs">VS</a></div>
                                    </li>


                                <?php endif; ?>
                                <li>
                                    <div class="list_style"><a href="?action=deconnect">Déconnexion</a></div>
                                </li>

                            <?php else : ?>
                                <li>
                                    <div class="list_style"><a href="?action=connexion">Connection</a></div>
                                </li>
                                <li>
                                    <div class="list_style"><a href="?action=inscription">Inscription</a></div>
                                </li>
                            <?php endif; ?>


                        </ul>
                    </div>
                </nav>
                <div class="search">
                    <!-- <div class="memberInfo"><span><?= isset($user) ? $user->helloUser() : '' ?></span></div> -->
                    <div class="search">
                        <form action="?action=search" method="post">
                            <input type="text" name="search" placeholder="Rechercher un article" required />
                            <input type="submit" value="Rechercher" />
                        </form>
                    </div>
                </div>
                <?php ?>
            </div>
            <div class="menu-bg" id="menu-bg"></div>
            <div class="photo">
                <?php if (empty($_SESSION['user_image'])) : ?>
                    <a href="assets/img/logo/pawn_logo.jpg">
                        <img src="assets/img/logo/pawn_logo.jpg" alt="Photo de profil" title="Cliquez pour agrandir" />
                    </a>
                <?php else : ?>
                    <a href="assets/img/uploads/<?= $_SESSION['user_image'] ?>">
                        <img src="assets/img/uploads/<?= $_SESSION['user_image'] ?>" alt="Photo de profil" title="Cliquez pour agrandir" height="100em" />
                    </a>
                <?php endif; ?>
            </div>


        </div>
    </div>
</header>
<?php
if (isset($_GET['alert']) and $_GET['alert'] == 'contact') {
    echo '<h4>Votre message vient d\'être ajouté !</h4>';
}
// if (isset($_GET['alert']) and $_GET['alert'] == 'emptySearch') {
//     echo '<h4>Erreur ! Champ vide.</h4>';
// }        
?>