<?php if(!isset($objets)) die('error')?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/EcoGestUM-grp12-BYTE/assets/css/style-catalogue.css">
    <link rel="stylesheet" href="/EcoGestUM-grp12-BYTE/assets/css/style-gestion.css">
    
    <title>Mes Réservations</title>
</head>
<body>
    <?php include 'assets/html/header.html'; ?>
    <div class="gestion-wrapper">
        
        <div class="gestion-header-bar header-blue">
            <h1>Mes Réservations</h1>
            <a href="/ecogestum-grp12-byte/gestion/show" class="back-icon">
                <i class="fa-solid fa-arrow-turn-up"></i>
            </a>
        </div>

        <div class="inner-content-wrapper">
            
            <div class="management-toolbar">
                <div class="filters-group">
                    <select class="filter-select">
                        <option>Tous les status</option>
                        <option>Prêtes à récupérer</option>
                        <option>En attente</option>
                    </select>
                    <select class="filter-select">
                        <option>Toutes les catégories</option>
                        <option>Mobilier</option>
                        <option>Informatique</option>
                    </select>
                </div>
                
                <button class="search-btn-custom" style="background-color: #2B3A6C; color: white; font-weight: 550; padding: 10px 20px; border-radius: 30px; border:none; cursor:pointer;">
                    <i class="fa-solid fa-magnifying-glass"></i> &nbsp;Rechercher
                </button>
            </div>

            <div class="stats-dashboard">
                <div class="stat-card" style="border-left: 5px solid #DB4C3B;">
                    <span class="stat-number">12</span>
                    <span class="stat-label">Réservations actives</span>
                </div>
                <div class="stat-card" style="border-left: 5px solid #DB4C3B;">
                    <span class="stat-number">3</span>
                    <span class="stat-label">Prêtes à récupérer</span>
                </div>
                <div class="stat-card" style="border-left: 5px solid #DB4C3B;">
                    <span class="stat-number">5</span>
                    <span class="stat-label">Total récupérées</span>
                </div>
                <div class="stat-card" style="border-left: 5px solid #DB4C3B;">
                    <span class="stat-number">4</span>
                    <span class="stat-label">En attente</span>
                </div>
            </div>

            <div class="my-objects-grid reservation-grid">
                <?php foreach ($objets as $objet):?>
                
                <div class="reservation-card">
                    <div class="res-card-header">
                        <h3>Chaise en bois</h3>
                        <span class="res-category-badge">Meuble</span>
                    </div>
                    
                    <div class="res-card-body">
                        <span class="res-status-badge status-purple">Prêtes</span>

                        <ul class="res-info-list">
                            <li>
                                <span class="label"><i class="fa-regular fa-calendar-check"></i> Réserver le :</span>
                                <span class="value">20/10/2025</span>
                            </li>
                            <li>
                                <span class="label"><i class="fa-solid fa-clock"></i> Retrait :</span>
                                <span class="value">Dans 31 Jour(s)</span>
                            </li>
                            <li>
                                <span class="label"><i class="fa-solid fa-location-dot"></i> Lieu :</span>
                                <span class="value">Bâtiment A - 205</span>
                            </li>
                            <li>
                                <span class="label"><i class="fa-solid fa-envelope"></i> Contact :</span>
                                <span class="value" style="font-size:11px;">jean.martin@univ-lemans.fr</span>
                            </li>
                        </ul>

                        <p class="res-desc">
                            Chaise en chêne massif avec tiroirs, parfait pour le télétravail.
                        </p>

                        <div class="res-actions">
                            <button class="res-btn btn-green" onclick="openConfirmModal('Chaise en bois')">Confirmer</button>
                            
                            <button class="res-btn btn-blue">Contacter</button>
                            
                            <button class="res-btn btn-red" onclick="openReportModal('Chaise en bois')">Signaler</button>
                        </div>
                    </div>
                </div>
                <?php endforeach;?>



            </div>

            <div class="pagination-container">
                <a href="#" class="page-btn">< Précédent</a>
                <a href="#" class="page-btn active">1</a>
                <a href="#" class="page-btn">2</a>
                <a href="#" class="page-btn">Suivant ></a>
            </div>

        </div>
    </div>
    <?php include 'assets/html/footer.html'; ?>
    <div id="confirmModal" class="modal-overlay">
        <div class="modal-box">
            <h2 class="title-green">Confirmer la récupération</h2>
            <p class="modal-subtitle">Attention : Cette action est irréversible</p>
            
            <p class="modal-text">
                Êtes-vous sûr de vouloir confirmer la récupération de l'objet "<span id="confirmObjectName">Objet</span>" ?
            </p>

            <div class="modal-buttons">
                <button class="btn-modal-cancel" onclick="closeModal('confirmModal')">Annuler</button>
                <button class="btn-modal-confirm-green">Confirmer définitivement</button>
            </div>
        </div>
    </div>

    <div id="reportModal" class="modal-overlay">
        <div class="modal-box">
            <h2 class="title-red">Signaler</h2>
            <p class="modal-subtitle">Signaler un problème en lien avec cet objet</p>
            
            <label class="input-label">Problème(s) *</label>
            <textarea class="modal-textarea" placeholder="Décrivez votre problème..."></textarea>

            <div class="modal-buttons">
                <button class="btn-modal-cancel" onclick="closeModal('reportModal')">Annuler</button>
                <button class="btn-modal-confirm-red">Signaler le problème</button>
            </div>
        </div>
    </div>

    <script src="../../assets/js/popup-reservation.js"></script>
</body>
</html>