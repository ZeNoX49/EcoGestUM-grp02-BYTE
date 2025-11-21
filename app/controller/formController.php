<?php

require_once "app/model/objetModel.php";
require_once "app/model/categorieModel.php";

class formController
{
    public function show()
    {
        $categories = getAllCategories();
        $pointsCollecte = getAllLocations();

        include "app/view/formView.php";
    }

    public function submit()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nomImage = 'default.png';
            if (isset($_FILES['photos_objet']) && $_FILES['photos_objet']['error'][0] == 0) {
                $tmpName = $_FILES['photos_objet']['tmp_name'][0];
                $name = basename($_FILES['photos_objet']['name'][0]);
                $uploadDir = 'assets/image/uploads/';

                if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
                $finalName = time() . "_" . $name;

                if (move_uploaded_file($tmpName, $uploadDir . $finalName)) {
                    $nomImage = $finalName;
                }
            }

            $nom = $_POST['nom_objet'];
            $desc = $_POST['description_objet'];
            $categorie = $_POST['id_categorie'];
            $etat = $_POST['id_etat'];
            $quantite = isset($_POST['quantite']) ? $_POST['quantite'] : 1;
            $nomLieu = trim($_POST['nom_point_collecte']);

            $idPointCollecte = getIdPointCollecteByName($nomLieu);

            if (!$idPointCollecte) {
                $idPointCollecte = createPointCollecte($nomLieu);
            }

            $date = date('Y-m-d H:i:s');
            $typeEchange = 1;
            $user = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 1;

            $result = insert_object($nomImage, $nom, $desc, $date, $idPointCollecte, $typeEchange, $user, $etat, $categorie, $quantite);

            if ($result) {
                header('Location: index.php?action=objetPropose/show');
                exit;
            } else {
                echo "Erreur lors de l'insertion.";
            }
        }
    }
}
