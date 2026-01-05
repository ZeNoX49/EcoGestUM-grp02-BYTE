<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href=<?php echo $_ENV['BONUS_PATH']."assets/css/style-catalogue.css" ?>>
    <title><?= isset($objet) ? htmlspecialchars($objet['nom_objet']) : 'Détail Objet' ?></title>
</head>
<body>
<?php include $_ENV['BONUS_PATH'].'assets/html/header.html'; ?>

<div class="main-detail">
    <div class="back-to-catalogue">
        <a href="index.php?action=catalogue/show">Retour au catalogue</a>
    </div>

    <?php if(isset($objet) && $objet): ?>

        <?php
        $imgSrc = !empty($objet['image_objet']) ? $_ENV['BONUS_PATH'].'assets/image/uploads/'.$objet['image_objet'] : $_ENV['BONUS_PATH'].'assets/image/logo.svg';
        if(strpos($objet['image_objet'], 'http') === 0) { $imgSrc = $objet['image_objet']; }

        $isAvailable = ($objet['id_statut_disponibilite'] == 1);
        $tagColor = $isAvailable ? '#8BC34A' : '#DB4C3B';
        $tagText = $objet['nom_statut_disponibilite'] ?? 'Indisponible';
        ?>

        <div class="breadcrumb">
            <a href="index.php">Accueil</a> /
            <a href="index.php?action=catalogue/show">Catalogue</a> /
            <?= htmlspecialchars($objet['nom_categorie']) ?> /
            <?= htmlspecialchars($objet['nom_objet']) ?>
        </div>

        <div class="detail-wrapper">
            <div class="left-column">
                <div class="image-section">
                    <div class="image-display" style="width: 100%;">
                        <div class="main-image-box" style="display:block; background-image: url('<?= htmlspecialchars($imgSrc) ?>'); background-size: contain; background-repeat: no-repeat;"></div>
                    </div>
                </div>

                <div class="detailed-info">
                    <h4>Informations clés</h4>
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="label">Catégorie</span>
                            <span class="value"><?= htmlspecialchars($objet['nom_categorie']) ?></span>
                        </div>
                        <div class="info-item">
                            <span class="label">État</span>
                            <span class="value"><?= htmlspecialchars($objet['nom_etat']) ?></span>
                        </div>
                        <div class="info-item">
                            <span class="label">Date d'ajout</span>
                            <span class="value"><?= date('d/m/Y', strtotime($objet['date_ajout_objet'])) ?></span>
                        </div>
                        <div class="info-item">
                            <span class="label">Propriétaire</span>
                            <span class="value"><?= htmlspecialchars($objet['prenom_utilisateur'] . ' ' . $objet['nom_utilisateur']) ?></span>
                        </div>
                        <div class="info-item">
                            <span class="label">Contact</span>
                            <span class="value" style="font-size: 12px;"><?= htmlspecialchars($objet['email_utilisateur']) ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="right-column">

                <span class="dispo-tag" style="background-color: <?= $tagColor ?>;"><?= $tagText ?></span>

                <h1><?= htmlspecialchars($objet['nom_objet']) ?></h1>

                <div class="main-attributes">
                    <div class="attribute-item">
                        <span class="label">Localisation</span>
                        <span class="value">
                                <i class="fa-solid fa-location-dot"></i> <?= htmlspecialchars($objet['nom_point_collecte']) ?>
                            </span>
                    </div>
                    <div class="attribute-item">
                        <span class="label">Adresse</span>
                        <span class="value" style="font-size: 13px; font-weight: 500;">
                                <?= htmlspecialchars($objet['adresse_point_collecte']) ?>
                            </span>
                    </div>
                    <div class="attribute-item">
                        <span class="label">Quantité disponible</span>
                        <span class="value"><?= htmlspecialchars($objet['quantite']) ?> unité(s)</span>
                    </div>
                </div>

                <div class="description-box">
                    <h2>Description</h2>
                    <p>
                        <?= nl2br(htmlspecialchars($objet['description_objet'])) ?>
                    </p>
                </div>

                <div class="action-buttons">
                    <?php if($isAvailable): ?>
                        <?php if(isset($_SESSION['user_id'])): ?>
                            <a href="index.php?action=detaille/reserver&id=<?= $objet['id_objet'] ?>" class="btn-reserve" onclick="return confirm('Confirmer la réservation de cet objet ?');">
                                Réserver cet objet
                            </a>
                        <?php else: ?>
                            <a href="index.php?action=connexion/show" class="btn-reserve" style="background-color: #999;">
                                Connectez-vous pour réserver
                            </a>
                        <?php endif; ?>
                    <?php else: ?>
                        <button class="btn-reserve" disabled style="background-color: #ccc; cursor: not-allowed;">
                            Déjà réservé / Indisponible
                        </button>
                    <?php endif; ?>

                    <a href="index.php?action=map/show&id=<?= $objet['id_objet'] ?>" class="btn-map">
                        Voir sur la carte
                    </a>
                    <a href="mailto:<?= $objet['email_utilisateur'] ?>?subject=EcoGestUM - Intérêt pour : <?= urlencode($objet['nom_objet']) ?>" class="btn-contact">
                        Contacter
                    </a>
                </div>

            </div>
        </div>

    <?php else: ?>
        <div style="text-align: center; padding: 50px; background: white; border-radius: 20px;">
            <h2>Objet introuvable</h2>
            <p>Cet objet n'existe pas ou a été supprimé.</p>
            <a href="index.php?action=catalogue/show" style="color: #DB4C3B; text-decoration: underline;">Retour au catalogue</a>
        </div>
    <?php endif; ?>
</div>

<?php include $_ENV['BONUS_PATH'].'assets/html/footer.html'; ?>
</body>
</html>