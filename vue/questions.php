<?php ob_start(); ?>

<?php $title = 'Questions et réponses'; ?>
<?php $description = 'Questions et réponses'?>

<div class="container">
    <h1>Questions et réponses</h1>
    <h3>Quia expedita hic natus optio vel ut. In sunt sit fugiat aut. Ut vero quos quis perspiciatis reiciendis qui. Omnis quas ipsa ut tenetur tempore maiores possimus.Quia expedita hic natus optio vel ut. In sunt sit fugiat aut?</h3>
    <h4>Quia expedita hic natus optio vel ut. In sunt sit fugiat aut. Ut vero quos quis perspiciatis reiciendis qui. Omnis quas ipsa ut tenetur tempore maiores possimus.Quia expedita hic natus optio vel ut. In sunt sit fugiat aut.</h4>
    <?php if(isset($_SERVER['HTTP_REFERER'])) : ?>
    <div class="d-flex justify-content-end" ><a class="btn btn-primary" href="/ChessTeam/<?= basename($_SERVER['HTTP_REFERER']); ?>">Retour à l'accueil</a></div>
    <?php endif; ?>

</div>
<?php $mentions = ob_get_clean(); ?>
<?php require 'templates/tempBootstrap.php'; ?>
