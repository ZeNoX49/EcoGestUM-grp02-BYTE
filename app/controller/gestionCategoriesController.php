<?php
require_once $_ENV['BONUS_PATH']."app/model/categorieModel.php";

class GestionCategoriesController
{
    public function show()
    {
        $categories = getAllCategories();

        foreach ($categories as &$cat) {
            $cat['nb_objets'] = countObjetsParCategorie($cat['id_categorie']);
        }
        unset($cat);

        include $_ENV['BONUS_PATH']."app/view/gestionCategoriesView.php";
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom_categorie'];
            $desc = $_POST['description_categorie'];
            $icone = $_POST['icone_categorie'] ?? 'fa-solid fa-box';
            $statut = $_POST['statut_categorie'] ?? 'Active';

            insertCategory($nom, $desc, $icone, $statut);
        }
        header('Location: index.php?action=gestionCategories/show');
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id_categorie'];
            $nom = $_POST['nom_categorie'];
            $desc = $_POST['description_categorie'];
            $icone = $_POST['icone_categorie'];
            // Récupération du statut
            $statut = $_POST['statut_categorie'];

            updateCategory($id, $nom, $desc, $icone, $statut);
        }
        header('Location: /ecogestum-grp12-byte/gestionCategories/show');
    }

    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_categorie'])) {
            deleteCategory($_POST['id_categorie']);
        }
        header('Location: /ecogestum-grp12-byte/gestionCategories/show');
    }
}
?>