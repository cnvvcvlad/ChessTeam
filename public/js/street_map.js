// On initialise la latitude et la longitude de Paris (centre de la carte)
var lat = 48.852969
var lon = 2.349903
var macarte = null

// Nous initialisons une liste de marqueurs, villes autour de Paris
var villes = {
  Vincennes: { lat: 48.8474508, lon: 2.4396714 },
  Puteaux: { lat: 48.8841522, lon: 2.2368863 },
  Nanterre: { lat: 48.8924273, lon: 2.2071267 },
  Créteil: { lat: 48.7771486, lon: 2.4530731 },
}

// Fonction d'initialisation de la carte
function initMap() {
  if (document.getElementById('map')) {
    // Créer l'objet "macarte" et l'insèrer dans l'élément HTML qui a l'ID "map"
    macarte = L.map('map').setView([lat, lon], 11)

    // Leaflet ne récupère pas les cartes (tiles) sur un serveur par défaut. Nous devons lui préciser où nous souhaitons les récupérer. Ici, openstreetmap.fr
    L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
      // Il est toujours bien de laisser le lien vers la source des données
      attribution:
        'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',
      minZoom: 1,
      maxZoom: 20,
    }).addTo(macarte)

    // Nous ajoutons un marqueur
    // var marker = L.marker([lat, lon]).addTo(macarte)
    // Ajout une popup au marker
    // marker
    //   .bindPopup('<b>Hello world from Paris!</b><br>I am a popup.')
    //   .openPopup()
    // Nous ajoutons un marqueur cercle de Nogent sur Marne
    var circle = L.circle([48.837631, 2.481699], {
      color: 'red',
      fillColor: '#f03',
      fillOpacity: 0.5,
      radius: 500,
    }).addTo(macarte)
    // Nous ajoutons un marqueur polygon du bois de Vincennes
    var polygon = L.polygon([
      [48.84283, 2.46182],
      [48.83509, 2.46955],
      [48.81836, 2.46079],
      [48.81943, 2.43745],
      [48.83181, 2.39788],
      [48.84429, 2.42166],
      [48.84068, 2.43882],
      [48.84463, 2.4408],
    ]).addTo(macarte)

    let xmlhttp = new XMLHttpRequest()

    xmlhttp.onreadystatechange = () => {
      // La transaction est terminée ?
      if (xmlhttp.readyState == 4) {
        // Si la transaction est un succès
        if (xmlhttp.status == 200) {
          // On traite les données reçues
          let donnees = JSON.parse(xmlhttp.responseText)
          // console.log(donnees)

          // On boucle sur les données (ES8)
          Object.entries(donnees.coachs).forEach((coach) => {
            // Ici j'ai une seule agence
            // On crée un marqueur pour l'agence
            let marker = L.marker([coach[1].lat, coach[1].lon]).addTo(macarte)
            // marker.bindPopup(coach[1].first_name)
            marker.bindPopup(`<div class="popup"><img src="./assets/img/uploads/${coach[1].coach_image}" alt="" class="">
            <div class="coach-info">
                <h3>${coach[1].first_name} ${coach[1].last_name}</h3>
                <span>${coach[1].price}€/h</span3>
            </div><span><a href="?action=coach&amp;id_coach=${coach[1].id}">en savoir plus</a></span></div>`)
          })
        } else {
          console.log(xmlhttp.statusText)
        }
      }
    }
    // TODO : Modifier sur le serveur de l'api l'url correspondante
    xmlhttp.open(
      'GET',
      'http://localhost/ProjectTesting/ChessTeam/index.php?action=apiStreetMap',
    )

    xmlhttp.send(null)

    // Nous parcourons la liste des villes et nous ajoutons un marqueur pour chacune d'entre elles
    // for (ville in villes) {
    //   var marker = L.marker([villes[ville].lat, villes[ville].lon]).addTo(
    //     macarte,
    //   )
    // }
  }
}

window.addEventListener('DOMContentLoaded', () => {
  // Fonction d'initialisation qui s'exécute lorsque le DOM est chargé
  initMap()
})
