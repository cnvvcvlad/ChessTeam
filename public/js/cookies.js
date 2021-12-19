tarteaucitron.init({
    "privacyUrl": "", /* URL de la page de la politique de vie privée, TODO :  rediger la page 
    Mentions Légales qui indique ce qu'on fait avec les données colectées, combien de temps on les conserves, lister 
    la totalité de cookies qui potentiellment vont être écrit dans le site si l'user les accèpte*/

    "hashtag": "#tarteaucitron", /* Ouvrir le panneau contenant ce hashtag */
    "cookieName": "tarteaucitron", /* Nom du Cookie */

    "orientation": "middle", /* Position de la bannière (top - bottom) */
    "showAlertSmall": false, /* Voir la bannière réduite en bas à droite */
    "cookieslist": true, /* Voir la liste des cookies */

    "adblocker": false, /* Voir une alerte si un bloqueur de publicités est détecté */
    "AcceptAllCta": true, /* Voir le bouton accepter tout (quand highPrivacy est à true), on accepte tous les 
    cookies d'un coup */
    "highPrivacy": true, /* Désactiver le consentement automatique !!! Obligatoire pour les citoyens européens, RGPD 
    interdit le consentement automatique en Europe */
    "handleBrowserDNTRequest": false, /* Si la protection du suivi du navigateur est activée, tout interdire,
    si on le met à true cela évite le doublon de demande d'autorisation de cookies */

    "removeCredit": false, /* Retirer le lien vers tarteaucitron.js */
    "moreInfoLink": true, /* Afficher le lien "voir plus d'infos" */
    "useExternalCss": false, /* Si false, tarteaucitron.css sera chargé, si on le met à true on peut activer 
    nos fichiers de css pour les cookies */

    //"cookieDomain": ".my-multisite-domaine.fr", 
    /* Cookie multisite, permet d'utiliser le même cookies sur les diférents sous-domaines */

    "readmoreLink": "/cookiespolicy" /* Lien vers la page "Lire plus" , TODO : il faut cofigurer le chemin vers
    cette page d'information */
});

// Google Analytics
tarteaucitron.user.gtagUa = 'UA-97102682-4';
// tarteaucitron.user.gtagCrossdomain = ['example.com', 'example2.com'];
tarteaucitron.user.gtagMore = function () { /* add here your optionnal gtag() */ };
(tarteaucitron.job = tarteaucitron.job || []).push('gtag');
// (tarteaucitron.job = tarteaucitron.job || []).push('facebook');