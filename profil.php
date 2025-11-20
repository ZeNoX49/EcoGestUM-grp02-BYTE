<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Koulen&family=Lexend:wght@100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Press+Start+2P&family=Roboto:ital,wght@0,100..900;1,100..900&family=Sour+Gummy:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Mon Profil</title>
</head>
<body>
    <?php include 'assets/html/header.html'; ?>
    <div class="main">
        <div class="profile-container">
            <h1>Mon Profil</h1>
            <div class="profile-info">
                <div class="profile-avatar">
                    <img src="assets/images/default-avatar.png" alt="Photo de profil">
                </div>
                <div class="profile-details">
                    <h2>Nom Prénom</h2>
                    <p><i class="fas fa-envelope"></i> email@example.com</p>
                    <p><i class="fas fa-phone"></i> +33 6 12 34 56 78</p>
                    <p><i class="fas fa-building"></i> Service/Département</p>
                    <a href="gestion-objets.php" class="btn-back">
                        <i class="fa-solid fa-arrow-left"></i> Retour
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php include 'assets/html/footer.html'; ?>
</body>
</html>
