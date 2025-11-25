<?php if(!isset($objets) || !isset($nbAttente) || !isset($nbDisponible) || !isset($nbRserve)) die('error')?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href=<?php echo $_ENV['BONUS_PATH']."assets/css/style-gestion.css" ?>>
    <title>Mes Objets Proposés</title>
</head>
<body>
    <?php include $_ENV['BONUS_PATH'].'assets/html/header.html'; ?>
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
                <a href="index.php?action=form/show" class="btn-add-new">
                    <i class="fa-solid fa-plus"></i> Proposer un nouvel objet
                </a>
            </div>
            <div class="stats-dashboard">
                <div class="stat-card border-grey">
                    <span class="stat-number"><?= count($objets)?></span>
                    <span class="stat-label">Objets proposés</span>
                </div>
                <div class="stat-card border-yellow">
                    <span class="stat-number"><?=$nbAttente?></span>
                    <span class="stat-label">En attente de validation</span>
                </div>
                <div class="stat-card border-green">
                    <span class="stat-number"><?=$nbDisponible?></span>
                    <span class="stat-label">Disponible</span>
                </div>
                <div class="stat-card border-blue">
                    <span class="stat-number"><?=$nbRserve?></span>
                    <span class="stat-label">Réservés</span>
                </div>
            </div>
            <div class="my-objects-grid">
                <?php foreach ($objets as $objet):?>
                    <div class="my-object-card">
                    <div class="status-badge status-pending"><?=$objet['nom_statut_disponibilite']?></div>
                    <div class="card-img-top" style="background-image: url('http://googleusercontent.com/image_generation_content/0');"></div>
                    <div class="card-body">
                        <h3>
                            <?=$objet['nom_objet']?>
                            <span class="category-label"><?=$objet['nom_categorie']?></span>
                        </h3>
                        <p class="card-desc">
                            <?=$objet['nom_objet']?>
                        </p>
                        <div class="card-meta">
                            <span><i class="fa-solid fa-location-dot"></i> <?=$objet['nom_point_collecte']?> - <?=$objet['adresse_point_collecte']?></span>
                            <span><i class="fa-regular fa-calendar"></i> <?=$objet['date_ajout_objet']?></span>
                        </div>
                        <div class="card-actions">
                            <button class="btn-action-modify">Modifier</button>
                            <button class="btn-action-delete" onclick="openDeleteModal('Chaise en bois', 'index.php?action=objetPropose/delete&deleteId=<?=$objet['id_objet']?>')">
                                Supprimer
                            </button>
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
    <?php include $_ENV['BONUS_PATH'].'assets/html/footer.html'; ?>

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

    <script src=<?php echo $_ENV['BONUS_PATH']."assets/js/popup-objet.js" ?>></script>
</body>
</html>