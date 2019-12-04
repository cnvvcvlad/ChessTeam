<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Erreur lors du chargement ChessTeam</title>
    <meta name="description" content=" "/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../assets/css/style.css" type="text/css">
    <link rel="stylesheet" href="assets/css/normalize.css" type="text/css">

</head>

<body>
<div class="en-tete">
    <main class="container">

        <h1>Erreur !!!</h1>

        <?php echo $ex; ?>
    </main>
</div>
<footer>
    <div class="pied-page">
        <div class="condition">
            <div class="copyright">
                <p>Copyright</p>
            </div>
            <div class="top-button">
                <a href="<?= $_SERVER['HTTP_REFERER']?>">Retour</a>
            </div>
        </div>
    </div>
</footer>


</body>
</html>