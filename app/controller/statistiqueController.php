<?php

class statistiqueController
{
    public function show()
    {
        // Vérification que l'utilisateur est connecté
        if(!isset($_SESSION['user_id'])){
            header('Location: index.php?action=connexion/show');
            exit;
        }

        // Récupération du rôle pour adapter l'affichage si besoin (simulé ici)
        $role = $_SESSION['user_role'] ?? 'visiteur';

        // Données simulées (à remplacer par des requêtes SQL via vos Models)
        // a possiblement faire : $stats = getStatistiquesGlobales();
        $stats = [
            'objets_collectes' => 1312,
            'taux_reutilisation' => 161, // %
            'economies' => '0.32', // k€ ou M€ selon l'échelle
            'co2_saved' => 18, // tonnes
            'nb_events' => 12,
            'nb_participants' => 340
        ];

        // Titre dynamique selon le rôle
        $pageTitle = "Statistiques de votre Département/Services";
        if($role == 1) $pageTitle = "Mes Statistiques Étudiant";
        if($role == 3) $pageTitle = "Statistiques Présidence";

        include $_ENV['BONUS_PATH']."app/view/statistiqueView.php";
    }
}