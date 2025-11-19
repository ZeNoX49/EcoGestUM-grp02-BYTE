<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Koulen&family=Lexend:wght@100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Press+Start+2P&family=Roboto:ital,wght@0,100..900;1,100..900&family=Sour+Gummy:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style-catalogue.css">
    <title>Catalogue Recyclage</title>
</head>
<body>
    <header class="header">
        <div class="bandeau">
            <ul>
                <li><img src="assets/image/facebook.svg" alt="Facebook"></li>
                <li><img src="assets/image/youtube.svg" alt="YouTube"></li>
                <li><img src="assets/image/twitter.svg" alt="Twitter"></li>
                <li><img src="assets/image/instagram.svg" alt="Instagram"></li>
            </ul>
        </div>
        
        <div class="elements">
            <div class="logo-container">
                <img src="assets/image/logo.svg" alt="Le Mans Université">
            </div>
            <nav>
                <ul>
                    <li><a href="../../index.php">Accueil</a></li>
                    <li><a href="index.php?action=catalogue/show">Catalogue</a></li>
                    <li><a href="index.php?action=gestion/show">Gestion</a></li>
                    <li><a href="evenements.php">Événements</a></li>
                    <li><a href="statistiques.php">Statistiques</a></li>
                    <li class="profil-btn"><a href="profil.php">Mon Profil</a></li>
                </ul>
            </nav>
        </div>
    </header>
<div class="main">
        <div class="elements">
            <div class="search-barre">
                <div class="search-form">
                    <div class="search-input-container">
                        <img src="assets/image/search.svg" alt="Recherche" class="search-icon">
                        <input type="text" placeholder="Rechercher un objet" class="search-input">
                    </div>
                    
                    <div class="dropdown-container">
                        <input type="checkbox" id="toggle-filter" class="menu-checkbox">
                        <label for="toggle-filter" class="action-btn">Filtrer</label>
                        <div class="dropdown-menu category-menu">
                            <p class="filter-title">Catégories</p>
                            <div class="filter-tags">
                                <button type="button" class="tag-btn">Mobilier</button>
                                <button type="button" class="tag-btn">Informatique</button>
                                <button type="button" class="tag-btn">Pédagogique</button>
                                <button type="button" class="tag-btn">Multimédia</button>
                                <button type="button" class="tag-btn">Vêtements</button>
                                <button type="button" class="tag-btn">Sportif</button>
                            </div>
                        </div>
                    </div>

                    <div class="dropdown-container">
                        <input type="checkbox" id="toggle-sort" class="menu-checkbox">
                        <label for="toggle-sort" class="action-btn">Trier</label>
                        <div class="dropdown-menu sort-menu">
                            <div class="filter-section">
                                <p class="filter-title">État</p>
                                <div class="filter-tags">
                                    <button type="button" class="tag-btn">Mauvaise état</button>
                                    <button type="button" class="tag-btn">Bon état</button>
                                    <button type="button" class="tag-btn">Très bon état</button>
                                    <button type="button" class="tag-btn selected">Parfait</button>
                                </div>
                            </div>
                            <div class="filter-section">
                                <p class="filter-title">Localisation</p>
                                <div class="location-box">
                                    <img src="assets/image/map-pin.svg" alt="Loc" class="loc-icon">
                                    <input type="text" placeholder="Ajouter une localisation">
                                </div>
                            </div>
                            <button type="button" class="validate-btn">Valider</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="catalogue-wrapper">
                <div class="catalogue">
                    <div class="catalogue-list">

                        <?php if(isset($objets)):
                                foreach($objets as $objet): ?>
                        <article class="card-objet">
                            <div class="card-img-container">
                                <div class="card-image-box" style="background-image: url('https://via.placeholder.com/140x140/A8A8A8/FFFFFF?text=Objet+Générique'); background-size: 80%; background-repeat: no-repeat;">
                                    </div>
                            </div>
                            <div class="card-content" onclick="window.location.href='index.php?action=detaille/show&id=<?php echo $objet['id_objet']; ?>'">
                                <h3><?php echo $objet['nom_objet']?> </h3>
                                <div class="card-text">
                                    <span class="label">Description :</span>
                                    <p><?php echo $objet['description_objet']; ?></p>
                                </div>
                                <div class="card-text">
                                    <span class="label">Localisation :</span>
                                    <span class="value"> <?php echo $objet['nom_point_collecte'] ?> | <?php echo $objet['adresse_point_collecte'] ?> </span>
                                </div>
                            </div>
                            <a href="#" class="card-action">
                                <span>Réserver</span>
                            </a>
                        </article>
                        <?php endforeach; endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <div class="footer-content">
            <div class="elements-gauche">
                <nav>
                    <ul>
                        <li><h4>Ressources</h4></li>
                        <li><a href="CatalogueRecyclage.php">Politique de recyclage</a></li>
                        <li><a href="gestion.php">Rapports annuels</a></li>
                        <li><a href="evenements.php">Guide utilisateur</a></li>
                        <li><a href="statistiques.php">Événements écoresponsables</a></li>
                        <li><a href="statistiques.php">Campagnes de sensibilisation</a></li>
                    </ul>
                </nav>
            </div>
            <div class="elements-droite">
                <nav>
                    <ul>
                        <li><h4>Contact</h4></li>
                        <li><p>ecogestum@univ-lemans.fr</p></li>
                        <li><p>+33 2 43 83 30 30</p></li>
                        <li><a href="evenements.php">Nous contacter</a></li>
                        <li><a href="statistiques.php">Signaler un problème</a></li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© 2025 Le Mans Université - EcoGestUM. Tous droits réservés. | <a href="#">Mentions légales</a> | <a href="#">Politique de confidentialité</a></p>
        </div>
    </div>
</body>
</html>