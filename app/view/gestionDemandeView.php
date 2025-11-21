<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/EcoGestUM-grp12-BYTE/assets/css/style-gestion.css">
    <title>Gérer les demandes</title>
</head>
<body>
    <?php include 'assets/html/header.html'; ?>
    
    <div class="gestion-wrapper">
        
        <div class="gestion-header-bar">
            <h1>Demandes</h1>
            <a href="/ecogestum-grp12-byte/gestion/show" class="back-icon">
                <i class="fa-solid fa-arrow-turn-up"></i>
            </a>
        </div>

        <div class="inner-content-wrapper">
            
            <div class="stats-dashboard">
                <div class="stat-card border-green">
                    <span class="stat-number">12</span>
                    <span class="stat-label">Approuvées (ce mois)</span>
                </div>
                <div class="stat-card border-yellow">
                    <span class="stat-number">3</span>
                    <span class="stat-label">En attente</span>
                </div>
                <div class="stat-card border-blue">
                    <span class="stat-number">5</span>
                    <span class="stat-label">Total (ce mois)</span>
                </div>
                <div class="stat-card border-red">
                    <span class="stat-number">4</span>
                    <span class="stat-label">Refusées (ce mois)</span>
                </div>
            </div>

            <div class="filter-bar-custom">
                <div class="filters-left">
                    <div class="filter-item">
                        <label>Type de demande</label>
                        <select><option>Tous les types</option></select>
                    </div>
                    <div class="filter-item">
                        <label>Priorité</label>
                        <select><option>Toutes priorités</option></select>
                    </div>
                    <div class="filter-item">
                        <label>Département</label>
                        <select><option>Tous Départements</option></select>
                    </div>
                </div>
                <div class="search-right">
                    <input type="text" placeholder="Rechercher un objet, un responsable...">
                </div>
            </div>

            <div class="tabs-container">
                <button class="tab-btn active">En attente (12)</button>
                <button class="tab-btn">Approuvées</button>
                <button class="tab-btn">Refusées</button>
                <button class="tab-btn">Toutes</button>
            </div>

            <div class="requests-list">

                <div class="request-card">
                    <div class="req-header">
                        <span class="req-tag tag-yellow">Demande de réservation</span>
                        <span class="req-priority priority-urgent">Urgent</span>
                    </div>
                    
                    <h2 class="req-title">Demande de chaises de bureau ergonomiques</h2>
                    
                    <div class="req-meta">
                        <span>Demandeur: <strong>Dr. Sophie Leroy</strong></span>
                        <span>Date: <strong>28 janvier 2025</strong></span>
                        <span>Département: <strong>Laboratoire LIUM</strong></span>
                    </div>

                    <p class="req-description">
                        Suite à l'aménagement de nouveaux bureaux pour doctorants, nous cherchons 5 chaises de bureau ergonomiques en bon état.
                    </p>

                    <div class="req-details-grid">
                        <div class="req-detail-item">
                            <span class="label">Objet demandé</span>
                            <span class="value">Chaises de bureau</span>
                        </div>
                        <div class="req-detail-item">
                            <span class="label">Quantité</span>
                            <span class="value">5 unités</span>
                        </div>
                        <div class="req-detail-item">
                            <span class="label">Date souhaitée</span>
                            <span class="value">5 février 2025</span>
                        </div>
                        <div class="req-detail-item">
                            <span class="label">Localisation destination</span>
                            <span class="value">Bâtiment C - Étage 2</span>
                        </div>
                    </div>

                    <div class="req-actions">
                        <button class="btn-refuse" onclick="openRefuseModal('Demande de chaises de bureau ergonomiques')">Refuser</button>
                        <button class="btn-approve" onclick="openApproveModal('Demande de chaises de bureau ergonomiques')">Approuver</button>
                    </div>
                </div>

                <div class="request-card">
                    <div class="req-header">
                        <span class="req-tag tag-yellow">Demande de réservation</span>
                        <span class="req-priority priority-normal">Normal</span>
                    </div>
                    
                    <h2 class="req-title">Demande d'écrans d'ordinateur</h2>
                    
                    <div class="req-meta">
                        <span>Demandeur: <strong>M. Jean Dupont</strong></span>
                        <span>Date: <strong>29 janvier 2025</strong></span>
                        <span>Département: <strong>Scolarité IUT</strong></span>
                    </div>

                    <p class="req-description">
                        Besoin de deux écrans supplémentaires pour le secrétariat pédagogique.
                    </p>

                    <div class="req-details-grid">
                        <div class="req-detail-item">
                            <span class="label">Objet demandé</span>
                            <span class="value">Écran 24 pouces</span>
                        </div>
                        <div class="req-detail-item">
                            <span class="label">Quantité</span>
                            <span class="value">2 unités</span>
                        </div>
                    </div>

                    <div class="req-actions">
                        <button class="btn-refuse" onclick="openRefuseModal('Demande d\'écrans d\'ordinateur')">Refuser</button>
                        <button class="btn-approve" onclick="openApproveModal('Demande d\'écrans d\'ordinateur')">Approuver</button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <?php include 'assets/html/footer.html'; ?>

    <div id="modalApprove" class="modal-overlay">
        <div class="modal-box">
            <h2 class="modal-title-green">Approuver la demande</h2>
            <p class="modal-subtext">Attention : Cette action est irréversible</p>
            
            <p class="modal-question">
                Êtes-vous sûr de vouloir Accepter la demande "<strong id="approveNamePlace">Nom Demande</strong>" ?
            </p>

            <div class="modal-buttons">
                <button class="btn-modal-cancel" onclick="closeModal('modalApprove')">Annuler</button>
                <button class="btn-modal-confirm-green-solid">Approuver la demande</button>
            </div>
        </div>
    </div>

    <div id="modalRefuse" class="modal-overlay">
        <div class="modal-box">
            <h2 class="modal-title-red">Refuser la demande</h2>
            <p class="modal-subtext">Attention : Cette action est irréversible</p>
            
            <p class="modal-question">
                Êtes-vous sûr de vouloir refuser la demande "<strong id="refuseNamePlace">Nom Demande</strong>" ?
            </p>

            <div class="modal-buttons">
                <button class="btn-modal-cancel" onclick="closeModal('modalRefuse')">Annuler</button>
                <button class="btn-modal-confirm-red-solid">Refuser définitivement</button>
            </div>
        </div>
    </div>

    <script src="../../assets/js/popup-demandes.js"></script>
</body>
</html>