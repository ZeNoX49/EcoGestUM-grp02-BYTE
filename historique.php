<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="assets/css/style-catalogue.css">
    <link rel="stylesheet" href="assets/css/style-historique.css?v=1">

    <title>Historique des Opérations</title>
</head>
<body>
<?php include 'assets/html/header.html'; ?>

<div class="hist-wrapper">

    <div class="hist-header-bar">
        <h1>Historique des Opérations</h1>
        <a href="gestion-objets.php" class="back-icon">
            <i class="fa-solid fa-arrow-turn-up"></i>
        </a>
    </div>

    <div class="hist-content">

        <div class="hist-stats-row">
            <div class="hist-stat-card">
                <div class="icon-box green"><i class="fa-solid fa-plus"></i></div>
                <div class="text-box">
                    <span class="num">12</span>
                    <span class="lbl">Objets ajoutés</span>
                </div>
            </div>
            <div class="hist-stat-card">
                <div class="icon-box brown"><i class="fa-solid fa-box"></i></div>
                <div class="text-box">
                    <span class="num">89</span>
                    <span class="lbl">Réservations</span>
                </div>
            </div>
            <div class="hist-stat-card">
                <div class="icon-box blue"><i class="fa-solid fa-rotate"></i></div>
                <div class="text-box">
                    <span class="num">43</span>
                    <span class="lbl">Transferts</span>
                </div>
            </div>
            <div class="hist-stat-card">
                <div class="icon-box red"><i class="fa-solid fa-recycle"></i></div>
                <div class="text-box">
                    <span class="num">25</span>
                    <span class="lbl">Recyclages</span>
                </div>
            </div>
        </div>

        <div class="hist-filters-bar">
            <div class="filters-left">
                <div class="f-item">
                    <label>Type d'opération</label>
                    <select><option>Tous les statuts</option></select>
                </div>
                <div class="f-item">
                    <label>Catégorie d'objet</label>
                    <select><option>Toutes catégories</option></select>
                </div>
                <div class="f-item">
                    <label>Département/Service</label>
                    <select><option>Tous</option></select>
                </div>
                <div class="f-item long">
                    <label>Utilisateur</label>
                    <input type="text" placeholder="Rechercher un utilisateur">
                </div>
            </div>
            <div class="filters-right">
                <button class="btn-apply">Appliquer les filtres</button>
                <div class="sub-actions">
                    <button class="btn-reset">Réinitialiser</button>
                    <button class="btn-export">Exporter</button>
                </div>
            </div>
        </div>

        <div class="hist-timeline-container">

            <div class="timeline-header">
                <h2>Chronologie des opérations</h2>
                <span class="count">284 opérations trouvées</span>
            </div>

            <div class="timeline-list">

                <div class="timeline-item">
                    <div class="dot green"></div>
                    <div class="t-date">28 janvier 2025 - 14:30</div>

                    <span class="badge-action green">Ajout d'objet</span>

                    <h3 class="t-title">15 Ordinateurs portables Dell ajoutés au catalogue</h3>
                    <p class="t-desc">Suite au renouvellement du parc informatique, 15 ordinateurs portables Dell Latitude 5420 en bon état ont été ajoutés au catalogue de recyclage.</p>

                    <div class="t-grid">
                        <div><span class="lbl">Objet</span><span class="val">Ordinateurs Dell Latitude 5420</span></div>
                        <div><span class="lbl">Quantité</span><span class="val">15 unités</span></div>
                        <div><span class="lbl">CatégorieMatériel</span><span class="val">Informatique</span></div>
                        <div><span class="lbl">État</span><span class="val">Bon</span></div>
                        <div><span class="lbl">Ajouté par</span><span class="val">J. Martin (Service Info)</span></div>
                        <div><span class="lbl">Localisation</span><span class="val">Entrepôt - Zone A</span></div>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="dot green"></div>
                    <div class="t-date">29 janvier 2025 - 14:30</div>
                    <span class="badge-action green">Ajout d'objet</span>
                    <h3 class="t-title">15 Ordinateurs portables Dell ajoutés au catalogue</h3>
                    <p class="t-desc">Suite au renouvellement du parc informatique, 15 ordinateurs portables Dell Latitude 5420 en bon état ont été ajoutés au catalogue de recyclage.</p>
                    <div class="t-grid">
                        <div><span class="lbl">Objet</span><span class="val">Ordinateurs Dell Latitude 5420</span></div>
                        <div><span class="lbl">Quantité</span><span class="val">15 unités</span></div>
                        <div><span class="lbl">CatégorieMatériel</span><span class="val">Informatique</span></div>
                        <div><span class="lbl">État</span><span class="val">Bon</span></div>
                        <div><span class="lbl">Ajouté par</span><span class="val">J. Martin (Service Info)</span></div>
                        <div><span class="lbl">Localisation</span><span class="val">Entrepôt - Zone A</span></div>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="dot green"></div>
                    <div class="t-date">20 janvier 2025 - 14:30</div>
                    <span class="badge-action green">Ajout d'objet</span>
                    <h3 class="t-title">15 Ordinateurs portables Dell ajoutés au catalogue</h3>
                    <p class="t-desc">Suite au renouvellement du parc informatique, 15 ordinateurs portables Dell Latitude 5420 en bon état ont été ajoutés au catalogue de recyclage.</p>
                    <div class="t-grid">
                        <div><span class="lbl">Objet</span><span class="val">Ordinateurs Dell Latitude 5420</span></div>
                        <div><span class="lbl">Quantité</span><span class="val">15 unités</span></div>
                        <div><span class="lbl">CatégorieMatériel</span><span class="val">Informatique</span></div>
                        <div><span class="lbl">État</span><span class="val">Bon</span></div>
                        <div><span class="lbl">Ajouté par</span><span class="val">J. Martin (Service Info)</span></div>
                        <div><span class="lbl">Localisation</span><span class="val">Entrepôt - Zone A</span></div>
                    </div>
                </div>

            </div>

            <div class="pagination-container">
                <button class="pg-btn">&lt; Précédent</button>
                <button class="pg-btn active">1</button>
                <button class="pg-btn">2</button>
                <button class="pg-btn">Suivant &gt;</button>
            </div>

        </div>
    </div>
</div>

<?php include 'assets/html/footer.html'; ?>
</body>
</html>