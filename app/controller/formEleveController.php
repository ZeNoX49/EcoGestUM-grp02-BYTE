<?php
require_once $_ENV['BONUS_PATH']."app/model/objetModel.php";
require_once $_ENV['BONUS_PATH']."app/model/categorieModel.php";
require_once $_ENV['BONUS_PATH']."app/model/pointCollecteModel.php";

class formEleveController
{
    public function show()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?action=connexion/show');
            exit();
        }

        $categories = getAllCategories();
        $pointsCollecte = getAllPointCollecte();

        include $_ENV['BONUS_PATH'] . "app/view/formEleveView.php";
    }

    public function submit()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_SESSION['user_id'])) {
                header('Location: index.php?action=connexion/show');
                exit();
            }

            // Récupération des champs
            $nom = $_POST['nom_objet'];
            $desc = $_POST['description_objet'];

            // Ajout de la date de dispo dans la description si renseignée
            if (!empty($_POST['date_dispo'])) {
                $desc .= "\n\n[Disponibilité : " . $_POST['date_dispo'] . "]";
            }

            $categorie = $_POST['id_categorie'];
            $etat = $_POST['id_etat'] ?? 3;
            $quantite = $_POST['quantite'] ?? 1;

            // Gestion du lieu
            $nomLieu = trim($_POST['nom_point_collecte']);
            $id_point_collecte = getIdPointCollecteByName($nomLieu);
            if ($id_point_collecte) {
                $idPointCollecte = $id_point_collecte[0]["id_point_collecte"];
            } else {
                if(!createPointCollecte($nomLieu)) {
                    echo "une erreur a lieu<br>";
                    exit;
                }

                $idPointCollecte = getIdPointCollecteByName($nomLieu);
            }

            $date = date('Y-m-d H:i:s');
            $typeEchange = 3;
            $user = $_SESSION['user_id'];
            $statut = 1;

            if(!insert_object($nom, $desc, $date, $idPointCollecte, $typeEchange, $user, $etat, $categorie, $quantite, $statut)) {
                echo "Erreur lors de l'insertion.";
                exit;
            }

            if (isset($_FILES['photos_objet'])) {
                $uploadDir = $_ENV['BONUS_PATH'].'assets/image/uploads/';
                if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

                $idObj = getObjectId($nom, $desc, $date)[0]["id_objet"];

                // Parcourir les fichiers correctement
                foreach ($_FILES['photos_objet']['tmp_name'] as $index => $tmpName) {
                    if ($_FILES['photos_objet']['error'][$index] === 0) {
                        // Récupère l'extension
                        $extension = pathinfo($_FILES['photos_objet']['name'][$index], PATHINFO_EXTENSION);
                        $finalName = $idObj."_".($index+1).".".$extension;
                        move_uploaded_file($tmpName, $uploadDir . $finalName);
                    }
                }
            }

            header('Location: index.php?action=catalogueEleve/show');
        }
    }
}