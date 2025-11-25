<?php
require_once $_ENV['BONUS_PATH']."app/model/utilisateurModel.php";

class profilController
{
    public function show()
    {
        // Vérification de connexion
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?action=connexion/show');
            exit;
        }

        // Récupération des infos utilisateur
        $user = getUserById($_SESSION['user_id']);

        if (!$user) {
            session_destroy();
            header('Location: index.php?action=connexion/show');
            exit;
        }

        include $_ENV['BONUS_PATH']."app/view/profilView.php";
    }

    public function updateInfo()
    {
        if (!isset($_SESSION['user_id'])) header('Location: index.php');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = trim($_POST['nom']);
            $prenom = trim($_POST['prenom']);
            $email = trim($_POST['email']);

            if(updateUser($_SESSION['user_id'], $nom, $prenom, $email)) {
                $_SESSION['user_mail'] = $email;
                header('Location: index.php?action=profil/show&success=info');
            } else {
                header('Location: index.php?action=profil/show&error=update');
            }
        }
    }

    public function updatePassword()
    {
        if (!isset($_SESSION['user_id'])) header('Location: index.php');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $currentMdp = $_POST['current_mdp'];
            $newMdp = $_POST['new_mdp'];
            $confirmMdp = $_POST['confirm_mdp'];

            $user = getUserById($_SESSION['user_id']);

            if (password_verify($currentMdp, $user['mdp_utilisateur'])) {
                if ($newMdp === $confirmMdp) {
                    if(strlen($newMdp) >= 4) {
                        updateUserPassword($_SESSION['user_id'], $newMdp);
                        header('Location: index.php?action=profil/show&success=mdp');
                    } else {
                        header('Location: index.php?action=profil/show&error=short');
                    }
                } else {
                    header('Location: index.php?action=profil/show&error=match');
                }
            } else {
                header('Location: index.php?action=profil/show&error=current');
            }
        }
    }
}