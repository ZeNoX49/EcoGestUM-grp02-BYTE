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
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            padding: 20px;
            border-radius: 30px;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.25);
            border: 1px solid rgba(255, 255, 255, 0.4);
            width: 100%;
            height: 600px;
            position: relative;
        }

        .leaflet-container a {
            color: #FFFFFF;
        }

        #map {
            width: 100%;
            height: 100%;
            border-radius: 20px;
            z-index: 1;
            background-color: #ddd;
        }

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
    document.addEventListener('DOMContentLoaded', function() {

        var map = L.map('map').setView([48.08593223153121, -0.7586975230079035], 18);

        L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
            maxZoom: 20
        }).addTo(map);

        var markersGroup = L.featureGroup().addTo(map);

        <?php foreach ($objets_a_afficher as $objet): ?>
        <?php
        $coords = [$objet['latitude'], $objet['longitude']];
        // Gestion de l'image
        $img = getObjectImage($objet["id_objet"]);
        // On vérifie qu'on a bien des coordonnées
        if ($coords[0] != 0 && $coords[1] != 0):
        ?>

        var marker = L.marker([<?php echo $coords[0]; ?>, <?php echo $coords[1]; ?>]);

        // Contenu HTML du popup
        var content = `
                <div class="popup-content">
                    <img src="<?php echo htmlspecialchars($img); ?>" alt="Objet">
                    <h3><?php echo addslashes($objet['nom_objet']); ?></h3>
                    <p>📍 <?php echo addslashes($objet['nom_point_collecte']); ?></p>
                    <a href="index.php?action=detaille/show&id=<?php echo $objet['id_objet']; ?>" class="btn-detail">Voir l'objet</a>
                </div>
            `;

        marker.bindPopup(content);
        marker.addTo(markersGroup);

        <?php endif; ?>
        <?php endforeach; ?>

        if (markersGroup.getLayers().length > 0) {
            if (markersGroup.getLayers().length === 1) {
                map.fitBounds(markersGroup.getBounds(), {maxZoom: 18});
                markersGroup.getLayers()[0].openPopup();
            } else {
                map.fitBounds(markersGroup.getBounds(), {padding: [50, 50]});
            }
        }

        // Pour être sûr que la carte s'affiche bien
        setTimeout(function(){ map.invalidateSize(); }, 500);
    });
</script>

</body>
</html>