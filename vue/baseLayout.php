<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : 'Chess Team' ?></title>
    <meta name="description" content="<?= isset($description)
        ? $description
        : 'Chess Team Nogent sur Marne' ?>" />
    <!-- Cookies doivent être chargées avant les pages-->
    <!-- <script src="assets/tarteaucitron/tarteaucitron.js"></script> -->
    <script src="<?= SCRIPTS .
        'tarteaucitron' .
        DIRECTORY_SEPARATOR .
        'tarteaucitron.js' ?>"></script>

    <!-- <script src="assets/js/cookies.js"></script> -->
    <script src="<?= SCRIPTS .
        'js' .
        DIRECTORY_SEPARATOR .
        'cookies.js' ?>"></script>

    <!-- CDN's -->
    <link 
    rel="stylesheet" 
    href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" 
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" 
    crossorigin="" />
    <!-- ===css perso== -->
    <!-- <link rel="stylesheet" href="assets/css/style.css" type="text/css"> -->
    <link rel="stylesheet" href="<?= SCRIPTS .
        'css' .
        DIRECTORY_SEPARATOR .
        'style.css' ?>">

    <!-- <link rel="stylesheet" href="assets/css/caroussel.css" type="text/css"> -->
    <link rel="stylesheet" href="<?= SCRIPTS .
        'css' .
        DIRECTORY_SEPARATOR .
        'caroussel.css' ?>">

    <!-- <link rel="stylesheet" href="assets/css/burger.css" type="text/css"> -->
    <link rel="stylesheet" href="<?= SCRIPTS .
        'css' .
        DIRECTORY_SEPARATOR .
        'burger.css' ?>">

    <!-- <link rel="stylesheet" href="assets/css/normalize.css" type="text/css"> -->
    <link rel="stylesheet" href="<?= SCRIPTS .
        'css' .
        DIRECTORY_SEPARATOR .
        'normalize.css' ?>">

    <!-- <link rel="stylesheet" href="assets/css/icomoon.css" type="text/css"> -->
    <link rel="stylesheet" href="<?= SCRIPTS .
        'css' .
        DIRECTORY_SEPARATOR .
        'icomoon.css' ?>">
    
    <!-- <link rel="stylesheet" href="assets/css/street_map.css" type="text/css"> -->
    <link rel="stylesheet" href="<?= SCRIPTS .
        'css' .
        DIRECTORY_SEPARATOR .
        'street_map.css' ?>">

</head>
<body>
<?php // var_dump($GLOBALS['allCategories']); exit; ?>

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
                <a href="<?= dirname(SCRIPTS) ?>">
                    <!-- <img src="assets/img/logo/logo.png" alt="Le logo du Chess Team Nogent sur Marne" title="Logo" /> -->
                    <img src="<?= SCRIPTS .
                        'img' .
                        DIRECTORY_SEPARATOR . 'logo'. DIRECTORY_SEPARATOR .
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
                                <div class="list_style"><a href="<?= dirname(SCRIPTS) ?>">Accueil</a></div>
                            </li>
                            <li class="has-children">
                                <div class="list_style"><a href="<?= dirname(SCRIPTS) ?>/categories">Catégories</a>
                                </div>
                                <ul class="sous-menu">
                                    <?php foreach (
                                        $GLOBALS['allCategories']
                                        as $cat => $values
                                    ): ?>
                                        <li>
                                            <div class="list_style">
                                                <a href="<?= dirname(SCRIPTS) ?>/categories/<?= $values->getId() ?>">
                                                    <?= $values->getTitle() ?>
                                                </a>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </li>
                            <li>
                                <div class="list_style"><a href="<?= dirname(SCRIPTS) ?>/posts">Articles</a></div>
                            </li>
                            <li>
                                <div class="list_style"><a href="<?= dirname(SCRIPTS) ?>/coachs">ChessCoach</a></div>
                            </li>

                            <?php if (
                                isset($_SESSION['id_user'])): ?>
                                <li>
                                    <div class="list_style"><a href="">Mon Compte</a>
                                    </div>
                                </li>
                                <li>
                                    <div class="list_style"><a href="">Mes
                                            articles</a>
                                    </div>
                                </li>
                                <li>
                                    <div class="list_style"><a href="<?= dirname(SCRIPTS) ?>/admin/posts/create">Créer article</a></div>
                                </li>


                                <?php if (
                                    isset($_SESSION['statut']) &&
                                    $_SESSION['statut'] === 1
                                ): ?>

                                    <li>
                                        <div class="list_style"><a href="<?= dirname(SCRIPTS) ?>/admin/members">Membres</a></div>
                                    </li>
                                    <li>
                                        <div class="list_style"><a href="<?= dirname(SCRIPTS) ?>/admin/comments">Commentaires</a></div>
                                    </li>
                                    <li>
                                        <div class="list_style"><a href="">VS</a></div>
                                    </li>


                                <?php endif; ?>
                                <li>
                                    <div class="list_style"><a href="<?= dirname(SCRIPTS) ?>/logout">Déconnexion</a></div>
                                </li>

                            <?php else: ?>
                                <li>
                                    <div class="list_style"><a href="<?= dirname(SCRIPTS) ?>/login">Connection</a></div>
                                </li>
                                <li>
                                    <div class="list_style"><a href="<?= dirname(SCRIPTS) ?>/register">Inscription</a></div>
                                </li>
                            <?php endif; ?>


                        </ul>
                    </div>
                </nav>
                <div class="search">
                    <!-- <div class="memberInfo"><span><?= isset($user)
                        ? $user->helloUser()
                        : '' ?></span></div> -->
                    <div class="search">
                        <form action="<?= dirname(SCRIPTS) ?>/search" method="post">
                            <input type="text" name="search" placeholder="Rechercher un article" required />
                            <input type="submit" value="Rechercher" />
                        </form>
                    </div>
                </div>
                <?php  ?>
            </div>
            <div class="menu-bg" id="menu-bg"></div>
            <div class="photo">
                <?php if (empty($_SESSION['user_image'])): ?>
                    <a href="<?= SCRIPTS .
                        'img' .
                        DIRECTORY_SEPARATOR . 'logo'. DIRECTORY_SEPARATOR .
                        'pawn_logo.jpg' ?>">
                        <img src="<?= SCRIPTS .
                        'img' .
                        DIRECTORY_SEPARATOR . 'logo'. DIRECTORY_SEPARATOR .
                        'pawn_logo.jpg' ?>" alt="Photo de profil" title="Cliquez pour agrandir" />
                    </a>
                <?php else: ?>
                    <a href="<?= SCRIPTS .
                        'img' .
                        DIRECTORY_SEPARATOR . 'uploads'. DIRECTORY_SEPARATOR . $_SESSION['user_image'] ?>">
                        <img src="<?= SCRIPTS .
                        'img' .
                        DIRECTORY_SEPARATOR . 'uploads'. DIRECTORY_SEPARATOR . $_SESSION['user_image'] ?>" alt="Photo de profil" title="Cliquez pour agrandir" height="100em" />
                    </a>
                <?php endif; ?>
            </div>


        </div>
    </div>
</header>
<?php if (isset($_GET['alert']) and $_GET['alert'] == 'contact') {
    echo '<h4>Votre message vient d\'être ajouté !</h4>';
} ?>

<div id="main_wrapper">
        <main class="container">
            <?= $content ?>
        </main>
        
        <?php include_once 'shared/_footer.php'; ?>
    </div>

    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin="">
    </script>

    <!-- ==javaScript perso== -->
    <!-- <script src="assets/js/caroussel.js"></script> -->
    <script src="<?= SCRIPTS .
        'js' .
        DIRECTORY_SEPARATOR .
        'caroussel.js' ?>"></script>

    <!-- <script src="assets/js/burger.js"></script> -->
    <script src="<?= SCRIPTS .
        'js' .
        DIRECTORY_SEPARATOR .
        'burger.js' ?>"></script>

    <!-- <script src="assets/js/timer.js"></script> -->
    <script src="<?= SCRIPTS .
        'js' .
        DIRECTORY_SEPARATOR .
        'timer.js' ?>"></script>

    <!-- <script src="assets/js/street_map.js"></script> -->
    <script src="<?= SCRIPTS .
        'js' .
        DIRECTORY_SEPARATOR .
        'street_map.js' ?>"></script>

    <!-- <script src="assets/js/script.js"></script> -->
    <script src="<?= SCRIPTS .
        'js' .
        DIRECTORY_SEPARATOR .
        'script.js' ?>"></script>


    <!--reCAPTCHA-->
    <script src="https://www.google.com/recaptcha/api.js?render=6LcgZ-oUAAAAAKdW6gHFYFBm7Qx-d52XntvALZma"></script>


    
</body>
</html>