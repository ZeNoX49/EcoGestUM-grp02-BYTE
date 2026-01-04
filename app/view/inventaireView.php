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
            <div class="inv-stat-card border-blue">
                <span class="num"><?php if(isset($nbObjetsEnAttente))echo $nbObjetsEnAttente?></span>
                <span class="lbl">En attente</span>
            </div>
            <div class="inv-stat-card border-red">
                <span class="num"><?php if(isset($nbObjetsRefusee))echo $nbObjetsRefusee?></span>
                <span class="lbl">Supprimé</span>
            </div>
        </div>

        <div class="inv-filters-bar">
            <div class="inv-filters-left">
                <div class="inv-filter-item">
                    <label>Statut</label>
                    <select onchange="changerStatut(this.value)">
                        <option>Tous les statuts</option>
                        <?php if(isset($statutList)) foreach($statutList as $statut): ?>
                            <option value="<?= $statut['nom_statut_disponibilite'] ?>"
                                <?php
                                if(isset($_GET['statut']) && $_GET['statut'] == $statut['nom_statut_disponibilite']) {
                                    echo 'selected';
                                }
                                ?>>
                            <?= $statut['nom_statut_disponibilite'] ?>
                            </option>
                        <?php endforeach; ?>

                    </select>
                </div>
                <div class="inv-filter-item">
                    <label>Catégorie</label>
                    <select id="categorieSelect" onchange="changerCategorie(this.value)">
                        <option>Toutes catégories</option>
                        <?php if(isset($categoriesList)) foreach($categoriesList as $cat): ?>
                            <option value="<?= $cat['id_categorie'] ?>"
                                <?php
                                if(isset($_GET['categorie']) && $_GET['categorie'] == $cat['id_categorie']) {
                                    echo 'selected';
                                }
                                ?>>
                            <?= $cat['nom_categorie'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="inv-search-box">
                    <form action="index.php" method="GET">
                        <input type="hidden" name="action" value="inventaire/show">
                        <input type="text" name="search" placeholder="Rechercher un objet..." class="search-input" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                    </form>
                </div>
            </div>

            <div class="inv-filters-right">
                <button class="btn-export"><i class="fa-solid fa-file-export"></i> Exporter</button>
                <button class="btn-add" onclick="window.location.href = 'index.php?action=form/show'"><i class="fa-solid fa-plus"></i> Ajouter un objet</button>
            </div>
        </div>

        <div class="inv-table-container">
            <div class="inv-table-header-info">
                <span class="list-title">Liste des objets (<?php if(isset($objets)) echo count($objets)?>)</span>
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
                    <th>Catégorie</th>
                    <th>Dernière MAJ</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php if(isset($objets)) foreach($objets as $objet): ?>
                <tr>
                    <td>
                        <div class="obj-cell">
                            <?php
                            $imgSrc = !empty($objet['image_objet']) ? $_ENV['BONUS_PATH'].'assets/image/uploads/'.$objet['image_objet'] : 'https://via.placeholder.com/140x140/A8A8A8/FFFFFF?text=Pas+d\'image';
                            if(strpos($objet['image_objet'], 'http') === 0) { $imgSrc = $objet['image_objet']; }
                            ?>
                            <div class="obj-img" style="background-image: url('<?php echo htmlspecialchars($imgSrc); ?>');"></div>
                            <span><?=$objet['nom_objet']?></span>
                        </div>
                    </td>
                    <td><span class="badge <?php if(isset($correspStyleStatutDisponible)) echo $correspStyleStatutDisponible[$objet['nom_statut_disponibilite']]?>"><?=$objet['nom_statut_disponibilite']?></span></td>
                    <td><strong><?=$objet['quantite'] ?></strong></td>
                    <td><?=$objet['nom_point_collecte']?> - <?=$objet['adresse_point_collecte']?></td>
                    <td><?=$objet['nom_utilisateur']?></td>
                    <td><?=$objet['nom_categorie']?></td>
                    <td>Il y a 12 min</td>
                    <td>
                        <button class="btn-edit-icon" onclick="openInventaireEditModal('<?=$objet['nom_objet']?>','<?=$objet['nom_statut_disponibilite']?>', '<?=$objet['quantite']?>', 'index?action=inventaire/edit&idEdit=<?=$objet['id_objet'] ?>')"><i class="fa-solid fa-pen"></i></button>
                    </td>
                </tr>
                <?php endforeach?>
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
            <div class="form-group full"><label for="modalObjectNameEdit">Nom de l'objet *</label><input type="text" id="modalObjectNameEdit"  class="modal-input"></div>
            <div class="form-row">
                <div class="form-group half"><label>Statut *</label><select class="modal-input"><option>Disponible</option></select></div>
                <div class="form-group half"><label>Quantité *</label><input type="number" id="modalObjectQuantitiesEdit" class="modal-input"></div>
            </div>
            <div class="modal-actions">
                <button type="button" class="btn-modal-cancel" onclick="closeModal()">Annuler</button>
                <button type="button" class="btn-modal-save" id="btn-save">Enregistrer</button>
            </div>
        </form>
    </div>
</div>
<script src="<?php echo $_ENV['BONUS_PATH']."assets/js/popup-inventaire.js" ?>"></script>
<script>
  function changerCategorie(valeur) {
    // On garde l'action actuelle et on ajoute/modifie le paramètre categorie
    const url = new URL(window.location.href);

    if(valeur && valeur != "Toutes catégories") {
      url.searchParams.set('categorie', valeur);
    } else {
      url.searchParams.delete('categorie'); // Si "Toutes", on retire le filtre
    }

    // On remet la pagination à 1 pour éviter les bugs (ex: être page 2 d'une liste vide)
    url.searchParams.set('page', '1');

    window.location.href = url.toString();
  }

  function changerStatut(valeur){
    const url = new URL(window.location.href);

    if(valeur && valeur != "Tous les statuts"){
      url.searchParams.set('statut', valeur);
    } else {
      url.searchParams.delete('statut');
    }

    window.location.href = url.toString();
  }
</script>
</body>
</html>