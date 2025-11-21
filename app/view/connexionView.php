<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Connexion - Le Mans Université</title>
    <link rel="stylesheet" href="/ecogestum-grp12-byte/assets/css/style-Sign.css">
</head>
<body>
    <div class="container">
        <div class="form-section">
            <img src="/ecogestum-grp12-byte/assets/image/LogoLeMans.png" alt="Le Mans Université" class="logo">
            <form method="post" action="/ecogestum-grp12-byte/Connexion/connect" method="post">
                <input type="text" name="mail" placeholder="Adresse mail" required>
                <input type="password" name="mdp" placeholder="Mot de passe" required>
                <button type="submit">Se Connecter</button>
                <button type="button" class="buttonSignIn" onclick="window.location='index.php?action=SignIn/show'">S'inscrire</button>
            </form>
        </div>
        <div class="image-section">
             <img src="/ecogestum-grp12-byte/assets/image/backgroundImageConnexion.png" alt="Campus" class="campus-img">
        </div>
    </div>
</body>
</html>
