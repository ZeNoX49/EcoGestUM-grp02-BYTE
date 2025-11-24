<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href=<?php echo $_ENV['PATH']."assets/css/style-gestion.css?v=2" ?>>
    <title>Gestion des Catégories</title>
</head>
<body>
<?php include $_ENV['PATH'].'assets/html/header.html'; ?>

<div class="gestion-wrapper">
    <div class="gestion-header-bar">
        <h1>Gestion des Catégories</h1>
        <a href="index.php?action=gestion/show" class="back-icon">
            <i class="fa-solid fa-arrow-turn-up"></i>
        </a>
    </div>
    <div class="info-box-large">
        <p>Les catégories permettent d'organiser et de classer les objets recyclables. Vous pouvez ajouter de nouvelles catégories pour répondre aux besoins évolutifs de l'université, modifier les catégories existantes ou les désactiver si elles ne sont plus pertinentes.</p>
    </div>
    <div class="inner-content-wrapper">
        <div class="categories-toolbar">
            <div class="cat-stats-row">
                <div class="mini-stat-card">
                    <div class="icon-box"><i class="fa-regular fa-folder-open"></i></div>
                    <div class="text-box">
                        <span class="num"><?php echo count($categories); ?></span>
                        <span class="lbl">Catégories totales</span>
                    </div>
                </div>
                <div class="mini-stat-card">
                    <div class="icon-box brown"><i class="fa-solid fa-box"></i></div>
                    <div class="text-box">
                        <?php $totalObjets = array_sum(array_column($categories, 'nb_objets')); ?>
                        <span class="num"><?php echo $totalObjets; ?></span>
                        <span class="lbl">Objets catégorisés</span>
                    </div>
                </div>
            </div>
            <div class="cat-actions-row">
                <input type="text" placeholder="Rechercher..." class="search-input-cat">
                <button class="btn-add-green" onclick="openEditModal('', '', '', 'fa-solid fa-box', 'Active', 'new')">
                    Ajouter une catégorie
                </button>
            </div>
        </div>

        <div class="categories-grid">
            <?php foreach($categories as $cat):
                $statut = isset($cat['statut_categorie']) ? $cat['statut_categorie'] : 'Active';
                ?>
                <div class="category-card">
                    <div class="cat-card-actions">
                        <button class="btn-icon-blue" onclick="openEditModal(
                                '<?php echo $cat['id_categorie']; ?>',
                                '<?php echo addslashes($cat['nom_categorie']); ?>',
                                '<?php echo addslashes($cat['description_categorie']); ?>',
                                '<?php echo $cat['image_categorie']; ?>',
                                '<?php echo $statut; ?>',
                                'edit'
                                )"><i class="fa-solid fa-pen"></i></button>

                        <button class="btn-icon-red" onclick="openDeleteModal(
                                '<?php echo $cat['id_categorie']; ?>',
                                '<?php echo addslashes($cat['nom_categorie']); ?>',
                                '<?php echo $cat['nb_objets']; ?>'
                                )"><i class="fa-solid fa-trash"></i></button>
                    </div>
                    <div class="cat-icon-large">
                        <i class="<?php echo $cat['image_categorie']; ?>"></i>
                    </div>
                    <h3><?php echo htmlspecialchars($cat['nom_categorie']); ?></h3>
                    <p class="cat-desc"><?php echo htmlspecialchars($cat['description_categorie']); ?></p>

                    <div style="margin-bottom: 10px;">
                        <?php if($statut === 'Active'): ?>
                            <span style="background:#D4EDDA; color:#155724; padding:3px 8px; border-radius:10px; font-size:11px; font-weight:bold;">Active</span>
                        <?php else: ?>
                            <span style="background:#F8D7DA; color:#721C24; padding:3px 8px; border-radius:10px; font-size:11px; font-weight:bold;">Inactive</span>
                        <?php endif; ?>
                    </div>

                    <div class="cat-footer">
                        <div class="cat-meta">
                            <span>Objets</span>
                            <strong><?php echo $cat['nb_objets']; ?></strong>
                        </div>
                        <div class="cat-meta right">
                            <span>Dernière MAJ</span>
                            <strong><?php echo date('d M Y'); ?></strong>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php include $_ENV['PATH'].'assets/html/footer.html'; ?>

<div id="modalDeleteCat" class="modal-overlay">
    <div class="modal-box" style="max-width: 600px;">
        <h2 class="modal-title-red" style="text-align: left;">Supprimer la catégorie</h2>
        <p class="modal-subtext" style="text-align: left;">Attention : Cette action est irréversible</p>
        <p class="modal-question" style="text-align: left;">
            Êtes-vous sûr de vouloir supprimer la catégorie "<strong id="delCatName">Nom</strong>" ?
        </p>
        <div class="warning-box-yellow">
            <span id="delCatCount">0</span> objets sont actuellement associés à cette catégorie.
        </div>
        <form action="index.php?action=gestionCategories/delete" method="POST" class="modal-buttons" style="justify-content: flex-end; margin-top: 20px;">
            <input type="hidden" name="id_categorie" id="deleteIdInput">
            <button type="button" class="btn-modal-cancel" onclick="closeModal('modalDeleteCat')">Annuler</button>
            <button type="submit" class="btn-modal-confirm-red-solid">Supprimer définitivement</button>
        </form>
    </div>
</div>

<div id="modalEditCat" class="modal-overlay">
    <div class="modal-box" style="max-width: 500px; text-align: left;">
        <h2 class="modal-title-blue" id="modalTitle">Modifier la catégorie</h2>
        <p class="modal-subtext" style="margin-bottom: 20px;">Mettez à jour les informations de la catégorie</p>

        <form id="editCatForm" method="POST" action="index.php?action=gestionCategories/add">
            <input type="hidden" name="id_categorie" id="editCatIdInput">

            <div class="form-group">
                <label class="input-label-sm">Nom de la catégorie *</label>
                <input type="text" name="nom_categorie" id="editCatNameInput" class="input-field-sm" required>
            </div>

            <div class="form-group">
                <label class="input-label-sm">Description *</label>
                <textarea name="description_categorie" id="editCatDescInput" class="input-field-sm" rows="4" required></textarea>
            </div>

            <div class="form-group">
                <label class="input-label-sm">Icône *</label>
                <div class="icon-selector">
                    <input type="radio" name="icone_categorie" id="icon1" value="fa-solid fa-laptop" checked>
                    <label for="icon1" class="icon-option"><i class="fa-solid fa-laptop"></i></label>

                    <input type="radio" name="icone_categorie" id="icon2" value="fa-solid fa-chair">
                    <label for="icon2" class="icon-option"><i class="fa-solid fa-chair"></i></label>

                    <input type="radio" name="icone_categorie" id="icon3" value="fa-regular fa-keyboard">
                    <label for="icon3" class="icon-option"><i class="fa-regular fa-keyboard"></i></label>

                    <input type="radio" name="icone_categorie" id="icon4" value="fa-solid fa-mobile-screen">
                    <label for="icon4" class="icon-option"><i class="fa-solid fa-mobile-screen"></i></label>

                    <input type="radio" name="icone_categorie" id="icon5" value="fa-solid fa-box">
                    <label for="icon5" class="icon-option"><i class="fa-solid fa-box"></i></label>

                    <input type="radio" name="icone_categorie" id="icon6" value="fa-solid fa-flask">
                    <label for="icon6" class="icon-option"><i class="fa-solid fa-flask"></i></label>

                    <input type="radio" name="icone_categorie" id="icon7" value="fa-solid fa-book">
                    <label for="icon7" class="icon-option"><i class="fa-solid fa-book"></i></label>
                </div>
            </div>

            <div class="form-group">
                <label class="input-label-sm">Statut</label>
                <select name="statut_categorie" id="editCatStatusInput" class="input-field-sm">
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                </select>
            </div>

            <div class="modal-buttons" style="justify-content: flex-end; margin-top: 30px;">
                <button type="button" class="btn-modal-cancel" onclick="closeModal('modalEditCat')">Annuler</button>
                <button type="submit" class="btn-modal-confirm-green-solid">Enregistrer les modifications</button>
            </div>
        </form>
    </div>
</div>

<script src=<?php echo $_ENV['PATH']."assets/js/popup-categories.js" ?>></script>
</body>
</html>