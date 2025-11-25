<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href=<?php echo $_ENV['BONUS_PATH']."assets/css/style-catalogue.css" ?>>
    <link rel="stylesheet" href=<?php echo $_ENV['BONUS_PATH']."assets/css/style-inventaire.css?v=3" ?>>

    <title>Inventaire</title>
</head>
<body>
<?php include $_ENV['BONUS_PATH'].'assets/html/header.html'; ?>

<div class="inv-wrapper">

    <div class="inv-content">

        <div class="inv-header-bar">
            <h1>Inventaire</h1>
            <a href="index.php?action=gestion/show" class="back-icon">
                <i class="fa-solid fa-arrow-turn-up"></i>
            </a>
        </div>

        <div class="inv-stats-row">
            <div class="inv-stat-card border-green">
                <span class="num"><?php if(isset($nbObjetsDisponibles))echo $nbObjetsDisponibles?></span>
                <span class="lbl">Disponible</span>
            </div>
            <div class="inv-stat-card border-yellow">
                <span class="num"><?php if(isset($nbObjetsReserve))echo $nbObjetsReserve?></span>
                <span class="lbl">Réservé</span>
            </div>
            <div class="inv-stat-card border-red">
                <span class="num">4</span>
                <span class="lbl">Supprimé</span>
            </div>
        </div>

        <div class="inv-filters-bar">
            <div class="inv-filters-left">
                <div class="inv-filter-item">
                    <label>Statut</label>
                    <select><option>Tous les statuts</option></select>
                </div>
                <div class="inv-filter-item">
                    <label>Catégorie</label>
                    <select><option>Toutes catégories</option></select>
                </div>
                <div class="inv-search-box">
                    <input type="text" placeholder="Rechercher un objet, un responsable...">
                </div>
            </div>

            <div class="inv-filters-right">
                <button class="btn-export"><i class="fa-solid fa-file-export"></i> Exporter</button>
                <button class="btn-add" onclick="openEditModal()"><i class="fa-solid fa-plus"></i> Ajouter un objet</button>
            </div>
        </div>

        <div class="inv-table-container">
            <div class="inv-table-header-info">
                <span class="list-title">Liste des objets (24 éléments)</span>
                <span class="last-update">Dernière mise à jour : il y a 4 min</span>
            </div>

            <table class="inv-table">
                <thead>
                <tr>
                    <th>Objet</th>
                    <th>Statut</th>
                    <th>Quantité</th>
                    <th>Localisation</th>
                    <th>Responsable</th>
                    <th>Dernière MAJ</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php if(isset($objets)) foreach($objets as $objet): ?>
                <tr>
                    <td>
                        <div class="obj-cell">
                            <div class="obj-img" style="background-image: url('https://via.placeholder.com/50');"></div>
                            <span><?=$objet['nom_objet']?></span>
                        </div>
                    </td>
                    <td><span class="badge badge-green">Disponible</span></td>
                    <td><strong><?=$objet['quantite'] ?></strong></td>
                    <td><?=$objet['nom_point_collecte']?> - <?=$objet['adresse_point_collecte']?></td>
                    <td><?=$objet['nom_utilisateur']?></td>
                    <td>Il y a 12 min</td>
                    <td>
                        <button class="btn-edit-icon" onclick="openEditModal()"><i class="fa-solid fa-pen"></i></button>
                    </td>
                </tr>
                <?php endforeach?>
                <tr>
                    <td>
                        <div class="obj-cell">
                            <div class="obj-img" style="background-image: url('https://via.placeholder.com/50/000000/FFFFFF');"></div>
                            <span>Ordinateur DELL</span>
                        </div>
                    </td>
                    <td><span class="badge badge-yellow">Réservé</span></td>
                    <td><strong>3</strong></td>
                    <td>Bâtiment B - Salle 203</td>
                    <td>M. Dufer</td>
                    <td>Il y a 2 min</td>
                    <td>
                        <button class="btn-edit-icon" onclick="openEditModal()"><i class="fa-solid fa-pen"></i></button>
                    </td>
                </tr>
                </tbody>
            </table>

            <div class="inv-pagination">
                <button class="pg-btn">&lt; Précédent</button>
                <button class="pg-btn active">1</button>
                <button class="pg-btn">2</button>
                <button class="pg-btn">Suivant &gt;</button>
            </div>
        </div>

    </div> </div>

<?php include $_ENV['BONUS_PATH'].'assets/html/footer.html'; ?>

<div id="modalEditObject" class="modal-overlay">
    <div class="modal-box">
        <h2 class="modal-title">Modifier l'objet</h2>
        <p class="modal-subtext">Mettez à jour les informations de l'objet dans l'inventaire</p>
        <form class="modal-form">
            <div class="form-group full"><label>Nom de l'objet *</label><input type="text" value="Chaise en bois" class="modal-input"></div>
            <div class="form-row">
                <div class="form-group half"><label>Statut *</label><select class="modal-input"><option>Disponible</option></select></div>
                <div class="form-group half"><label>Quantité *</label><input type="number" value="15" class="modal-input"></div>
            </div>
            <div class="modal-actions">
                <button type="button" class="btn-modal-cancel" onclick="closeModal()">Annuler</button>
                <button type="button" class="btn-modal-save">Enregistrer</button>
            </div>
        </form>
    </div>
</div>
<script src=<?php $_ENV['BONUS_PATH']."assets/js/popup-inventaire.js" ?>></script>
</body>
</html>