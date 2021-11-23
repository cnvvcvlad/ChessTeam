<?php ob_start(); ?>

<?php $title = 'Questions et réponses'; ?>
<?php $description = 'Questions et réponses'?>

<div class="container">
    <h1>Questions et réponses</h1>
    <h3>Quia expedita hic natus optio vel ut. In sunt sit fugiat aut. Ut vero quos quis perspiciatis reiciendis qui. Omnis quas ipsa ut tenetur tempore maiores possimus.Quia expedita hic natus optio vel ut. In sunt sit fugiat aut?</h3>
    <h4>Quia expedita hic natus optio vel ut. In sunt sit fugiat aut. Ut vero quos quis perspiciatis reiciendis qui. Omnis quas ipsa ut tenetur tempore maiores possimus.Quia expedita hic natus optio vel ut. In sunt sit fugiat aut.</h4>
    <div class="back-page">
        <a class="" href="/ProjectTesting/ChessTeam/<?= substr(basename($_SERVER['HTTP_REFERER']), 0) ?>">Retour</a>
    </div>
</div>
<?php $template = ob_get_clean(); ?>
<?php require 'templates/tempAccueil.php'; ?>
