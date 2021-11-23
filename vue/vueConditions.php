<?php ob_start(); ?>
<?php $title = 'Condition d\'utilisation'; ?>
<?php $description = 'Condition d\'utilisation' ?>
<div class="container">
    <h1 class="text-center">Conditions générales d’utilisation</h1>

    <h3>Tout internaute souhaitant accéder au Blog doit avoir pris connaissance préalablement des Conditions Générales
        d’Utilisation, les Mentions légales et s’engage à les respecter sans réserve.</h3>
    <ol>
        <li><h4>PROPRIETE INTELLECTUELLE</h4>

            <p>La présentation et chacun des éléments présent sur ce Blog appartient au créateur. L’utilisateur ne doit
                en
                aucun cas copier ou reproduire ces informations.</p>
        </li>
        <li><h4>RESPONSABILITE</h4>

            <p>L'administrateur du blog est seul responsable des informations, textes, images, vidéos, données,
                fichiers, programmes contenus dans le site. Il peut modérer les éventuels articles et / ou commentaires qui ne respectent
                pas la Loi.</p></li>
        <li><h4>OBLIGATIONS DU VISITEUR</h4>

            <p>Vous êtes informé que vous êtes responsable du contenu que vous diffusez sur Internet notamment à travers
                vos articles et / ou commentaires.</p>
        </li>
        <li><h4>CAS DE NON RESPECT DES CONDITIONS D’UTILISATION</h4>

            <p>Des sanctions peuvent être prises à l’encontre de l’utilisateur en cas de non-respect des consignes et <a href="https://fr.wikipedia.org/wiki/R%C3%A8glement_g%C3%A9n%C3%A9ral_sur_la_protection_des_donn%C3%A9es" target="_blank"> les règles RGPD.</a></p>
        </li>

        <div class="back-page">
            <a class="" href="/ProjectTesting/ChessTeam/<?= substr(basename($_SERVER['HTTP_REFERER']), 0) ?>">Retour</a>
        </div>
        </div>
    </ol>
</div>


<?php $template = ob_get_clean(); ?>
<?php require 'templates/tempAccueil.php'; ?>
