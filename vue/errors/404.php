<?php ob_start(); ?>
<?php $title = 'Erreur 404'; ?>
<?php $description = 'La page n\'a pas été trouvée'; ?>
<div class="en-tete">
    <main class="container-exception">
        <h1>Erreur : La page demandée est introuvable :(</h1>
        <?php if (isset($ex)) {
            echo $ex;
        } ?>
        <div class="exception">
            <a href="<?= dirname(SCRIPTS) ?>">Retour</a>
        </div>
    </main>
</div>
<?php $content = ob_get_clean(); ?>
<?php require VIEWS . 'baseLayout.php'; ?>