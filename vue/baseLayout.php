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
    <script src="<?= SCRIPTS .
        'tarteaucitron' .
        DIRECTORY_SEPARATOR .
        'tarteaucitron.js' ?>"></script>

    <script src="<?= SCRIPTS .
        'js' .
        DIRECTORY_SEPARATOR .
        'cookies.js' ?>"></script>

    <!-- CDN's -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
    <!-- ===css perso== -->
    <link rel="stylesheet" href="<?= SCRIPTS .
        'css' .
        DIRECTORY_SEPARATOR .
        'style.css' ?>">

    <link rel="stylesheet" href="<?= SCRIPTS .
        'css' .
        DIRECTORY_SEPARATOR .
        'caroussel.css' ?>">

    <link rel="stylesheet" href="<?= SCRIPTS .
        'css' .
        DIRECTORY_SEPARATOR .
        'burger.css' ?>">

    <link rel="stylesheet" href="<?= SCRIPTS .
        'css' .
        DIRECTORY_SEPARATOR .
        'normalize.css' ?>">

    <link rel="stylesheet" href="<?= SCRIPTS .
        'css' .
        DIRECTORY_SEPARATOR .
        'icomoon.css' ?>">

    <link rel="stylesheet" href="<?= SCRIPTS .
        'css' .
        DIRECTORY_SEPARATOR .
        'street_map.css' ?>">
    <link rel="stylesheet" href="<?= SCRIPTS .
        'prism' .
        DIRECTORY_SEPARATOR .
        'prism-light.css' ?>">

</head>

<body>    
    <header>
        <div class="header-body">
        <?php include_once 'shared/_countdown.php'; ?>  
        <?php include_once 'shared/_top.php'; ?>           
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
    <script src="<?= SCRIPTS .
        'ckeditor5' .
        DIRECTORY_SEPARATOR .
        'ckeditor.js' ?>"></script>
    <script src="<?= SCRIPTS .
        'prism' .
        DIRECTORY_SEPARATOR .
        'prism-light.js' ?>"></script>


    <!--reCAPTCHA-->
    <script src="https://www.google.com/recaptcha/api.js?render=6LcgZ-oUAAAAAKdW6gHFYFBm7Qx-d52XntvALZma"></script>



</body>

</html>