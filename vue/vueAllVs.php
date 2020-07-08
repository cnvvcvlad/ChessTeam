<?php ob_start(); ?>

<?php $title = 'Similitudes et différences'; ?>
<?php $description = 'Cette page affiche tous les sujets analysés'; ?>

<table border="1" width="100%">  
<tr>
        <td colspan="2" align="center">
            <!--L'en-tête-->
            <?php require('tempVs/header.php');?>
        </td>
    </tr>      
    <tr>
        <td width="20%">
            <!--Le menu-->
            <?php require('tempVs/menu.php');?>
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
<div>
    <?php if (isset($_SERVER['HTTP_REFERER'])) : ?>
        <div class="d-flex justify-content-center"><a class="btn-primary" href="/ChessTeam/<?= basename($_SERVER['HTTP_REFERER']); ?>">Retour</a>
    <?php endif; ?>
</div>

<?php $mentions = ob_get_clean(); ?>

<?php require 'templates/tempBootstrap.php';?>
