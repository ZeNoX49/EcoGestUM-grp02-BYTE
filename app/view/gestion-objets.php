<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/style-catalogue.css">
    <link rel="stylesheet" href="../../assets/css/style-gestion.css">
    <title>Gestion des Objets</title>
</head>
<body>

    <header class="header">
        <div class="bandeau">
            <ul>
                <li><img src="assets/images/facebook.svg" alt="Facebook"></li>
                <li><img src="assets/images/youtube.svg" alt="YouTube"></li>
                <li><img src="assets/images/twitter.svg" alt="Twitter"></li>
                <li><img src="assets/images/instagram.svg" alt="Instagram"></li>
            </ul>
        </div>
        <div class="elements">
            <div class="logo-container">
                <img src="assets/images/logo.svg" alt="Le Mans Université">
            </div>
            <nav>
                <ul>
                    <li><a href="../../index.php">Accueil</a></li>
                    <li><a href="index.php?action=catalogue/show">Catalogue</a></li>
                    <li><a href="index.php?action=gestion/show" style="color: #DB4C3B; font-weight:700;">Gestion</a></li>
                    <li><a href="evenements.php">Événements</a></li>
                    <li><a href="statistiques.php">Statistiques</a></li>
                    <li class="profil-btn"><a href="profil.php">Mon Profil</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="gestion-wrapper">
        
        <div class="gestion-header-bar">
            <h1>Gestion des Objets</h1>
            <a href="profil.php" class="back-icon">
                <i class="fa-solid fa-arrow-turn-up"></i>
            </a>
        </div>

        <div class="gestion-grid">
            
            <a href="ajouter-objet.php" class="gestion-card">
                <div class="card-icon-wrapper">
                    <i class="fa-solid fa-pen-to-square"></i>
                </div>
                <div class="card-text-content">
                    <h3>Proposer un Objet</h3>
                    <p>Formulaire simplifié pour ajouter un nouvel objet à la plateforme de partage</p>
                </div>
            </a>

            <a href="mes-objets.php" class="gestion-card">
                <div class="card-icon-wrapper">
                    <i class="fa-solid fa-box-open"></i>
                </div>
                <div class="card-text-content">
                    <h3>Mes Objets Proposés</h3>
                    <p>Consultez et gérez tous les objets que vous avez mis à disposition</p>
                </div>
            </a>

            <a href="mes-reservations.php" class="gestion-card">
                <div class="card-icon-wrapper">
                    <i class="fa-regular fa-calendar-check"></i>
                </div>
                <div class="card-text-content">
                    <h3>Mes Réservations</h3>
                    <p>Suivez l'état de vos demandes de réservation et objets empruntés</p>
                </div>
            </a>

            <a href="gestion-categories.php" class="gestion-card">
                <div class="card-icon-wrapper">
                    <i class="fa-solid fa-tags"></i>
                </div>
                <div class="card-text-content">
                    <h3>Gestion des catégories</h3>
                    <p>Créez et modifiez les catégories pour adapter le classement des objets recyclables aux besoins de votre service</p>
                </div>
            </a>

            <a href="gerer-demandes.php" class="gestion-card">
                <div class="card-icon-wrapper">
                    <i class="fa-solid fa-square-check"></i>
                </div>
                <div class="card-text-content">
                    <h3>Gérer les demandes</h3>
                    <p>Consultez, approuvez ou refusez les demandes de réservation en attente</p>
                </div>
            </a>

            <a href="inventaire.php" class="gestion-card">
                <div class="card-icon-wrapper">
                    <i class="fa-solid fa-boxes-stacked"></i>
                </div>
                <div class="card-text-content">
                    <h3>Inventaire</h3>
                    <p>Visualisez l'ensemble des objets de la plateforme avec leur disponibilité et emplacement</p>
                </div>
            </a>

             <a href="historique.php" class="gestion-card">
                <div class="card-icon-wrapper">
                    <i class="fa-solid fa-file-lines"></i>
                </div>
                <div class="card-text-content">
                    <h3>Historique des opérations</h3>
                    <p>Retrouvez le suivi complet de toutes les réservations et transactions d'objets</p>
                </div>
            </a>

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