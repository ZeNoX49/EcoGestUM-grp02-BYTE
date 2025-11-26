<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href=<?php echo $_ENV['BONUS_PATH']."assets/css/style-gestion.css" ?>>
    <title>Gestion des Objets</title>
</head>
<body>
<?php include $_ENV['BONUS_PATH'].'assets/html/header.html'; ?>
<div class="gestion-wrapper">

    <div class="gestion-header-bar">
        <h1>Gestion des Objets</h1>
        <a href="index.php?action=homePage/show" class="back-icon">
            <i class="fa-solid fa-arrow-turn-up"></i>
        </a>
    </div>

    <div class="gestion-grid">

        <a href="index.php?action=form/show" class="gestion-card">
            <div class="card-icon-wrapper">
                <i class="fa-solid fa-pen-to-square"></i>
            </div>
            <div class="card-text-content">
                <h3>Proposer un Objet</h3>
                <p>Formulaire simplifié pour ajouter un nouvel objet à la plateforme de partage</p>
            </div>
        </a>

        <a href="index.php?action=objetPropose/show" class="gestion-card">
            <div class="card-icon-wrapper">
                <i class="fa-solid fa-box-open"></i>
            </div>
            <div class="card-text-content">
                <h3>Mes Objets Proposés</h3>
                <p>Consultez et gérez tous les objets que vous avez mis à disposition</p>
            </div>
        </a>

        <a href="index.php?action=mesReservations/show" class="gestion-card">
            <div class="card-icon-wrapper">
                <i class="fa-regular fa-calendar-check"></i>
            </div>
            <div class="card-text-content">
                <h3>Mes Réservations</h3>
                <p>Suivez l'état de vos demandes de réservation et objets empruntés</p>
            </div>
        </a>

        <a href="index.php?action=gestionCategories/show" class="gestion-card" style="display:  <?= (isset($role) && $role == 3)?'':'none' ?>">
            <div class="card-icon-wrapper">
                <i class="fa-solid fa-tags"></i>
            </div>
            <div class="card-text-content">
                <h3>Gestion des catégories</h3>
                <p>Créez et modifiez les catégories pour adapter le classement des objets recyclables aux besoins de votre service</p>
            </div>
        </a>
        <a href="index.php?action=gestionDemande/show" class="gestion-card" style="display:  <?= (isset($role) && $role == 3)?'':'none' ?>">
            <div class="card-icon-wrapper">
                <i class="fa-solid fa-square-check"></i>
            </div>
            <div class="card-text-content">
                <h3>Gérer les demandes</h3>
                <p>Consultez, approuvez ou refusez les demandes de réservation en attente</p>
            </div>
        </a>

        <a href="index.php?action=inventaire/show" class="gestion-card" style="display:  <?= (isset($role) && $role == 3)?'':'none' ?>">
            <div class="card-icon-wrapper">
                <i class="fa-solid fa-boxes-stacked"></i>
            </div>
            <div class="card-text-content">
                <h3>Inventaire</h3>
                <p>Visualisez l'ensemble des objets de la plateforme avec leur disponibilité et emplacement</p>
            </div>
        </a>

        <a href="index.php?action=historique/show" class="gestion-card"  style="display:  <?= (isset($role) && $role == 3)?'':'none' ?>">
            <div class="card-icon-wrapper">
                <i class="fa-solid fa-file-lines"></i>
            </div>
            <div class="card-text-content">
                <h3>Historique des opérations</h3>
                <p>Retrouvez le suivi complet de toutes les réservations et transactions d'objets</p>
            </div>
        </a>

    </div>
</div>
<?php include $_ENV['BONUS_PATH'].'assets/html/footer.html'; ?>
</body>
</html>