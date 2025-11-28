<?php

require_once $_ENV['BONUS_PATH']."app/model/objetModel.php";
require_once $_ENV['BONUS_PATH']."app/model/categorieModel.php";
require_once $_ENV['BONUS_PATH']."app/model/pointCollecteModel.php";

class formController
{
    public function show()
    {
        $categories = getAllCategories();
        $pointsCollecte = getAllPointCollecte();

        include $_ENV['BONUS_PATH']."app/view/formView.php";
    }

    public function submit()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom_objet'];
            $desc = $_POST['description_objet'];
            $categorie = $_POST['id_categorie'];
            $etat = $_POST['id_etat'];
            $quantite = $_POST['quantite'] ?? 1;
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
            $typeEchange = 1;
            $user = $_SESSION['user_id'] ?? 1;
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

            header('Location: index.php?action=objetPropose/show');
        }
    }
}
