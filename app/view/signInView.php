<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscritpion - Le Mans Université</title>
<<<<<<< HEAD
    <link rel="stylesheet" href="assets/css/style-Sign.css">
=======
    <link rel="stylesheet" href="../../assets/css/style-Sign.css">
>>>>>>> LienController
</head>
<body>
    <div class="container">
        <div class="form-section">
            <img src="assets/image/LogoLeMans.png"
                 alt="Le Mans Université" class="logo">
            <form method="POST" action="index.php?action=signIn/signUp">
<<<<<<< HEAD
                <input type="text" name="prenom" placeholder="Prénom" required>
                <input type="text" name="nom" placeholder="Nom" required>
                <input type="password" name="mdp" placeholder="Mot de passe" required>
                <input type="password" name="confirmMdp" placeholder="Confirmation Mot de passe" required>
                <select name="role" required>
=======
                <input type="text" name = "nom" placeholder="Nom" required>
                <input type="text" name = "prenom" placeholder="Prénom" required>
                <input type="email" name = "mail" placeholder="Adresse mail" required>
                <input type="password" name = "mdp" placeholder="Mot de passe" required>
                <input type="password" name = "confirmMdp" placeholder="Confirmation Mot de passe" required>
                <select required>
>>>>>>> LienController
                    <option value="" disabled selected>Rôle demandé</option>
                    <option value="Etudiant">Etudiant</option>
                    <option value="Enseignant">Enseignant</option>
                    <option value="Présidence">Présidence</option>
                </select>
                <button type="submit">Se Connecter</button>
            </form>
        </div>
        <div class="image-section">
<<<<<<< HEAD
            <img src="assets/image/backgroundImageConnexion.png" alt="Campus" class="campus-img">
=======
            <img src="../../assets\image\backgroundImageConnexion.png" alt="Campus" class="campus-img">
>>>>>>> LienController
        </div>
    </div>
</body>
</html>
