<?php ob_start(); ?>
<?php $title = 'Mentions légales du site ChessTeam'; ?>
<?php $description = 'Les mentions légales sont un ensemble de règles juridiques que l\'on indique à ses lecteurs, selon la loi française.'; ?>
<div class="container">
    <h1 class="text-center">Mentions légales</h1>
    <ol>
        <li><h2>Collecte des informations</h2>

        <p>Nous recueillons des informations lorsque vous vous inscrivez sur notre site, lorsque vous vous connectez à
            votre compte, créez, comentez des articles, et / ou lorsque vous vous déconnectez. Les informations
            recueillies incluent votre login, votre adresse e-mail et l'image téléchargée. <br>

            En outre, nous recevons et enregistrons automatiquement des informations à partir de votre ordinateur et
            navigateur, y compris votre adresse IP, vos logiciels et votre matériel, et la page que vous demandez.</p></li>

       <li><h2>Utilisation de l’information</h2>

        <p>Toutes les informations que nous recueillons auprès de vous peuvent être utilisées pour : <br>

            - Personnaliser votre expérience et répondre à vos besoins individuels<br>
            - Améliorer notre site<br>
            - Vous contacter par e-mail<br>
            - Faire sondages<br>
            - Administrer le group, gérer mieux les sujets des articles</p></li>

        <li><h2>Divulgation des informations à des tiers</h2>
        <p>Nous ne vendons, n’échangeons et ne transférons pas vos informations personnelles identifiables à des tiers.
        Cela ne comprend pas les tierce parties de confiance qui nous aident à exploiter notre site Web ou à mener nos
        affaires, tant que ces parties conviennent de garder ces informations confidentielles.<br>

        Nous pensons qu’il est nécessaire de partager des informations afin d’enquêter, de prévenir ou de prendre des
        mesures concernant des activités illégales, fraudes présumées, situations impliquant des menaces potentielles à
        la sécurité physique de toute personne, violations de nos conditions d’utilisation, ou quand la loi nous y
        contraint.<br>

        Les informations non-privées, cependant, peuvent être fournies à d’autres parties pour le marketing, la
        publicité, ou d’autres utilisations.</p></li>
        <li><h2>Sécurité et suivi de l’information</h2>

        <p>Nous mettons en œuvre une variété de mesures de sécurité pour préserver la sécurité de vos informations
            personnelles. Nous utilisons un cryptage à la pointe de la technologie pour protéger les informations
            sensibles transmises en ligne. Nous protégeons également vos informations hors ligne. Seuls les employés qui
            ont besoin d’effectuer un travail spécifique ont accès aux informations personnelles identifiables. Les
            ordinateurs et serveurs utilisés pour stocker des informations personnelles identifiables sont conservés
            dans un environnement sécurisé.</p></li>

        <li><h2>Méthodes de désinscription</h2>

        <p>Si à n’importe quel moment vous souhaitez supprimer votre compte vous pouvez le faire à n'importe quel moment
            en consultant la page membre du notre site.</p></li>

        <li><h2>Consentement</h2>

        <p>En utilisant notre site, vous consentez à notre politique de confidentialité.</p></li>
    </ol>
    <div class="d-flex justify-content-end">
        <a class="btn mb-5 btn-primary" href="/ProjectTesting/ChessTeam/<?= substr(basename($_SERVER['HTTP_REFERER']), 0) ?>">Retour</a>
    </div>
</div>


<?php $mentions = ob_get_clean(); ?>
<?php require 'templates/tempBootstrap.php'; ?>
