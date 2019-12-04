<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title><?= $title; ?></title>
        <!-- css perso -->
        <link rel="stylesheet" href="assets/css/font/">
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/normalize.css">
    </head>
    <body>
    <?php if (!empty($allCategory)): ?>
    <div id="main_wrapper">
    <header>
        <div class="en-tete">

            <div class="logo">
                <a  href="?action=home"><img src="assets/img/logo/logo.png" alt="Le logo du Chess Team Nogent sur Marne" title="Logo"/></a>
            </div>
            <nav class="navigation" role="navigation">
                <div id="menu-bar">
                    <div id="menu" onclick="onClickMenu()">
                        <div id="bar1" class="bar"></div>
                        <div id="bar2" class="bar"></div>
                        <div id="bar3" class="bar"></div>
                    </div>
                    <ul class="navigate" id="navigate">
                        <li><a href="?action=home">Page d'accueil</a></li>
                        <li class="has-children"><a href="?action=allArticles">Tous les articles</a>
                        
                        <li class="has-children"><a href="<?php if(isAdmin()) : ?>?action=allCategory<?php endif; ?>">Catégories</a>
                        
                            <ul class="sous-menu">
                            <?php foreach ($allCategory as $cat => $values) : ?>
                                <li><a href="?action=categoryId"><?= 'Catégorie ' . strtoupper($values->getTitle()); ?></a></li>
                            <?php endforeach; ?>
                                <!-- <li><a href="">Cat2</a></li>
                                <li><a href="">Cat3</a></li>
                                <li><a href="">Cat4</a></li> -->
                            </ul>
                        </li>
                        <?php if(isConnected()) : ?>
                            <li><a href="?action=myAccount">Mon Compte</a></li>
                            <li><a href="?action=myArticlesId">Mes articles</a></li>
                            <li><a href="?action=createArticleId">Créer un article</a></li>

                            <?php if(isAdmin()) : ?>
                                <li><a href="?action=allMembers">Membres</a></li>
                                <li><a href="?action=deconnect">Déconnexion</a></li>
                            <?php endif; ?>

                        <?php else : ?>
                            <li><a href="?action=connexion">Connectez-vous</a></li>
                            <li><a href="?action=inscription">Inscription</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </nav>
            <div class="menu-bg" id="menu-bg"></div>
            <div class="photo">
                <div class="memberInfo"><p>Salut <?= helloUser(); ?> !</p></div>
                <a href="assets/img/by_default/ma_photo.png"><img src="assets/img/by_default/ma_photo.png" alt="Photo de profil" title="Cliquez pour agrandir" height="100em"  /></a>
            </div>
        </div>
    </header>
        <main class="container">
            <?= $template; ?>
        </main>

        <footer>

        </footer>
        </div>
        <?php endif; ?>
    </body>


</html>