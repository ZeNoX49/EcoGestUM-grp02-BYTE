<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href=<?= $_ENV['BONUS_PATH']."assets/css/style-gestion.css" ?>>
    <title>Mes Réservations</title>
</head>
<body>
<?php include $_ENV['BONUS_PATH'].'assets/html/header.html'; ?>
<div class="gestion-wrapper">

    <div class="gestion-header-bar header-blue">
        <h1>Mes Réservations</h1>
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
                    <option>Confirmée</option>
                    <option>Complétée</option>
                </select>
            </div>
        </div>

        <div class="stats-dashboard">
            <div class="stat-card" style="border-left: 5px solid #2B3A6C;">
                <span class="stat-number"><?= $stats['actives'] ?></span>
                <span class="stat-label">Total Historique</span>
            </div>
            <div class="stat-card" style="border-left: 5px solid #8C9EFF;">
                <span class="stat-number"><?= $stats['pretes'] ?></span>
                <span class="stat-label">Confirmées (Prêtes)</span>
            </div>
            <div class="stat-card" style="border-left: 5px solid #27AE60;">
                <span class="stat-number"><?= $stats['recuperees'] ?></span>
                <span class="stat-label">Récupérées</span>
            </div>
            <div class="stat-card" style="border-left: 5px solid #FFE58F;">
                <span class="stat-number"><?= $stats['attente'] ?></span>
                <span class="stat-label">En attente</span>
            </div>
        </div>

        <div class="my-objects-grid reservation-grid">

            <?php if(empty($reservations)): ?>
                <p style="grid-column: 1/-1; text-align: center; color: #666;">Aucune réservation trouvée.</p>
            <?php endif; ?>

            <?php foreach($reservations as $res): ?>
                <?php
                // Gestion de l'image
                $imgSrc = !empty($res['image_objet']) ? $_ENV['BONUS_PATH'].'assets/image/uploads/'.$res['image_objet'] : 'https://via.placeholder.com/400x300?text=Pas+d\'image';
                if(strpos($res['image_objet'], 'http') === 0) { $imgSrc = $res['image_objet']; }

                $statusClass = "status-yellow";
                $statusLabel = $res['nom_statut_reservation'];
                $canConfirm = false;
                $canCancel = true;

                if($res['id_statut_reservation'] == 2) {
                    $statusClass = "status-purple";
                    $statusLabel = "Prête à récupérer";
                    $canConfirm = true;
                } elseif ($res['id_statut_reservation'] == 4) {
                    $statusClass = "status-accepted";
                    $statusLabel = "Récupérée";
                    $canConfirm = false;
                    $canCancel = false;
                } elseif ($res['id_statut_reservation'] == 3) {
                    $statusClass = "status-refused";
                    $canCancel = false;
                }
                ?>

                <div class="reservation-card">
                    <div class="res-card-header">
                        <h3><?= htmlspecialchars($res['nom_objet']) ?></h3>
                        <span class="res-category-badge"><?= htmlspecialchars($res['nom_categorie']) ?></span>
                    </div>

                    <div class="res-card-body">
                        <span class="res-status-badge <?= $statusClass ?>"><?= $statusLabel ?></span>

                        <ul class="res-info-list">
                            <li>
                                <span class="label"><i class="fa-regular fa-calendar-check"></i> Réservé le :</span>
                                <span class="value"><?= date('d/m/Y', strtotime($res['date_reservation'])) ?></span>
                            </li>
                            <li>
                                <span class="label"><i class="fa-solid fa-location-dot"></i> Lieu :</span>
                                <span class="value"><?= htmlspecialchars($res['nom_point_collecte']) ?></span>
                            </li>
                            <li>
                                <span class="label"><i class="fa-solid fa-envelope"></i> Proprio :</span>
                                <span class="value" style="font-size:11px;" title="<?= htmlspecialchars($res['email_proprietaire']) ?>">
                                        <?= htmlspecialchars(substr($res['email_proprietaire'], 0, 20)).'...' ?>
                                    </span>
                            </li>
                        </ul>

                        <p class="res-desc">
                            <?= htmlspecialchars(substr($res['description_objet'], 0, 100)) . '...' ?>
                        </p>

                        <div class="res-actions">
                            <?php if($canConfirm): ?>
                                <button class="res-btn btn-green" onclick="openConfirmModal('<?= addslashes($res['nom_objet']) ?>', '<?= $res['id_objet'] ?>')">Confirmer réception</button>
                            <?php endif; ?>

                            <a href="mailto:<?= $res['email_proprietaire'] ?>" class="res-btn btn-blue">Contacter</a>

                            <?php if($canCancel): ?>
                                <button class="res-btn btn-red" onclick="openCancelModal('<?= addslashes($res['nom_objet']) ?>', '<?= $res['id_objet'] ?>')">Annuler</button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
</div>
<?php include $_ENV['BONUS_PATH'].'assets/html/footer.html'; ?>

<div id="confirmModal" class="modal-overlay">
    <div class="modal-box">
        <h2 class="title-green">Confirmer la récupération</h2>
        <p class="modal-subtitle">Avez-vous bien récupéré cet objet ?</p>
        <p class="modal-text">Objet : "<span id="confirmObjectName"></span>"</p>
        <div class="modal-buttons">
            <button class="btn-modal-cancel" onclick="closeModal('confirmModal')">Non</button>
            <a id="btnConfirmLink" href="#" class="btn-modal-confirm-green">Oui, je l'ai</a>
        </div>
    </div>
</div>

<div id="cancelModal" class="modal-overlay">
    <div class="modal-box">
        <h2 class="title-red">Annuler la réservation</h2>
        <p class="modal-subtitle">Attention : Cette action libérera l'objet.</p>
        <p class="modal-text">Objet : "<span id="cancelObjectName"></span>"</p>
        <div class="modal-buttons">
            <button class="btn-modal-cancel" onclick="closeModal('cancelModal')">Retour</button>
            <a id="btnCancelLink" href="#" class="btn-modal-confirm-red">Confirmer l'annulation</a>
        </div>
    </div>
</div>
<script src=<?php echo $_ENV['BONUS_PATH']."assets/js/popup-reservation.js" ?>></script>
</body>
</html>