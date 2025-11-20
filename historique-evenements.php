<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="assets/css/style-catalogue.css">
    <link rel="stylesheet" href="assets/css/style-historique.css?v=4">

    <title>Historique des Évènements</title>

    <style>
        /* Surcharge locale pour voir l'image de fond UNIQUEMENT sur cette page */
        body {
            background-color: transparent !important;
        }
    </style>
</head>
<body>
<?php include 'assets/html/header.html'; ?>

<div class="hist-wrapper">

    <div class="events-glass-container">

        <div class="hist-header-bar">
            <h1>Historique des Évènements</h1>
            <a href="gestion-objets.php" class="back-icon">
                <i class="fa-solid fa-arrow-turn-up"></i>
            </a>
        </div>

        <div class="hist-filters-bar">
            <div class="filters-left">
                <div class="f-item">
                    <label>Types d'opérations</label>
                    <select><option>Tous les statuts</option></select>
                </div>
                <div class="f-item">
                    <label>Catégorie d'évènement</label>
                    <select><option>Toutes catégories</option></select>
                </div>
                <div class="f-item">
                    <label>Département/Service</label>
                    <select><option>Tous</option></select>
                </div>
                <div class="f-item long">
                    <label>Organisateur</label>
                    <input type="text" placeholder="Rechercher un organisateur">
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

        <div class="events-timeline-box">
            <div class="timeline-header">
                <h2>Chronologie des opérations</h2>
                <span class="count">284 opérations trouvées</span>
            </div>

            <div class="timeline-list">

                <div class="timeline-item">
                    <div class="dot green"></div>
                    <div class="t-meta-top">
                        <div class="t-date">28 janvier 2025 - 14:30</div>
                        <span class="badge-action green">Ajout d'objet</span>
                    </div>

                    <h3 class="t-title">Fête de l'écologie</h3>
                    <p class="t-desc">Le BDE MMI a l'honneur d'organiser une fête de l'écologie...</p>

                    <div class="t-grid three-cols">
                        <div><span class="lbl">Catégorie d'évènement</span><span class="val">Informatique</span></div>
                        <div><span class="lbl">Ajouté par</span><span class="val">BDE MMI</span></div>
                        <div><span class="lbl">Localisation</span><span class="val">Entrepôt - Zone A</span></div>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="dot green"></div>
                    <div class="t-meta-top">
                        <div class="t-date">28 janvier 2025 - 14:30</div>
                        <span class="badge-action green">Ajout d'objet</span>
                    </div>

                    <h3 class="t-title">Fête de l'écologie</h3>
                    <p class="t-desc">Le BDE MMI a l'honneur d'organiser une fête de l'écologie </p>

                    <div class="t-grid three-cols">
                        <div><span class="lbl">Catégorie d'évènement</span><span class="val">Informatique</span></div>
                        <div><span class="lbl">Ajouté par</span><span class="val">BDE MMI</span></div>
                        <div><span class="lbl">Localisation</span><span class="val">Entrepôt - Zone A</span></div>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="dot green"></div>
                    <div class="t-meta-top">
                        <div class="t-date">28 janvier 2025 - 14:30</div>
                        <span class="badge-action green">Ajout d'objet</span>
                    </div>

                    <h3 class="t-title">Fête de l'écologie</h3>
                    <p class="t-desc">Le BDE MMI a l'honneur d'organiser une fête de l'écologie </p>

                    <div class="t-grid three-cols">
                        <div><span class="lbl">Catégorie d'évènement</span><span class="val">Informatique</span></div>
                        <div><span class="lbl">Ajouté par</span><span class="val">BDE MMI</span></div>
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