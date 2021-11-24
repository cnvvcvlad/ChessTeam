<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title><?= $title ?></title>
    <meta name="description" content="<?= $description ?>" />
    <!-- Cookies doivent être chargées avant les pages-->
    <script src="assets/tarteaucitron/tarteaucitron.js" type="text/javascript"></script>
    <script src="assets/js/cookies.js" type="text/javascript"></script>
    <!-- CDN's -->
    <link 
    rel="stylesheet" 
    href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" 
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" 
    crossorigin="" />
    <!-- ===css perso== -->
    <link rel="stylesheet" href="assets/css/style.css" type="text/css">
    <link rel="stylesheet" href="assets/css/caroussel.css" type="text/css">
    <link rel="stylesheet" href="assets/css/burger.css" type="text/css">
    <link rel="stylesheet" href="assets/css/normalize.css" type="text/css">
    <link rel="stylesheet" href="assets/css/icomoon.css" type="text/css">
    <link rel="stylesheet" href="assets/css/street_map.css" type="text/css">

</head>

<body>
    <div id="main_wrapper">
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
                                            <?php foreach (
                                                $allCategory
                                                as $cat => $values
                                            ): ?>
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

                                    <?php if (isConnected()): ?>
                                        <li>
                                            <div class="list_style"><a href="?action=myAccount&amp;id=<?= $_SESSION[
                                                'id_user'
                                            ] ?>">Mon Compte</a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="list_style"><a href="?action=myArticlesId&amp;id=<?= $_SESSION[
                                                'id_user'
                                            ] ?>">Mes
                                                    articles</a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="list_style"><a href="?action=createArticleId">Créer article</a></div>
                                        </li>


                                        <?php if (isAdmin()): ?>

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

                                    <?php else: ?>                                        
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
                        <div class="memberInfo"><span><?= helloUser() ?></span></div>

                    </div>
                    <div class="menu-bg" id="menu-bg"></div>
                    <div class="photo">
                        <?php if (empty($_SESSION['user_image'])): ?>
                            <a href="assets/img/logo/pawn_logo.jpg">
                                <img src="assets/img/logo/pawn_logo.jpg" alt="Photo de profil" title="Cliquez pour agrandir" />
                            </a>
                        <?php else: ?>
                            <a href="assets/img/uploads/<?= $_SESSION[
                                'user_image'
                            ] ?>">
                            <img 
                            src="assets/img/uploads/<?= $_SESSION[
                                'user_image'
                            ] ?>" 
                            alt="Photo de profil" 
                            title="Cliquez pour agrandir" 
                            height="100em" />
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
        ?>


        <main class="container">

            <?= $template ?>

        </main>
        <footer>
            <div class="pied-page">
                <div class="middle">
                    <ul class="menu">
                        <li class="item" id="profile">
                            <a class="btn" href="#profile">Notre adresse</a>

                            <div class="smenu">
                                <h5>15 rue Général Faidherbe</h5>
                                <h5>94130 Nogent sur Marne</h5>
                                <h5>0783554818</h5>
                                <h5>cnvvc_vlad@yahoo.fr</h5>
                            </div>
                        </li>

                        <li class="item" id="message">
                            <a class="btn" href="#message">Réseaux Sociaux</a>

                            <div class="smenu">
                                <a href="https://www.facebook.com/">Facebook<span class="icon-facebook"></span></a>
                                <a href="https://www.twitter.com/">Twitter<span class="icon-twitter"></span></a>
                                <a href="https://www.whatsapp.com/">Whatsapp<span class="icon-whatsapp"></span></a>
                                <a 
                                href="?action=rss" 
                                rel="noreferrer noopener" 
                                target="_blank">
                                    Flux RSS<img src="assets/img/logo/rss.png" alt="Le Flux RSS" title="Flux RSS" />
                                </a>
                            </div>
                        </li>

                        <li class="item" id="settings">
                            <a class="btn" href="#settings">FAQ / CGU / CONTACT</a>

                            <div class="smenu">
                                <a href="?action=questions">Questions fréquentes</a>
                                <a href="?action=conditions">Condition d'utilisation</a>
                                <a href="?action=mentions">Mentions légales</a>
                                <a href="?action=contact">Contactez-nous</a>

                            </div>
                        </li>
                        <?php if (isConnected()): ?>
                            <li class="item"><a href="?action=deconnect" class="btn">Déconnexion</a>
                                <div class="separate"></div><a class="btn" href="">#top</a>
                            </li>
                        <?php else: ?>
                            <li class="item"><a target="_blank" class="btn" href="https://www.chess.com/" rel="noreferrer noopener">Chess.com</a>
                                <div class="separate"></div><a class="btn" href=""><i class="fas fa-arrow-up"></i>#top</a>
                            </li>
                        <?php endif; ?>

                    </ul>
                </div>
            </div>
            <div>
                <div class="copyright">
                    <p>&copy; Copyright 2019 - <?php echo date('Y'); ?> </p>
                    <span class="compteur">
                        <?php
                        require_once dirname(__DIR__) .
                            DIRECTORY_SEPARATOR .
                            'compteur' .
                            DIRECTORY_SEPARATOR .
                            'compteur.php';
                        add_vue();
                        $vues = nb_vues();
                        ?>
                        IL y a <?= $vues ?> visite<?php if (
     $vues > 1
 ): ?>s<?php endif; ?> sur le site
                    </span>
                </div>
            </div>

        </footer>


    </div>

    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script 
    src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" 
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" 
    crossorigin="">
    </script>

    <!-- ==javaScript perso== -->
    <script src="assets/js/caroussel.js" type="text/javascript"></script>
    <script src="assets/js/burger.js" type="text/javascript"></script>
    <script src="assets/js/timer.js" type="text/javascript"></script>
    <script src="assets/js/street_map.js" type="text/javascript"></script>

</body>


</html>