<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Poppins:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href=<?php echo $_ENV['BONUS_PATH']."assets/css/style-form.css" ?>>
    <title>Proposer un échange</title>
</head>
<body>
<?php include $_ENV['BONUS_PATH'].'assets/html/header.html'; ?>

<div class="main">
    <div class="proposition-wrapper">

        <div class="proposition-header" style="background-color: #DB4C3B;">
            <h1>Proposer un échange</h1>
            <a href="index.php?action=gestion/show" class="back-icon">
                <i class="fa-solid fa-arrow-turn-up"></i>
            </a>
        </div>

        <div class="proposition-content">
            <div class="info-banner">
                <i class="fa-regular fa-clipboard"></i>
                <p>Information : Ce formulaire simplifié vous permet de proposer un objet pour recyclage ou réutilisation au sein de l'université. Tous les champs marqués d'un astérisque (*) sont obligatoires.</p>
            </div>

            <form action="index.php?action=formEleve/submit" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="quantite" value="1">
                <input type="hidden" name="id_etat" value="3">

                <div class="form-grid">

                    <div class="left-col">
                        <div class="form-group">
                            <label>Nom de l'objet *</label>
                            <input type="text" name="nom_objet" class="input-field" placeholder="Ex : Chaise en bois" required>
                        </div>

                        <div class="form-group">
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

                        <div class="form-group">
                            <label>Localisation *</label>
                            <input type="text" name="nom_point_collecte" list="locations-list" class="input-field" placeholder="Bâtiment, Salle..." required autocomplete="off">
                            <datalist id="locations-list">
                                <?php if(isset($pointsCollecte)): ?>
                                <?php foreach($pointsCollecte as $loc): ?>
                                <option value="<?= htmlspecialchars($loc['nom_point_collecte']) ?>">
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                            </datalist>
                        </div>

                        <div class="form-group">
                            <label>Disponibilité</label>
                            <input type="date" name="date_dispo" class="input-field" placeholder="JJ/MM/AAAA">
                        </div>
                    </div>

                    <div class="right-col">
                        <div class="form-group">
                            <label>Description détaillée *</label>
                            <textarea name="description_objet" class="input-field" placeholder="Décrivez l'objet, ses caractéristiques, son état général..." style="height: 120px;" required></textarea>
                        </div>

                        <div class="form-group">
                            <label>Photo de l'objet *</label>
                            <div class="upload-standalone" style="height: 180px; background-color: #DCE3F5; border: 2px dashed #8FA1D0;">
                                <input type="file" accept="image/*" name="photos_objet[]" onchange="previewImages(this)" style="height: 100%;">
                                <div style="text-align: center; pointer-events: none;">
                                    <i class="fa-solid fa-camera" style="font-size: 30px; color: #7FA1D0; margin-bottom: 10px;"></i>
                                    <span class="upload-text" style="display:block;">Cliquez pour ajouter une photo</span>
                                </div>
                            </div>

                            <div class="gallery-container">
                                <div class="preview-strip" id="previewGallery"></div>
                            </div>
                        </div>
                    </div>

                    <div class="form-footer" style="margin-top: -30px;">
                        <button type="submit" class="btn-submit">Proposer l'échange</button>
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