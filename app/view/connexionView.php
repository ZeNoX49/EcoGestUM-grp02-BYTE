<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Connexion - Le Mans Université</title>
    <link rel="stylesheet" href="../../assets/css/style-Sign.css">
</head>
<body>
    <div class="container">
        <div class="form-section">
            <img src="../../assets/image/LogoLeMans.png" alt="Le Mans Université" class="logo">
            <form method="post" action="index.php?actione=connexion/connect">
                <input type="text" name="mail" placeholder="Adresse mail" required>
                <input type="password" name="mdp" placeholder="Mot de passe" required>
                <button type="submit">Se Connecter</button>
                <button type="button" class="buttonSignIn" onclick="window.location='index.php?action=SignIn/show'">S'inscrire</button>
            </form>
        </div>
        <div class="image-section">
            <img src="../../assets/image/backgroundImageConnexion.png" alt="Campus" class="campus-img">
        </div>
    </div>
</body>
</html>
