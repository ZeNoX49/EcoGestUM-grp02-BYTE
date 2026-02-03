<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription - Le Mans Université</title>
    <link rel="stylesheet" href=<?php echo $_ENV['BONUS_PATH']."assets/css/style-sign.css" ?>>
</head>
<body>
<div class="container">
    <div class="form-section">
        <h2 style="color: red;">Ce site est un projet étudiant, ne pas mettre de vrais identifiants universitaires</h2>

        <img src=<?php echo $_ENV['BONUS_PATH']."assets/image/LogoLeMans.png" ?> alt="Le Mans Université" class="logo">
        <h1>Inscription</h1>

        <?php if (isset($error_message)): ?>
            <div class="error-message">
                <?php echo htmlspecialchars($error_message); ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="index.php?action=signIn/signUp">
            <input type="text" name="prenom" placeholder="Prénom" value="<?php echo isset($_POST['prenom']) ? htmlspecialchars($_POST['prenom']) : ''; ?>" required>
            <input type="text" name="nom" placeholder="Nom" value="<?php echo isset($_POST['nom']) ? htmlspecialchars($_POST['nom']) : ''; ?>" required>

            <select name="role" required>
                <option value="" disabled <?php echo !isset($_POST['role']) ? 'selected' : ''; ?>>Rôle demandé</option>
                <?php if(isset($roles)): foreach($roles as $role): ?>
                    <option value="<?= $role['id_role'] ?>" <?php echo (isset($_POST['role']) && $_POST['role'] == $role['id_role']) ? 'selected' : ''; ?>>
                        <?= htmlspecialchars(ucfirst($role['nom_role'])) ?>
                    </option>
                <?php endforeach; endif; ?>
            </select>

            <select name="depser" required>
                <option value="" disabled <?php echo !isset($_POST['depser']) ? 'selected' : ''; ?>>Département / Service</option>
                <?php if(isset($depsers)): foreach($depsers as $dep): ?>
                    <option value="<?= $dep['id_depser'] ?>" <?php echo (isset($_POST['depser']) && $_POST['depser'] == $dep['id_depser']) ? 'selected' : ''; ?>>
                        <?= htmlspecialchars($dep['nom_depser']) ?>
                    </option>
                <?php endforeach; endif; ?>
            </select>

            <input type="password" name="mdp" placeholder="Mot de passe" required>
            <input type="password" name="confirmMdp" placeholder="Confirmation Mot de passe" required>

            <button type="submit">S'inscrire</button>

            <button type="button" class="buttonSignIn" onclick="window.location='index.php?action=connexion/show'">Déjà un compte ? Se connecter</button>
        </form>
    </div>
    <div class="image-section">
        <img src=<?php echo $_ENV['BONUS_PATH']."assets/image/backgroundImageConnexion.png" ?> alt="Campus" class="campus-img">
    </div>
</div>
</body>
</html>