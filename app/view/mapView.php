<?php
// --- 1. CONFIGURATION & CONNEXION BASE DE DONNÉES ---
// Remplace ces infos par les tiennes (root, pas de mot de passe souvent sur WAMP/XAMPP)
$host = 'localhost';
$dbname = 'ecogestum'; // <--- METS LE NOM DE TA BDD ICI
$user = 'root';
$pass = '';

try {
    $bdd = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    // Si pas de BDD, on affiche l'erreur mais on continue pour afficher la page quand même
    $erreur_bdd = "Erreur de connexion : " . $e->getMessage();
}

// --- 2. SYSTÈME DE TRADUCTION (ADRESSE -> GPS) ---
// La carte ne comprend pas "Bâtiment E", elle veut "48.016, 0.166".
// Cette liste sert à convertir tes lieux BDD en points sur la carte.
function getCoordonnees($lieu) {
    // Tu peux ajouter autant de lieux que tu veux ici
    $lieux = [
            'IUT' => [48.0163, 0.1665],
            'IUT Informatique' => [48.0163, 0.1665],
            'Bâtiment E' => [48.0180, 0.1630],
            'Bibliothèque' => [48.0175, 0.1610],
            'BU' => [48.0175, 0.1610],
            'Gymnase' => [48.0155, 0.1645],
            'Restaurant U' => [48.0140, 0.1600],
        // Ajoute d'autres variantes si besoin
    ];

    // On cherche si le lieu de la BDD existe dans notre liste (insensible à la casse)
    foreach ($lieux as $nom => $coords) {
        if (stripos($lieu, $nom) !== false) {
            return $coords;
        }
    }
    return null; // Pas de coordonnées trouvées
}

// --- 3. RÉCUPÉRATION DES OBJETS ---
$objets_a_afficher = [];

if (isset($bdd)) {
    // On sélectionne les objets disponibles qui ont une localisation
    if (isset($_GET['id'])) {
        $sql = "SELECT * FROM objets_disponibles WHERE id_objet = ?";
        $req = $bdd->prepare($sql);
        $req->execute([$_GET['id']]);
    }
    else
    {
        $req = $bdd->query("SELECT * FROM objets_disponibles");
    }
    $objets_a_afficher = $req->fetchAll(PDO::FETCH_ASSOC);
} else {
    // DONNÉES DE TEST (Si la BDD n'est pas connectée, pour que tu voies le résultat)
    $objets_a_afficher = [
            ['id_objet'=>1, 'nom_objet'=>'Chaise Test', 'adresse_point_collecte'=>'Bâtiment E', 'description'=>'Test sans BDD', 'photo'=>'assets/images/logo.svg'],
            ['id_objet'=>2, 'nom_objet'=>'PC Test', 'adresse_point_collecte'=>'IUT', 'description'=>'Test sans BDD', 'photo'=>'assets/images/logo.svg']
    ];
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carte des Objets - EcoGestUM</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style-catalogue.css">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>

    <style>
        /* --- STYLE GLASSMORPHISM --- */
        .map-wrapper {
            width: 90%;
            max-width: 1400px;
            margin: 40px auto;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 600px;
        }

        .map-frame {
            background: rgba(255, 255, 255, 0.45);
            backdrop-filter: blur(15px); /* Le flou */
            -webkit-backdrop-filter: blur(15px);
            padding: 20px;
            border-radius: 30px;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.25);
            border: 1px solid rgba(255, 255, 255, 0.4);
            width: 100%;
            height: 600px; /* Hauteur fixée pour éviter le bug d'affichage */
            position: relative;
        }

        #map {
            width: 100%;
            height: 100%;
            border-radius: 20px;
            z-index: 1;
            background-color: #ddd; /* Gris en attendant le chargement */
        }

        /* Popup personnalisé */
        .popup-content {
            text-align: center;
            font-family: 'Poppins', sans-serif;
            width: 180px;
        }
        .popup-content img {
            width: 100%;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 8px;
            background-color: #f0f0f0;
        }
        .popup-content h3 {
            margin: 0;
            color: #2B3A6C;
            font-size: 15px;
            font-weight: 700;
        }
        .popup-content p {
            font-size: 12px;
            margin: 5px 0 10px 0;
            color: #555;
        }
        .btn-detail {
            display: inline-block;
            background: #DB4C3B;
            color: white;
            text-decoration: none;
            padding: 5px 15px;
            border-radius: 15px;
            font-size: 11px;
            font-weight: 600;
        }
    </style>
</head>
<body>

<?php include 'assets/html/header.html'; ?>

<div class="main">
    <div style="text-align: center; margin-top: 30px;">
        <h1 style="color: #2B3A6C; font-family: 'Poppins';">Localisation des objets</h1>
        <?php if(isset($erreur_bdd)): ?>
            <p style="color: red; background: white; display:inline-block; padding:5px 10px; border-radius:10px;">
                ⚠️ Mode démo : <?php echo $erreur_bdd; ?>
            </p>
        <?php endif; ?>
    </div>

    <div class="map-wrapper">
        <div class="map-frame">
            <div id="map"></div>
        </div>
    </div>
</div>

<?php include 'assets/html/footer.html'; ?>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<script>
    console.log("test");

    document.addEventListener('DOMContentLoaded', function() {

        // 1. Initialiser la carte (Centrée sur Le Laval)
        var map = L.map('map').setView([48.08593223153121, -0.7586975230079035], 18);

        // 2. Ajouter le fond de carte "Voyager" (très propre)
        L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
            maxZoom: 20
        }).addTo(map);

        // 3. INJECTION PHP -> JS
        // On boucle sur les objets trouvés par PHP pour créer les marqueurs
        <?php foreach ($objets_a_afficher as $objet): ?>
        <?php
        // On traduit l'adresse textuelle en GPS
        $coords = [$objet['latitude'], $objet['longitude']];

        // Si on a trouvé des coordonnées pour cet objet
        if ($coords):
        // On prépare l'image (ou image par défaut si vide)
        $img = !empty($objet['photo']) ? $objet['photo'] : 'assets/images/logo.svg';
        ?>

        var marker = L.marker([<?php echo $coords[0]; ?>, <?php echo $coords[1]; ?>]).addTo(map);

        // Contenu HTML du popup
        var content = `
                        <div class="popup-content">
                            <img src="<?php echo htmlspecialchars($img); ?>" alt="Objet">
                            <h3><?php echo addslashes($objet['nom_objet']); ?></h3>
                            <p>📍 <?php echo addslashes($objet['adresse_point_collecte']); ?></p>
                            <a href="detaille-objet.php?id=<?php echo $objet['id_objet']; ?>" class="btn-detail">Voir l'objet</a>
                        </div>
                    `;

        marker.bindPopup(content);

        <?php endif; ?>
        <?php endforeach; ?>

        // Petit fix pour être sûr que la carte s'affiche bien
        setTimeout(function(){ map.invalidateSize(); }, 500);
    });
</script>

</body>
</html>