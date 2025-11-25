<?php
require_once $_ENV['BONUS_PATH']."app/model/roleModel.php";
require_once $_ENV['BONUS_PATH']."app/model/depserModel.php";
require_once $_ENV['BONUS_PATH']."app/model/utilisateurModel.php";

class signInController {

    // La méthode show accepte un message d'erreur optionnel
    public function show($error = null) {
        $roles = getAllRoles();
        $depsers = getAllDepSer();

        $error_message = $error;

        include $_ENV['BONUS_PATH']."app/view/signInView.php";
    }

    public function signUp() {
        //Vérification correspondance mot de passe
        if($_POST['mdp'] !== $_POST['confirmMdp']) {
            $this->show("Les mots de passe ne correspondent pas.");
            return;
        }

        //Création de l'adresse mail
        // Nettoyage des entrées (minuscules, sans espaces)
        $prenom = strtolower(trim($_POST['prenom']));
        $nom = strtolower(trim($_POST['nom']));

        // Retrait des accents pour l'email
        $accents = ['é','è','ê','ë','à','â','ä','ô','ö','ù','û','ü','ï','î','ç'];
        $sansAccents = ['e','e','e','e','a','a','a','o','o','u','u','u','i','i','c'];
        $prenom = str_replace($accents, $sansAccents, $prenom);
        $nom = str_replace($accents, $sansAccents, $nom);

        $addEtu = "";
        $roles = getAllRoles();
        foreach($roles as $r) {
            // On compare l'ID envoyé par le formulaire avec ceux de la BDD
            if($r['id_role'] == $_POST['role']) {
                if(stripos($r['nom_role'], 'etudiant') !== false) {
                    $addEtu = ".etu";
                }
                break;
            }
        }

        $mail = $prenom.".".$nom.$addEtu."@univ-lemans.fr";

        //Vérification existence utilisateur
        if(isUserExisting($mail)) {
            $this->show("Un compte existe déjà avec l'adresse : $mail");
            return;
        }

        $id_role = $_POST['role'];
        $id_depser = $_POST['depser'];

        //Création du compte
        if(insertUser($_POST['prenom'], $_POST['nom'], $mail, $_POST['mdp'], $id_role, $id_depser)) {
            // Succès : on démarre la session si besoin pour passer le mail à la page de connexion
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['mail'] = $mail; // Pour pré-remplir le champ login

            header('Location: index.php?action=connexion/show');
            exit();
        } else {
            $this->show("Erreur technique lors de la création du compte.");
            return;
        }
    }
}