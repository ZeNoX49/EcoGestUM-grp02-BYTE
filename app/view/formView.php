<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Poppins:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href=<?php echo $_ENV['BONUS_PATH']."assets/css/style-form.css" ?>>
    <title>Proposer un objet</title>
</head>
<body>
<?php include $_ENV['BONUS_PATH'].'assets/html/header.html'; ?>
<div class="main">
    <div class="proposition-wrapper">
        <div class="proposition-header">
            <h1>Proposer un objet</h1>
            <a href="index.php?action=gestion/show" class="back-icon">
                <i class="fa-solid fa-arrow-turn-up"></i>
            </a>
        </div>

        <div class="proposition-content">
            <div class="info-banner">
                <i class="fa-regular fa-clipboard"></i>
                <p>Information : Ce formulaire simplifié vous permet de proposer un objet.</p>
            </div>

            <form action="index.php?action=form/submit" method="POST" enctype="multipart/form-data">
                <div class="form-grid">

                    <div class="left-col">
                        <div class="form-group">
                            <label>Nom de l'objet *</label>
                            <input type="text" name="nom_objet" class="input-field" placeholder="Ex : Chaise en bois" required>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-category">
                                <label>Catégorie *</label>
                                <select name="id_categorie" class="input-field" required>
                                    <option value="">Sélectionnez</option>

                                    <?php if(isset($categories)): ?>
                                        <?php foreach($categories as $cat): ?>
                                            <option value="<?= htmlspecialchars($cat['id_categorie']) ?>">
                                                <?= htmlspecialchars($cat['nom_categorie']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>

                                </select>
                            </div>
                            <div class="form-group col-quantity">
                                <label>Quantité</label>
                                <input type="number" name="quantite" class="input-field" value="1" min="1" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Localisation (Point de collecte) *</label>
                            <input type="text" name="nom_point_collecte" list="locations-list" class="input-field" placeholder="Choisissez ou écrivez un nouveau lieu..." required autocomplete="off">

                            <datalist id="locations-list">
                                <?php if(isset($pointsCollecte)): ?>
                                <?php foreach($pointsCollecte as $loc): ?>
                                <option value="<?= htmlspecialchars($loc['nom_point_collecte']) ?>">
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                            </datalist>
                        </div>

                        <div class="form-group">
                            <label>Photos de l'objet *</label>
                            <div class="upload-standalone">
                                <input type="file" accept="image/*" name="photos_objet[]" onchange="previewImages(this)">
                                <i class="fa-solid fa-cloud-arrow-up upload-icon"></i>
                                <span class="upload-text">Cliquez pour sélectionner une image</span>
                            </div>
                        </div>
                    </div>

                    <div class="right-col">
                        <div class="form-group">
                            <label>État de l'objet *</label>
                            <div class="state-selector">
                                <input type="radio" name="id_etat" id="etat4" value="4" class="state-option">
                                <label for="etat4" class="state-label">Moyen</label>

                                <input type="radio" name="id_etat" id="etat3" value="3" class="state-option">
                                <label for="etat3" class="state-label">Bon</label>

                                <input type="radio" name="id_etat" id="etat2" value="2" class="state-option">
                                <label for="etat2" class="state-label">Très bon</label>

                                <input type="radio" name="id_etat" id="etat1" value="1" class="state-option" checked>
                                <label for="etat1" class="state-label">Neuf</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Description détaillée *</label>
                            <textarea name="description_objet" class="input-field" placeholder="Décrivez l'objet..." required></textarea>

                            <div class="gallery-container">
                                <span class="gallery-label">Aperçu :</span>
                                <div class="preview-strip" id="previewGallery"></div>
                            </div>
                        </div>
                    </div>

                    <div class="form-footer">
                        <button type="submit" class="btn-submit">Proposer l'objet</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include $_ENV['BONUS_PATH'].'assets/html/footer.html'; ?>
<script src=<?php echo $_ENV['BONUS_PATH']."assets/js/preview.js" ?>></script>
</body>
</html>