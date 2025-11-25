<?php
require_once "app/model/depserModel.php";
require_once "app/model/temoignageModel.php";
require_once "app/model/utilisateurModel.php";

class homePageController
{
    public function show()
    {
        $depser = getAllDepSer();
        $users = getUsers();

        $temoignages = getAllTemoignages();
        $temoignages_display = [];
        for($i = 0; $i <3; $i++) {
            // on prend un témoigange aléatoirement
            $key = array_rand($temoignages);
            $temoignage = $temoignages[$key];
            $user = $users[$temoignage["id_utilisateur"]];

            // on le supprime de la liste
            unset($temoignages[$key]);
            $temoignages = array_values($temoignages);

            // on le prépare pour le display
            $temoignages_display[$i]["temoignage"] = $temoignage["contenu_temoignage"];
            $temoignages_display[$i]["auteur"] = $user["prenom_utilisateur"]." ".$user["nom_utilisateur"];
            $role = "";
            switch ($user["id_role"]) {
                case 1:
                    $formation = strtolower(str_replace("Departement ", "", $depser[$user["id_depser"]]["nom_depser"]));
                    $role = "Etudiant en ".$formation;
                    break;
                case 2:
                    $role = "Directeur/directrice du ".$depser[$user["id_depser"]]["nom_depser"];
                    break;
                case 3:
                    $role = "Présidence de l'université";
                    break;
            }
            $temoignages_display[$i]["role"] = $role;
        }
        var_dump($temoignages_display);

        include $_ENV['BONUS_PATH'].'app/view/homePageView.php';
    }
}