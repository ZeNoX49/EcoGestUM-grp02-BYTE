<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Première Connexion - Le Mans Université</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="form-section">
            <img src="https://upload.wikimedia.org/wikipedia/fr/6/6e/Logo_Le_Mans_Universit%C3%A9_-_2020.png"
                 alt="Le Mans Université" class="logo">
            <h1>Le Mans Université</h1>
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
                    <option value="Personnel">Personnel</option>
                </select>
                <button type="submit">Se Connecter</button>
            </form>
        </div>
        <div class="image-section">
            <img src="image.jpg" alt="Campus" class="campus-img">
        </div>
    </div>
</body>
</html>
