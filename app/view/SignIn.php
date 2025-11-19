<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscritpion - Le Mans Université</title>
    <link rel="stylesheet" href="../../assets/css/style-Sign.css">
</head>
<body>
    <div class="container">
        <div class="form-section">
            <img src="../../assets\image\LogoLeMans.png"
                 alt="Le Mans Université" class="logo">
            <form>
                <input type="text" placeholder="Nom" required>
                <input type="text" placeholder="Prénom" required>
                <input type="email" placeholder="Adresse mail" required>
                <input type="password" placeholder="Mot de passe" required>
                <input type="password" placeholder="Confirmation Mot de passe" required>
                <select required>
                    <option value="" disabled selected>Rôle demandé</option>
                    <option value="Etudiant">Etudiant</option>
                    <option value="Enseignant">Enseignant</option>
                    <option value="Présidence">Présidence</option>
                </select>
                <button type="submit">Se Connecter</button>
            </form>
        </div>
        <div class="image-section">
            <img src="../../assets\image\backgroundImageConnexion.png" alt="Campus" class="campus-img">
        </div>
    </div>
</body>
</html>
