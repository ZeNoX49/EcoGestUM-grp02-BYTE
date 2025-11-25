<?php
require_once "app/model/temoignageModel.php";
require_once "app/model/utilisateurModel.php";

class homePageController
{
    public function show()
    {
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
            $temoignages_display[$i]["role"] = $role;
        }
        var_dump($temoignages_display);

        include $_ENV['BONUS_PATH'].'app/view/homePageView.php';
    }
}