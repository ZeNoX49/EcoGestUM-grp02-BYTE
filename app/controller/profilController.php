<?php

require_once "app/model/utilisateurModel.php";
require_once "app/model/categorieModel.php";
require_once "app/model/typeEvenementModel.php";
require_once "app/model/pointCollecteModel.php";
require_once "app/model/choixNotificationModel.php";

class profilController
{
    public function show()
    {
        // Utilisateur
        $user = getUser($_SESSION['user_id']);

        // Objet - categorie
        $objet_categories = getAllCategories();
        $objet_categories_possible = getAllCategories();
        $notif_obj_cat = getChoixNotification($_SESSION['user_id'], "objets", "categorie");
        foreach($notif_obj_cat as $obj_cat) {
            $objet_categories_possible = array_diff($objet_categories_possible, [$objet_categories[$obj_cat["id_choix"]]["nom_categorie"]]);
        }

        // Objet - localisation
        $objet_position = getAllPointCollecte();
        $objet_position_possible = getAllPointCollecte();
        $notif_obj_loc = getChoixNotification($_SESSION['user_id'], "objets", "categorie");
        foreach($notif_obj_loc as $obj_loc) {
            $objet_position_possible = array_diff($objet_position_possible, [$objet_position[$obj_cat["id_choix"]]["nom_categorie"]]);
        }

        // Evenement - categorie
        $event_categories = getAllCategories();
        $event_categories_possible = getAllCategories();
        $notif_event_cat = getChoixNotification($_SESSION['user_id'], "events", "categorie");
        foreach($notif_event_cat as $event_cat) {
            $event_categories_possible = array_diff($event_categories_possible, [$event_categories[$obj_cat["id_choix"]]["nom_categorie"]]);
        }

        // Evenement - organisateur
        $event_organisateur = getEventUsers();
        $event_organisateur_possible = getEventUsers();
        $notif_event_org = getChoixNotification($_SESSION['user_id'], "events", "categorie");
        foreach($notif_event_org as $event_org) {
            $event_organisateur_possible = array_diff($event_organisateur_possible, [$event_organisateur[$obj_cat["id_choix"]]["nom_categorie"]]);
        }

        // Evenement - localisation
        $event_localisation = getAllPointCollecte();
        $event_localisation_possible = getAllPointCollecte();
        $notif_event_loc = getChoixNotification($_SESSION['user_id'], "events", "categorie");
        foreach($notif_event_loc as $event_loc) {
            $event_localisation_possible = array_diff($event_localisation_possible, [$event_localisation[$obj_cat["id_choix"]]["nom_categorie"]]);
        }

        include $_ENV['BONUS_PATH']."app/view/profilView.php";
    }
}