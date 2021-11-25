<?php ob_start(); ?>

<?php $title = 'Similitudes et différences'; ?>
<?php $description = 'Cette page affiche tous les sujets analysés'; ?>

<table border="1" width="100%">  
<tr>
        <td colspan="2" align="center">
            <!--L'en-tête-->
            <?php require 'tempVs/header.php'; ?>
        </td>
    </tr>      
    <tr>
        <td width="20%">
            <!--Le menu-->
            <?php require 'tempVs/menu.php'; ?>
        </td>
        <td width="80%">
            <div id="corps">
                <h5 align="center">Similitudes et différences</h5>
                <p>
                    <ul>
                        <li>description</li>
                        <li>description</li>
                        <li>description</li>
                        <li>description</li>
                        <li>description</li>
                        <li>description</li>
                        <li>description</li>
                        <li>description</li>

                    </ul>
                </p>
            </div>
        </td>
    </tr>
</table>
<div class="back-page">
    <a href="<?= substr(basename($_SERVER['HTTP_REFERER']), 0) ?>">Retour</a>
    <a href="?action=home">Retour à l'accueil</a>
</div>

<?php $template_form = ob_get_clean(); ?>

<?php require 'templates/tempForm.php'; ?>
