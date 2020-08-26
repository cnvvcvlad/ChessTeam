<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title><?= $title; ?></title>
    <meta name="description" content="<?= $description; ?>"/>
    <!-- ==css perso== -->
    <link rel="stylesheet" href="assets/css/style.css" type="text/css">
    <link rel="stylesheet" href="assets/css/caroussel.css" type="text/css">
    <link rel="stylesheet" href="assets/css/burger.css" type="text/css">
    <link rel="stylesheet" href="assets/css/normalize.css" type="text/css">
    <link rel="stylesheet" href="assets/css/icomoon.css" type="text/css">
</head>

<body>
<div id="main_wrapper">
    <header>
        <div class="en-tete">

            <div class="logo">
                <a href="?action=home"><img src="assets/img/logo/logo.png" alt="Le logo du Chess Team Nogent sur Marne"
                                            title="Logo"/></a>
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
                                <div class="list_style"><a
                                        href="?action=allCategory">Catégories</a>
                                </div>

                                <ul class="sous-menu">
                                    <?php foreach ($allCategory as $cat => $values) : ?>
                                        <li>
                                            <div class="list_style">
                                                <a href="?action=categoryId&amp;id=<?= $values->getId() ?>"><?= $values->getTitle(); ?></a>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </li>
                            <li>
                                <div class="list_style"><a href="?action=allArticles">Articles</a></div>
                            </li>


                            <?php if (isConnected()) : ?>
                                <li>
                                    <div class="list_style"><a
                                            href="?action=myAccount&amp;id=<?= $_SESSION['id_user'] ?>">Mon Compte</a>
                                    </div>
                                </li>
                                <li>
                                    <div class="list_style"><a
                                            href="?action=myArticlesId&amp;id=<?= $_SESSION['id_user'] ?>">Mes
                                            articles</a>
                                    </div>
                                </li>
                                <li>
                                    <div class="list_style"><a href="?action=createArticleId">Créer article</a></div>
                                </li>


                                <?php if (isAdmin()) : ?>

                                    <li>
                                        <div class="list_style"><a href="?action=allComments">Commentaires</a></div>
                                    </li>
                                    <li>
                                        <div class="list_style"><a href="?action=allMembers">Membres</a></div>
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
                <div class="memberInfo"><span><?= helloUser(); ?></span></div>

            </div>
            <div class="menu-bg" id="menu-bg"></div>
            <div class="photo">
                <?php if (empty($_SESSION['user_image'])) : ?>
                    <a href="assets/img/logo/pawn_logo.jpg"><img src="assets/img/logo/pawn_logo.jpg"
                                                                 alt="Photo de profil"
                                                                 title="Cliquez pour agrandir"/></a>
                <?php else : ?>
                    <a href="assets/img/uploads/<?= $_SESSION['user_image'] ?>"><img
                            src="assets/img/uploads/<?= $_SESSION['user_image'] ?>" alt="Photo de profil"
                            title="Cliquez pour agrandir" height="100em"/></a>
                <?php endif; ?>
            </div>

        </div>
    </header>

    <div class="form_view">
        <?php if (!isAdmin()) : ?>
            <aside class="form_view">
                <div class="top_article_form">
                    <?php if (!empty($lastArticle_one)) : ?>
                        <?php foreach ($lastArticle_one as $key => $value) : ?>
                            <h2><img src="assets/img/by_default/ico_epingle.png" alt="Catégorie"
                                     class="ico_categorie"/><?= $value->getArt_title() ?></h2>
                            <?php if (isAdmin()) : ?>
                                <div class="bouton_commande"><a href="">Modifier</a></div>
                            <?php endif; ?>
                            <div class="bouton_commande">
                                <a href="?action=allArticles&amp;id=<?= $value->getId() ?>" class="bouton_rouge">Voir
                                    l'article <img src="assets/img/by_default/flecheblanchedroite.png"
                                                   alt="le bouton rouge"/></a>
                            </div>
                            <p>Ecrit par
                                <span class="mark"><?= showNameAuthor($value->getArt_author()) ?></span>
                                le <em><?= $value->getArt_date_creation() ?></em> dans la catégorie
                                <strong><?= showNameCategory($value->getCategory_id()) ?></strong></p>
                            <div id="detail_art" class="justify_form">
                                <p>
                                    <img src="assets/img/uploads/<?= $value->getArt_image() ?>"
                                         alt="Image de l'article">


                                    <span><a href="#cache"> [Lire la suite...] </a></span>

                                <div id="cache"><span><?= $value->getArt_description() ?><br><a href="#detail_art">
                                            [Voir
                                            moins]</a></span>
                                </div>
                                </p>

                                <p><a href="?action=allArticles&amp;id=<?= $value->getId() ?>">Commentaires
                                        (<?= numberCommentsOfArticle(getAllCommentsOfArticle($value->getId())); ?>)</a>
                                </p>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

            </aside>
            <main class="container_form">

                <?= $template_form; ?>


            </main>

            <aside class="form_view">
                <div class="program_view">
                    <div class="section_view">
                        <h3 class="myColor">Qui sommes-nous ?</h3>
                        <section class="section_form">

                            <p><span>Error placeat molestias debitis pariatur molestiae atque dolores. Debitis, sint eaque. Cumque ipsa, ad blanditiis porro quas adipisci voluptatum? Quisquam expedita in minus id nulla, adipisci facere praesentium. Amet, deleniti?</span>
                            </p>
                        </section>
                        <h3 class="myColor">Nos actualités</h3>
                        <section class="section_form">

                            <p><span>Reprehenderit enim eaque sapiente excepturi maxime error recusandae illum? Amet sint sapiente omnis cupiditate iure quod optio, suscipit consectetur cumque deserunt illo molestias repellendus voluptatem error nesciunt assumenda provident! Molestias!</span>
                            </p>
                        </section>
                        <h3 class="myColor">Derniers articles</h3>
                        <section class="section_form">
                            <p><span>Autem iste hic est ipsa, aliquam at sit earum sapiente dignissimos beatae deleniti quis laudantium, quisquam, voluptate possimus aut repellendus doloremque reprehenderit error id asperiores! Aspernatur quibusdam mollitia commodi perferendis!</span>
                            </p>
                        </section>
                    </div>
                </div>
            </aside>

        <?php else : ?>
            <main class="container_form">

                <?= $template_form; ?>

            </main>
        <?php endif; ?>

    </div>


    <footer>
        <div class="pied-page">
            <div class="middle">
                <ul class="menu">
                    <li class="item" id="profile">
                        <a href="#profile" class="btn">Notre adresse</a>

                        <div class="smenu">
                            <h5>15 rue Général Faidherbe</h5>
                            <h5>94130 Nogent sur Marne</h5>
                            <h5>0783554818</h5>
                            <h5>cnvvc_vlad@yahoo.fr</h5>
                        </div>
                    </li>

                    <li class="item" id="message">
                        <a href="#message" class="btn">Réseaux Sociaux</a>

                        <div class="smenu">
                            <a href="">Facebook<span class="icon-facebook"></span></a>
                            <a href="">Twitter<span class="icon-twitter"></span></a>
                            <a href="">Whatsapp<span class="icon-whatsapp"></span></a>
                        </div>
                    </li>

                    <li class="item" id="settings">
                        <a href="#settings" class="btn">FAQ / CGU / CONTACT</a>

                        <div class="smenu">
                            <a href="vue/questions.php">Questions fréquentes</a>
                            <a href="vue/conditions.php">Condition d'utilisation</a>
                            <a href="vue/mentions.php">Mentions légales</a>
                            <a href="vue/contact.php">Contactez-nous</a>

                        </div>
                    </li>
                    <?php if (isConnected()) : ?>
                        <li class="item"><a href="?action=deconnect" class="btn">Déconnexion</a>

                            <div class="separate"></div>
                            <a
                                class="btn" href="">#top</a></li>
                    <?php else : ?>
                        <li class="item"><a href="https://www.chess.com/" target="_blank" class="btn">Chess.com</a>

                            <div class="separate"></div>
                            <a
                                class="btn" href="">#top</a></li>
                    <?php endif; ?>

                </ul>
            </div>
        </div>
        <div class="copyright">
            <p>&copy; Copyright 2019 - <?php echo date('Y');?> </p>
        </div>

    </footer>


</div>


<!-- ==javaScript perso== -->
<script src="assets/js/caroussel.js" type="text/javascript"></script>
<script src="assets/js/burger.js" type="text/javascript"></script>

</body>


</html>
