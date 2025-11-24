<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href=<?php echo $_ENV['PATH']."assets/css/style-gestion.css" ?>>
    <title>Mes Objets</title>
</head>
<body>
    <?php include $_ENV['PATH'].'assets/html/header.html'; ?>
    <div class="gestion-wrapper">
        <div class="gestion-header-bar">
            <h1>Mes Objets</h1>
            <a href="index.php?action=gestion/show" class="back-icon">
                <i class="fa-solid fa-arrow-turn-up"></i>
            </a>
        </div>
        <div class="inner-content-wrapper">
            <p>Cette page affichera la liste de vos objets partagés.</p>
        </div>
    </div>
    <?php include $_ENV['PATH'].'assets/html/footer.html'; ?>
</body>
</html>
