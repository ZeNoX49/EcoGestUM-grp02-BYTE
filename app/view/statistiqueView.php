<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href=<?php echo $_ENV['BONUS_PATH']."assets/css/style-gestion.css" ?>>
    <link rel="stylesheet" href=<?php echo $_ENV['BONUS_PATH']."assets/css/style-statistique.css" ?>>

    <title>Statistiques</title>
</head>
<body>
<?php include $_ENV['BONUS_PATH'].'assets/html/header.html'; ?>

<div class="gestion-wrapper">

    <div class="stat-header-bar">
        <h1><?= $pageTitle ?></h1>
        <a href="index.php?action=gestion/show" class="back-icon-white">
            <i class="fa-solid fa-arrow-turn-up"></i>
        </a>
    </div>

    <div class="stat-content-wrapper">

        <div class="stat-cards-container">

            <div class="stat-card-box">
                <div class="stat-card-header">
                    <div class="icon-circle blue">
                        <i class="fa-solid fa-box-open"></i>
                    </div>
                    <span class="stat-label">Objets Collectés</span>
                </div>
                <div class="stat-card-body">
                    <span class="stat-value"><?= $stats['objets_collectes'] ?></span>
                </div>
            </div>

            <div class="stat-card-box">
                <div class="stat-card-header">
                    <div class="icon-circle green">
                        <i class="fa-solid fa-rotate"></i>
                    </div>
                    <span class="stat-label">Taux de réutilisation</span>
                </div>
                <div class="stat-card-body">
                    <span class="stat-value"><?= $stats['taux_reutilisation'] ?>%</span>
                </div>
            </div>

            <div class="stat-card-box">
                <div class="stat-card-header">
                    <div class="icon-circle dark-blue">
                        <i class="fa-solid fa-sack-dollar"></i>
                    </div>
                    <span class="stat-label">Économies réalisées</span>
                </div>
                <div class="stat-card-body">
                    <span class="stat-value"><?= $stats['economies'] ?>€</span>
                </div>
            </div>

        </div>

        <div class="impact-section">
            <div class="impact-info">
                <h3>Impact Écologique</h3>
                <div class="impact-main-number">
                    <span class="co2-tag">CO<sub>2</sub></span>
                    <span class="number">-<?= $stats['co2_saved'] ?> t</span>
                    <span class="unit">CO<sub>2</sub>/an</span>
                </div>
                <p class="subtext">Bilan carbone économisé grâce au réemploi</p>
            </div>

            <div class="impact-actions">
                <button class="btn-stat-action">Générer le rapport mensuel</button>
                <button class="btn-stat-action outline">Statistiques détaillées</button>
                <button class="btn-stat-action outline">Voir mes données</button>
            </div>
        </div>

    </div>
</div>

<?php include $_ENV['BONUS_PATH'].'assets/html/footer.html'; ?>
</body>
</html>