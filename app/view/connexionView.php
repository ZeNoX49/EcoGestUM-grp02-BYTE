<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Connexion - Le Mans Université</title>
    <link rel="stylesheet" href=<?php echo $_ENV['BONUS_PATH']."assets/css/style-sign.css" ?>>
</head>
<body>
<div class="container">
    <div class="form-section">
        <h2 style="color: red;">Ce site est un projet étudiant, ne pas mettre de vrais identifiants universitaires</h2>
        <img src=<?php echo $_ENV['BONUS_PATH']."assets/image/LogoLeMans.png" ?> alt="Le Mans Université" class="logo">
        <?php if (isset($_SESSION['error_message'])): ?>
            <div class="error-message">
                <?php
                echo $_SESSION['error_message'];
                unset($_SESSION['error_message']);
                ?>
            </div>
        <?php endif; ?>
        <form method="post" action="index.php?action=connexion/connect" method="post">
            <input type="text" name="mail" placeholder="Adresse mail" value="<?php echo isset($_SESSION['mail']) ? htmlspecialchars($_SESSION['mail']) : ''; ?>" required>
            <input type="password" name="mdp" placeholder="Mot de passe" required>
            <button type="submit">Se Connecter</button>
            <button type="button" class="buttonSignIn" onclick="window.location='index.php?action=signIn/show'">S'inscrire</button>
        </form>
    </div>
    <div class="image-section">
        <img src=<?php echo $_ENV['BONUS_PATH']."assets/image/backgroundImageConnexion.png" ?> alt="Campus" class="campus-img">
    </div>
</div>
</body>
</html>
