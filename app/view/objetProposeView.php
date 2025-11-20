<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/EcoGestUM-grp12-BYTE/assets/css/style-gestion.css">
    <title>Mes Objets Proposés</title>
</head>
<body>
    <?php include 'assets/html/header.html'; ?>
    <div class="gestion-wrapper">
        <div class="gestion-header-bar header-blue">
            <h1>Mes objets proposés</h1>
            <a href="index.php?action=gestion/show" class="back-icon">
                <i class="fa-solid fa-arrow-turn-up"></i>
            </a>
        </div>
        <div class="inner-content-wrapper">
            <div class="management-toolbar">
                <div class="filters-group">
                    <select class="filter-select">
                        <option>Tous les status</option>
                        <option>En attente</option>
                        <option>Acceptés</option>
                        <option>Refusés</option>
                    </select>
                    <select class="filter-select">
                        <option>Toutes les catégories</option>
                        <option>Mobilier</option>
                        <option>Informatique</option>
                        <option>Autre</option>
                    </select>
                </div>
                <a href="formView.php" class="btn-add-new">
                    <i class="fa-solid fa-plus"></i> Proposer un nouvel objet
                </a>
            </div>
            <div class="stats-dashboard">
                <div class="stat-card border-grey">
                    <span class="stat-number">12</span>
                    <span class="stat-label">Objets proposés</span>
                </div>
                <div class="stat-card border-yellow">
                    <span class="stat-number">3</span>
                    <span class="stat-label">En attente</span>
                </div>
                <div class="stat-card border-green">
                    <span class="stat-number">5</span>
                    <span class="stat-label">Acceptés</span>
                </div>
                <div class="stat-card border-blue">
                    <span class="stat-number">4</span>
                    <span class="stat-label">Récupérés</span>
                </div>
            </div>
            <div class="my-objects-grid">
                
                <div class="my-object-card">
                    <div class="status-badge status-pending">En attente</div>
                    <div class="card-img-top" style="background-image: url('http://googleusercontent.com/image_generation_content/0');"></div>
                    <div class="card-body">
                        <h3>
                            Chaise en bois 
                            <span class="category-label">Mobilier</span>
                        </h3>
                        <p class="card-desc">
                            Chaise en chêne massif, quelques rayures mais très solide. Parfait pour un étudiant ou un bureau.
                        </p>
                        <div class="card-meta">
                            <span><i class="fa-solid fa-location-dot"></i> Bâtiment E - Bureau 205</span>
                            <span><i class="fa-regular fa-calendar"></i> 15/01/2025</span>
                        </div>
                        <div class="card-actions">
                            <button class="btn-action-modify">Modifier</button>
                            <button class="btn-action-delete" onclick="openDeleteModal('Chaise en bois', 'traitement-suppression.php?id=1')">
                                Supprimer
                            </button>
                        </div>
                    </div>
                </div>
                <div class="my-object-card">
                    <div class="status-badge status-accepted">Accepté</div>
                    <div class="card-img-top" style="background-image: url('https://via.placeholder.com/400x300/A8A8A8/FFFFFF?text=Ecran+Dell');"></div>
                    <div class="card-body">
                        <h3>
                            Écran Dell 24" 
                            <span class="category-label">Informatique</span>
                        </h3>
                        <p class="card-desc">
                            Moniteur fonctionnel, connectique HDMI fournie. Idéal pour double écran. Très peu servi.
                        </p>
                        <div class="card-meta">
                            <span><i class="fa-solid fa-location-dot"></i> IUT - Salle 12</span>
                            <span><i class="fa-regular fa-calendar"></i> 10/01/2025</span>
                        </div>
                        <div class="card-actions">
                            <button class="btn-action-modify">Modifier</button>
                            <button class="btn-action-delete" onclick="openDeleteModal('Écran Dell 24', 'traitement-suppression.php?id=2')">
                                Supprimer
                            </button>
                        </div>
                    </div>
                </div>
                <div class="my-object-card">
                    <div class="status-badge status-collected">Récupéré</div>
                    <div class="card-img-top" style="background-image: url('https://via.placeholder.com/400x300/808080/FFFFFF?text=Souris+USB');"></div>
                    <div class="card-body">
                        <h3>
                            Lot de Souris USB
                            <span class="category-label">Informatique</span>
                        </h3>
                        <p class="card-desc">
                            Lot de 5 souris filaires USB classiques. Toutes testées et fonctionnelles.
                        </p>
                        <div class="card-meta">
                            <span><i class="fa-solid fa-location-dot"></i> Bibliothèque</span>
                            <span><i class="fa-regular fa-calendar"></i> 02/01/2025</span>
                        </div>
                        <div class="card-actions">
                            <button class="btn-action-modify">Modifier</button>
                            <button class="btn-action-delete" onclick="openDeleteModal('Lot de Souris USB', 'traitement-suppression.php?id=3')">
                                Supprimer
                            </button>
                        </div>
                    </div>
                </div>
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

    <div id="deleteModal" class="modal-overlay">
        <div class="modal-box">
            <h2 class="title-red">Supprimer l'objet</h2>
            <p class="modal-subtext">Attention : Cette action est irréversible</p>
            
            <p class="modal-question">
                Êtes-vous sûr de vouloir supprimer l'objet <br>
                "<strong id="modalObjectName">Objet</strong>" ?
            </p>

            <div class="modal-buttons">
                <button class="btn-modal-cancel" onclick="closeDeleteModal()">Annuler</button>
                <a href="#" id="confirmDeleteBtn" class="btn-modal-confirm">Supprimer définitivement</a>
            </div>
        </div>
    </div>

    <script src="../../assets/js/popup-objet.js"></script>
</body>
</html>