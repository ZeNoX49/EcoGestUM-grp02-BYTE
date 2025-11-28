<?php if(!(isset($demandeNouvObjetEnAttente) && isset($reservationAccepter) && isset($reservationRefuser) && isset($nbObjAttente) && isset($nbReservationAccepter) && isset($nbReservationRefuser) && isset($nbObjets))) die('error server')?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href=<?php echo $_ENV['BONUS_PATH']."assets/css/style-gestion.css" ?>>
    <title>Gérer les demandes</title>
</head>
<body>
    <?php include $_ENV['BONUS_PATH'].'assets/html/header.html'; ?>
    
    <div class="gestion-wrapper">
        
        <div class="gestion-header-bar">
            <h1>Demandes</h1>
            <a href="index.php?action=gestion/show" class="back-icon">
                <i class="fa-solid fa-arrow-turn-up"></i>
            </a>
        </div>

        <div class="inner-content-wrapper">
            
            <div class="stats-dashboard">
                <div class="stat-card border-green">
                    <span class="stat-number"><?= $nbReservationAccepter?></span>
                    <span class="stat-label">Approuvées (ce mois)</span>
                </div>
                <div class="stat-card border-yellow">
                    <span class="stat-number"><?= $nbObjAttente?></span>
                    <span class="stat-label">En attente</span>
                </div>
                <div class="stat-card border-blue">
                    <span class="stat-number"><?= $nbObjets ?></span>
                    <span class="stat-label">Total (ce mois)</span>
                </div>
                <div class="stat-card border-red">
                    <span class="stat-number"><?=$nbReservationRefuser?></span>
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
                <?php foreach($demandeNouvObjetEnAttente as $object ) : ?>
                <div class="request-card">
                    <div class="req-header">
                        <span class="req-tag tag-yellow">Demande de réservation</span>
                        <span class="req-priority priority-urgent"><?=$object['nom_statut_disponibilite']?></span>
                    </div>
                    
                    <h2 class="req-title"><?=$object['nom_objet'] ?></h2>
                    
                    <div class="req-meta">
                        <span>Demandeur: <strong><?=$object['nom_utilisateur']?></strong></span>
                        <span>Date: <strong><?=$object['date_ajout_objet']?></strong></span>
                        <span>Département: <strong><?=$object['nom_departement'] ?></strong></span>
                    </div>

                    <p class="req-description">
                        Suite à l'aménagement de nouveaux bureaux pour doctorants, nous cherchons 5 chaises de bureau ergonomiques en bon état.
                    </p>

                    <div class="req-details-grid">
                        <div class="req-detail-item">
                            <span class="label">Quantité</span>
                            <span class="value"><?= $object['quantite']?></span>
                        </div>
                        <div class="req-detail-item">
                            <span class="label">Localisation destination</span>
                            <span class="value"><?=$object['nom_point_collecte']?> - <?=$object['adresse_point_collecte']?></span>
                        </div>
                    </div>

                    <div class="req-actions">
                        <button class="btn-refuse" onclick="openRefuseModal('<?= $object['nom_objet'] ?>', 'index?action=gestionDemande/refuser&refuseId=<?= $object['id_objet'] ?>')">Refuser</button>
                        <button class="btn-approve" onclick="openApproveModal('<?= $object['nom_objet'] ?>', 'index?action=gestionDemande/accepter&acceptId=<?= $object['id_objet'] ?>')">Approuver</button>
                    </div>
                </div>
                <?php endforeach  ?>


    <?php include $_ENV['BONUS_PATH'].'assets/html/footer.html'; ?>

    <div id="modalApprove" class="modal-overlay">
        <div class="modal-box">
            <h2 class="modal-title-green">Approuver la demande</h2>
            <p class="modal-subtext">Attention : Cette action est irréversible</p>
            
            <p class="modal-question">
                Êtes-vous sûr de vouloir Accepter la demande "<strong id="approveNamePlace">Nom Demande</strong>" ?
            </p>

            <div class="modal-buttons">
                <button class="btn-modal-cancel" onclick="closeModal('modalApprove')">Annuler</button>
                <button class="btn-modal-confirm-green-solid" id="confirmAccepterButton">Approuver la demande</button>
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
                <button class="btn-modal-confirm-red-solid" id="confirmRefuserButton">Refuser définitivement</button>
            </div>
        </div>
    </div>

    <script src=<?php echo $_ENV['BONUS_PATH']."assets/js/popup-demandes.js" ?>></script>

</body>
</html>