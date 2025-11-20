<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Connexion - Le Mans Université</title>
    <link rel="stylesheet" href="/EcoGestUM-grp12-BYTE/assets/css/style-Sign.css">
</head>
<body>
    <div class="container">
        <div class="form-section">
            <img src="/EcoGestUM-grp12-BYTE/assets/image/LogoLeMans.png" alt="Le Mans Université" class="logo">
            <form action="index.php?action=Connexion/connect" method="post">
                <input type="text" placeholder="Indentifiant" required>
                <input type="password" placeholder="Mot de passe" required>
                <button type="submit">Se Connecter</button>
                <button type="button" class="buttonSignIn" onclick="window.location='index.php?action=SignIn/show'">S'inscrire</button>
            </form>
        </div>
        <div class="image-section">
            <img src="/EcoGestUM-grp12-BYTE/assets/image/backgroundImageConnexion.png" alt="Campus" class="campus-img">
        </div>
    </div>
</body>
</html>
