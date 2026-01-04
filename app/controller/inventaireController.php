<?php
require_once $_ENV['BONUS_PATH']."app/model/objetModel.php";
require_once $_ENV['BONUS_PATH']."app/model/categorieModel.php";
require_once $_ENV['BONUS_PATH']."app/model/statutDisponibleModel.php";

class inventaireController
{
    public function show()
    {
        if(!isset($_SESSION['user_role'])){
            header('Location: index.php?action=connexion/show');
        }
        $search = isset($_GET['search']) ? trim($_GET['search']) : '';
        $category = isset($_GET['categorie']) ? $_GET['categorie'] : null;
        $etat = isset($_GET['etat']) ? $_GET['etat'] : null;
        $location = isset($_GET['location']) ? trim($_GET['location']) : '';
        $statut = isset($_GET['statut']) ? $_GET['statut'] : null;
        $objets = getAllFilteredObjects($search, $category, $etat, $location, $statut);
        $nbObjetsDisponibles = countObjectStatus($objets, 2);
        $nbObjetsReserve = countObjectStatus($objets, 3);
        $nbObjetsEnAttente = countObjectStatus($objets, 1);
        $nbObjetsRefusee = countObjectReserve($objets, 4);
        $categoriesList = getAllCategories();
        $statutList = getAllStatutDisponible();
        $correspStyleStatutDisponible = ['En attente' =>'badge-blue', 'Disponible' => 'badge-green', 'Indisponible'=>'status-refused', 'Reserve' => 'badge-yellow'];
        
        
        
        
        include $_ENV['BONUS_PATH']."app/view/inventaireView.php";
    }
    
    function edit(){
        if(isset($_GET['idEdit'])){
            $name = isset($_GET['name']) ? $_GET['name'] : null;
            $quantitie = isset($_GET['quantitie']) ? $_GET['quantitie'] : null;
            updateObject($_GET['idEdit'], $name, null, null, null, null, $quantitie);
        }
        header('Location: index.php?action=inventaire/show');
        
    }
    
    function export(){
        $filename = "inventaire_" . date('Y-m-d') . ".csv";
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        $output = fopen('php://output', 'w');
        
        // BOM pour qu'Excel lise correctement les accents (UTF-8)
        fputs($output, "\xEF\xBB\xBF");
        
        // En-têtes des colonnes
        fputcsv($output, ['ID', 'Nom Objet', 'Statut', 'Quantité', 'Localisation', 'Responsable', 'Catégorie']);
        
        
        $search = isset($_GET['search']) ? trim($_GET['search']) : '';
        $category = isset($_GET['categorie']) ? $_GET['categorie'] : null;
        $etat = isset($_GET['etat']) ? $_GET['etat'] : null;
        $location = isset($_GET['location']) ? trim($_GET['location']) : '';
        $statut = isset($_GET['statut']) ? $_GET['statut'] : null;
        // Données
        $objetsFiltered = getAllFilteredObjects($search, $category, $etat, $location, $statut);
        
        foreach ($objetsFiltered as $row) {
            fputcsv($output, [
                $row['id_objet'] ?? '',
                $row['nom_objet'],
                $row['nom_statut_disponibilite'],
                $row['quantite'],
                $row['nom_point_collecte'],
                $row['nom_utilisateur'],
                $row['nom_categorie']
            ]);
        }
        
        fclose($output);
        exit();
    }
}