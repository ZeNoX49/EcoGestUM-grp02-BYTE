<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Koulen&family=Lexend:wght@100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Press+Start+2P&family=Roboto:ital,wght@0,100..900;1,100..900&family=Sour+Gummy:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style-form.css">
    <title>Proposer un objet</title>
</head>
<body>
    <?php include 'assets/html/header.html'; ?>
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
                    <p>Information : Ce formulaire simplifié vous permet de proposer un objet pour recyclage ou réutilisation au sein de l'université. Tous les champs marqués d'un astérisque (*) sont obligatoires.</p>
                </div>

                <form action="traitement-proposition.php" method="POST" enctype="multipart/form-data">
                    <div class="form-grid">
                        
                        <div class="left-col">
                            <div class="form-group">
                                <label>Nom de l'objet *</label>
                                <input type="text" class="input-field" placeholder="Ex : Chaise en bois" required>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-category">
                                    <label>Catégorie *</label>
                                    <select class="input-field">
                                        <option value="">Sélectionnez</option>
                                        <option value="mobilier">Mobilier</option>
                                        <option value="informatique">Informatique</option>
                                        <option value="autre">Autre</option>
                                    </select>
                                </div>
                                <div class="form-group col-quantity">
                                    <label>Quantité</label>
                                    <input type="number" class="input-field" value="1" min="1">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Localisation *</label>
                                <input type="text" class="input-field" placeholder="Bâtiment, Salle..." required>
                            </div>

                            <div class="form-group">
                                <label>Disponibilité</label>
                                <input type="date" class="input-field">
                            </div>
                            
                            <div class="form-group">
                                <label>Photos de l'objet (Multiple) *</label>
                                <div class="upload-standalone">
                                    <input type="file" accept="image/*" name="photos_objet[]" multiple onchange="previewImages(this)">
                                    
                                    <i class="fa-solid fa-cloud-arrow-up upload-icon"></i>
                                    <span class="upload-text">Cliquez pour sélectionner les images</span>
                                </div>
                            </div>
                        </div>

                        <div class="right-col">
                            <div class="form-group">
                                <label>État de l'objet *</label>
                                <div class="state-selector">
                                    <input type="radio" name="etat" id="etat1" class="state-option">
                                    <label for="etat1" class="state-label">Mauvais</label>

                                    <input type="radio" name="etat" id="etat2" class="state-option">
                                    <label for="etat2" class="state-label">Bon</label>

                                    <input type="radio" name="etat" id="etat3" class="state-option">
                                    <label for="etat3" class="state-label">Très bon</label>

                                    <input type="radio" name="etat" id="etat4" class="state-option" checked>
                                    <label for="etat4" class="state-label">Parfait</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Contact *</label>
                                <input type="email" class="input-field" value="votre.email@univ-lemans.fr">
                            </div>

                            <div class="form-group">
                                <label>Description détaillée *</label>
                                <textarea class="input-field" placeholder="Décrivez l'objet..."></textarea>
                                
                                <div class="gallery-container">
                                    <span class="gallery-label">Aperçu des images sélectionnées :</span>
                                    <div class="preview-strip" id="previewGallery">
                                        </div>
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
    <?php include 'assets/html/footer.html'; ?>
    <script src="assets/js/preview.js"></script>
    </body>
</html>