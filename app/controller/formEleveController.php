<?php
require_once $_ENV['BONUS_PATH']."app/model/objetModel.php";
require_once $_ENV['BONUS_PATH']."app/model/categorieModel.php";

class formEleveController
{
    public function show()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?action=connexion/show');
            exit();
        }

        $categories = getAllCategories();
        $pointsCollecte = getAllLocations();

        include $_ENV['BONUS_PATH'] . "app/view/formEleveView.php";
    }

    public function submit()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_SESSION['user_id'])) {
                header('Location: index.php?action=connexion/show');
                exit();
            }

            // Gestion de l'upload d'image
            $nomImage = 'default.png';
            if (isset($_FILES['photos_objet']) && $_FILES['photos_objet']['error'][0] == 0) {
                $tmpName = $_FILES['photos_objet']['tmp_name'][0];
                $name = basename($_FILES['photos_objet']['name'][0]);
                $uploadDir = $_ENV['BONUS_PATH'].'assets/image/uploads/';

                if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
                $finalName = time() . "_" . $name;

                if (move_uploaded_file($tmpName, $uploadDir . $finalName)) {
                    $nomImage = $finalName;
                }
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
            $idPointCollecte = getIdPointCollecteByName($nomLieu);

            if (!$idPointCollecte) {
                $idPointCollecte = createPointCollecte($nomLieu);
            }

            $date = date('Y-m-d H:i:s');
            $typeEchange = 3;
            $user = $_SESSION['user_id'];
            $statut = 1;

            $result = insert_object($nomImage, $nom, $desc, $date, $idPointCollecte, $typeEchange, $user, $etat, $categorie, $quantite, $statut);

            if ($result) {
                header('Location: index.php?action=catalogueEleve/show');
                exit;
            } else {
                header('Location: index.php?action=formEleve/show&error=creation_failed');
                exit;
            }
        }
    }
}
?>