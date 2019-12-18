<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Erreur lors du chargement ChessTeam</title>
    <meta name="description" content="Cette page affiche les erreurs du site ChessTeam Nogent sur Marne"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../assets/css/style.css" type="text/css">
    <link rel="stylesheet" href="../assets/css/normalize.css" type="text/css">

</head>

<body>
<div class="en-tete">
    <main class="container-exception">

        <h1>Erreur !!!</h1>

        <?php if(isset($ex)) {
            echo $ex;
        }; ?>
    </main>
</div>
<footer>
    <div class="pied-page">
        <div class="exception">

            <div class="top-button-exception">

                <a href="../">Retour</a>

            </div>
            <div class="copyright-exception">
                <p>Copyright</p>
            </div>
        </div>
    </div>
</footer>


</body>
</html>