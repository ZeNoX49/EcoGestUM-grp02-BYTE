<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/EcoGestUM-grp12-BYTE/assets/css/style-gestion.css?v=2">
    <title>Gestion des Catégories</title>
</head>
<body>
<?php include 'assets/html/header.html'; ?>

<div class="gestion-wrapper">
    <div class="gestion-header-bar">
        <h1>Gestion des Catégories</h1>
        <a href="gestion-objets.php" class="back-icon">
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
                        <span class="num">12</span>
                        <span class="lbl">Catégories actives</span>
                    </div>
                </div>
                <div class="mini-stat-card">
                    <div class="icon-box brown"><i class="fa-solid fa-box"></i></div>
                    <div class="text-box">
                        <span class="num">847</span>
                        <span class="lbl">Objets catégorisés</span>
                    </div>
                </div>
            </div>
            <div class="cat-actions-row">
                <input type="text" placeholder="Rechercher un objet, un responsable..." class="search-input-cat">
                <button class="btn-add-green" onclick="openEditModal('Nouvelle Catégorie', '', 'new')">
                    Ajouter une catégorie
                </button>
            </div>
        </div>
        <div class="categories-grid">
            <div class="category-card">
                <div class="cat-card-actions">
                    <button class="btn-icon-blue" onclick="openEditModal('Matériel Informatique', 'Ordinateurs, périphériques, serveurs...', 'edit')"><i class="fa-solid fa-pen"></i></button>
                    <button class="btn-icon-red" onclick="openDeleteModal('Matériel Informatique', 247)"><i class="fa-solid fa-trash"></i></button>
                </div>
                <div class="cat-icon-large">
                    <i class="fa-solid fa-laptop"></i>
                </div>
                <h3>Matériel Informatique</h3>
                <p class="cat-desc">Ordinateurs, périphériques, serveurs, équipements réseau et tout matériel informatique réutilisable.</p>
                <div class="cat-footer">
                    <div class="cat-meta">
                        <span>Objets</span>
                        <strong>247</strong>
                    </div>
                    <div class="cat-meta right">
                        <span>Dernière MAJ</span>
                        <strong>28 janv. 2025</strong>
                    </div>
                </div>
            </div>
            <div class="category-card">
                <div class="cat-card-actions">
                    <button class="btn-icon-blue" onclick="openEditModal('Mobilier de Bureau', 'Chaises, bureaux, armoires, caissons et tout mobilier destiné à l\'aménagement des espaces de travail.', 'edit')"><i class="fa-solid fa-pen"></i></button>
                    <button class="btn-icon-red" onclick="openDeleteModal('Mobilier de Bureau', 152)"><i class="fa-solid fa-trash"></i></button>
                </div>
                <div class="cat-icon-large">
                    <i class="fa-solid fa-chair"></i>
                </div>
                <h3>Mobilier de Bureau</h3>
                <p class="cat-desc">Chaises, bureaux, armoires, caissons et tout mobilier destiné à l'aménagement des espaces de travail.</p>
                <div class="cat-footer">
                    <div class="cat-meta">
                        <span>Objets</span>
                        <strong>152</strong>
                    </div>
                    <div class="cat-meta right">
                        <span>Dernière MAJ</span>
                        <strong>28 janv. 2025</strong>
                    </div>
                </div>
            </div>
            <div class="category-card">
                <div class="cat-card-actions">
                    <button class="btn-icon-blue" onclick="openEditModal('Matériel Scientifique', 'Équipements de laboratoire, verrerie, microscopes et instruments de mesure pour la recherche.', 'edit')"><i class="fa-solid fa-pen"></i></button>
                    <button class="btn-icon-red" onclick="openDeleteModal('Matériel Scientifique', 84)"><i class="fa-solid fa-trash"></i></button>
                </div>
                <div class="cat-icon-large">
                    <i class="fa-solid fa-flask"></i>
                </div>
                <h3>Matériel Scientifique</h3>
                <p class="cat-desc">Équipements de laboratoire, verrerie, microscopes et instruments de mesure pour la recherche.</p>
                <div class="cat-footer">
                    <div class="cat-meta">
                        <span>Objets</span>
                        <strong>84</strong>
                    </div>
                    <div class="cat-meta right">
                        <span>Dernière MAJ</span>
                        <strong>20 janv. 2025</strong>
                    </div>
                </div>
            </div>

            <div class="category-card">
                <div class="cat-card-actions">
                    <button class="btn-icon-blue" onclick="openEditModal('Pédagogique', 'Tableaux blancs, projecteurs, manuels scolaires et fournitures diverses pour l\'enseignement.', 'edit')"><i class="fa-solid fa-pen"></i></button>
                    <button class="btn-icon-red" onclick="openDeleteModal('Pédagogique', 12)"><i class="fa-solid fa-trash"></i></button>
                </div>
                <div class="cat-icon-large">
                    <i class="fa-solid fa-book"></i>
                </div>
                <h3>Pédagogique</h3>
                <p class="cat-desc">Tableaux blancs, projecteurs, manuels scolaires et fournitures diverses pour l'enseignement.</p>

                <div class="cat-footer">
                    <div class="cat-meta">
                        <span>Objets</span>
                        <strong>12</strong>
                    </div>
                    <div class="cat-meta right">
                        <span>Dernière MAJ</span>
                        <strong>15 janv. 2025</strong>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php include 'assets/html/footer.html'; ?>

<div id="modalDeleteCat" class="modal-overlay">
    <div class="modal-box" style="max-width: 600px;">
        <h2 class="modal-title-red" style="text-align: left;">Supprimer la catégorie</h2>
        <p class="modal-subtext" style="text-align: left;">Attention : Cette action est irréversible</p>

        <p class="modal-question" style="text-align: left;">
            Êtes-vous sûr de vouloir supprimer la catégorie "<strong id="delCatName">Nom</strong>" ?
        </p>

        <div class="warning-box-yellow">
            <span id="delCatCount">247</span> objets sont actuellement associés à cette catégorie. Ils devront être réassignés à une autre catégorie.
        </div>

        <div class="modal-buttons" style="justify-content: flex-end; margin-top: 20px;">
            <button class="btn-modal-cancel" onclick="closeModal('modalDeleteCat')">Annuler</button>
            <button class="btn-modal-confirm-red-solid">Supprimer définitivement</button>
        </div>
    </div>
</div>

<div id="modalEditCat" class="modal-overlay">
    <div class="modal-box" style="max-width: 500px; text-align: left;">
        <h2 class="modal-title-blue">Modifier la catégorie</h2>
        <p class="modal-subtext" style="margin-bottom: 20px;">Mettez à jour les informations de la catégorie</p>

        <form>
            <div class="form-group">
                <label class="input-label-sm">Nom de la catégorie *</label>
                <input type="text" id="editCatNameInput" class="input-field-sm" value="Matériel informatique">
            </div>

            <div class="form-group">
                <label class="input-label-sm">Description *</label>
                <textarea id="editCatDescInput" class="input-field-sm" rows="4">Ordinateurs, périphériques...</textarea>
            </div>

            <div class="form-group">
                <label class="input-label-sm">Icône *</label>
                <div class="icon-selector">
                    <input type="radio" name="icon" id="icon1" checked>
                    <label for="icon1" class="icon-option"><i class="fa-solid fa-laptop"></i></label>

                    <input type="radio" name="icon" id="icon2">
                    <label for="icon2" class="icon-option"><i class="fa-solid fa-desktop"></i></label>

                    <input type="radio" name="icon" id="icon3">
                    <label for="icon3" class="icon-option"><i class="fa-regular fa-keyboard"></i></label>

                    <input type="radio" name="icon" id="icon4">
                    <label for="icon4" class="icon-option"><i class="fa-solid fa-mobile-screen"></i></label>

                    <button type="button" class="icon-add-btn"><i class="fa-solid fa-plus"></i></button>
                </div>
            </div>

            <div class="form-group">
                <label class="input-label-sm">Statut</label>
                <select class="input-field-sm">
                    <option>Active</option>
                    <option>Inactive</option>
                </select>
            </div>

            <div class="modal-buttons" style="justify-content: flex-end; margin-top: 30px;">
                <button type="button" class="btn-modal-cancel" onclick="closeModal('modalEditCat')">Annuler</button>
                <button type="button" class="btn-modal-confirm-green-solid">Enregistrer les modifications</button>
            </div>
        </form>
    </div>
</div>

<script src="../../assets/js/popup-categories.js"></script>
</body>
</html>