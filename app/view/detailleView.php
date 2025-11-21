<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Koulen&family=Lexend:wght@100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Press+Start+2P&family=Roboto:ital,wght@0,100..900;1,100..900&family=Sour+Gummy:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Ordinateur portable Dell Latitude 5420</title>
</head>
<body>
    <?php include 'assets/html/header.html'; ?>
    <div class="main-detail">
        <div class="back-to-catalogue">
            <a href="/ecogestum-grp12-byte/catalogue/show">Retour au catalogue</a>
        </div>
        
        <div class="breadcrumb">
            <a href="index.php">Accueil</a> / 
            <a href="/ecogestum-grp12-byte/catalogue/show">Catalogue</a> /
            Matériel Informatique / Ordinateur portable Dell Latitude 5420
        </div>

        <div class="detail-wrapper">
            <?php if(isset($objet)): ?>
            <div class="left-column">
                <div class="image-section">
                    
                    <input type="radio" name="gallery" id="img-1" class="gallery-input" checked>
                    <input type="radio" name="gallery" id="img-2" class="gallery-input">
                    <input type="radio" name="gallery" id="img-3" class="gallery-input">

                    <div class="image-display" style="width: 100%;">
                        <div class="main-image-box view-1" style="background-image: url(http://googleusercontent.com/image_generation_content/1);"></div>
                        <div class="main-image-box view-2" style="background-image: url('https://i.imgur.com/k9bT6Lg.png'); background-size: 70%;"></div>
                        <div class="main-image-box view-3" style="background-image: url('https://i.imgur.com/jM8fJ0X.png'); background-size: 70%;"></div>
                    </div>
                    
                    <div class="thumbnails">
                        <label for="img-1" class="thumbnail-box thumb-1" style="background-image: url(http://googleusercontent.com/image_generation_content/1); background-size: 80%;"></label>
                        <label for="img-2" class="thumbnail-box thumb-2" style="background-image: url('https://i.imgur.com/k9bT6Lg.png'); background-size: 70%;"></label>
                        <label for="img-3" class="thumbnail-box thumb-3" style="background-image: url('https://i.imgur.com/jM8fJ0X.png'); background-size: 70%;"></label>
                    </div>
                </div>

                <div class="detailed-info">
                    <h4>Informations détaillées</h4>
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="label">Processeur</span>
                            <span class="value">Intel Core i5-1135G7</span>
                        </div>
                        <div class="info-item">
                            <span class="label">Mémoire RAM</span>
                            <span class="value">8 Go DDR4</span>
                        </div>
                        <div class="info-item">
                            <span class="label">Stockage</span>
                            <span class="value">SSD 256 Go NVMe</span>
                        </div>
                        <div class="info-item">
                            <span class="label">Écran</span>
                            <span class="value">14" Full HD (1920x1080)</span>
                        </div>
                        <div class="info-item">
                            <span class="label">Système d'exploitation</span>
                            <span class="value">Windows 11 Pro</span>
                        </div>
                        <div class="info-item">
                            <span class="label">Année d'achat</span>
                            <span class="value">2021</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="right-column">
                
                <span class="dispo-tag">Disponible</span>
                
                <h1><?php echo $objet['nom_objet'] ?></h1>
                
                <div class="main-attributes">
                    <div class="attribute-item">
                        <span class="label">Catégorie</span>
                        <span class="value"><?=$objet['nom_categorie']?></span>
                    </div>
                    <div class="attribute-item">
                        <span class="label">État</span>
                        <span class="value"><?=$objet['nom_etat']?></span>
                    </div>
                    <div class="attribute-item">
                        <span class="label">Quantité</span>
                        <span class="value">15 unités</span>
                    </div>
                    <div class="attribute-item">
                        <span class="label">Localisation</span>
                        <span class="value"><?=$objet['nom_point_collecte']?> | <?=$objet['adresse_point_collecte']?></span>
                    </div>
                    <div class="attribute-item">
                        <span class="label">Date d'ajout</span>
                        <span class="value"><?=$objet['date_ajout_objet']?></span>
                    </div>
                    <div class="attribute-item">
                        <span class="label">Responsable</span>
                        <span class="value"><?=$objet['nom_utilisateur']?></span>
                    </div>
                </div>

                <div class="description-box">
                    <h2>Description</h2>
                    <p>
                        <?=$objet['description_objet']?>
                    </p>
                </div>

                <div class="action-buttons">
                    <a href="/ecogestum-grp12-BYTE/mesReservations/add&idObjet=<?=$objet['id_objet']?>" class="btn-reserve">Réserver cet objet</a>
                    <a href="mapView.php" class="btn-map">Voir sur la carte</a>
                    <a href="#" class="btn-contact">Contacter</a>
                </div>

            </div>
        </div>
        <?php endif; ?>
    </div>


    <?php include 'assets/html/footer.html'; ?>
</body>
</html>