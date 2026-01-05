<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?php echo $_ENV['BONUS_PATH']."assets/css/style-catalogue.css" ?>">
    <link rel="stylesheet" href="<?php echo $_ENV['BONUS_PATH']."assets/css/style-gestion.css" ?>">
    <link rel="stylesheet" href="<?php echo $_ENV['BONUS_PATH']."assets/css/style-catalogue-eleve.css" ?>">
    <title>Échanges étudiants</title>
</head>
<body>
<?php include $_ENV['BONUS_PATH'].'assets/html/header.html'; ?>

<div class="main">

    <div class="student-catalogue-container">

        <div class="banner-student">
            <h1>Échanges étudiants</h1>

            <div class="banner-actions">
                <a href="index.php?action=formEleve/show" class="btn-propose">
                    Proposer un échange
                </a>

                <a href="index.php?action=gestion/show" class="back-icon" title="Retour">
                    <i class="fa-solid fa-arrow-turn-up"></i>
                </a>
            </div>
        </div>

        <div class="search-barre" style="margin: 0 auto 30px auto; padding-top: 0; width: 100%;">
            <form action="index.php" method="GET" class="search-form">
                <input type="hidden" name="action" value="catalogueEleve/show">

                <div class="search-input-container">
                    <button type="submit" style="border:none; background:none; cursor:pointer;">
                        <img src="<?php echo $_ENV['BONUS_PATH']."assets/image/search.svg" ?>" alt="Recherche" class="search-icon">
                    </button>
                    <input type="text" name="search" placeholder="Rechercher un objet..." class="search-input" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                </div>

                <button type="button" class="action-btn" style="border:none;">Filtrer</button>
                <button type="button" class="action-btn" style="border:none;">Trier</button>
            </form>
        </div>

        <div class="student-grid">

            <?php if(isset($objets) && !empty($objets)): ?>
                <?php foreach($objets as $objet): ?>
                    <?php
                    // Gestion de l'image
                    $imgSrc = !empty($objet['image_objet']) ? $_ENV['BONUS_PATH'].'assets/image/uploads/'.$objet['image_objet'] : 'https://via.placeholder.com/150x200?text=Livre';
                    if(strpos($objet['image_objet'], 'http') === 0) { $imgSrc = $objet['image_objet']; }
                    ?>

                    <div class="student-card">
                        <div class="card-img-header">
                            <img src="<?= htmlspecialchars($imgSrc) ?>" alt="<?= htmlspecialchars($objet['nom_objet']) ?>">
                        </div>

                        <h3 class="st-card-title"><?= htmlspecialchars($objet['nom_objet']) ?></h3>

                        <div class="st-info-row">
                            <strong>Catégorie :</strong>
                            <span><?= htmlspecialchars($objet['nom_categorie']) ?></span>
                        </div>
                        <div class="st-info-row">
                            <strong>Localisation :</strong>
                            <span><?= htmlspecialchars($objet['nom_point_collecte']) ?></span>
                        </div>
                        <div class="st-info-row">
                            <strong>Publication :</strong>
                            <span><?= date('d/m/Y', strtotime($objet['date_ajout_objet'])) ?></span>
                        </div>

                        <p class="st-desc">
                            <?= htmlspecialchars($objet['description_objet']) ?>
                        </p>

                        <div class="st-actions">
                            <button class="btn-st-contact" onclick="window.location.href='mailto:<?= $objet['email_utilisateur'] ?>'">Contacter</button>
                            <button class="btn-st-reserve" onclick="window.location.href='index.php?action=detaille/show&id=<?= $objet['id_objet'] ?>'">Réserver</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <?php for($i=0; $i<6; $i++): ?>
                    <div class="student-card">
                        <div class="card-img-header">
                            <img src="https://img.icons8.com/color/96/book.png" alt="Livre">
                        </div>

                        <h3 class="st-card-title">Livre: Algorithmique et structures de données</h3>

                        <div class="st-info-row">
                            <strong>Catégorie :</strong>
                            <span>Livres</span>
                        </div>
                        <div class="st-info-row">
                            <strong>Localisation :</strong>
                            <span>Le Mans</span>
                        </div>
                        <div class="st-info-row">
                            <strong>Publication :</strong>
                            <span>22/10/2025</span>
                        </div>

                        <p class="st-desc">
                            Manuel utilisé en première année, en bon état avec quelques annotations au crayon.
                        </p>

                        <div class="st-actions">
                            <button class="btn-st-contact">Contacter</button>
                            <button class="btn-st-reserve">Réserver</button>
                        </div>
                    </div>
                <?php endfor; ?>
            <?php endif; ?>

        </div>

        <?php if ($totalPages > 1): ?>
            <div class="custom-pagination">

                <?php if ($page > 1): ?>
                    <a href="index.php?action=catalogueEleve/show&page=<?= $page - 1 ?>" class="page-btn">&lt; Précédent</a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="index.php?action=catalogueEleve/show&page=<?= $i ?>" class="page-btn <?= ($i == $page) ? 'active' : '' ?>">
                        <?= $i ?>
                    </a>
                <?php endfor; ?>

                <?php if ($page < $totalPages): ?>
                    <a href="index.php?action=catalogueEleve/show&page=<?= $page + 1 ?>" class="page-btn">Suivant &gt;</a>
                <?php endif; ?>

            </div>
        <?php endif; ?>

    </div>
</div>

<?php include $_ENV['BONUS_PATH'].'assets/html/footer.html'; ?>
</body>
</html>