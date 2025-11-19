<?php

require "bddModel.php";

function createAllView() {
    $bdd = get_bdd();
    view_objets_disponibles($bdd);
}

function view_objets_disponibles($bdd) {
    $sql = "CREATE OR REPLACE VIEW objets_disponibles AS
                SELECT
                     o.nom_objet,
                     o.description_objet,
                     o.image_objet,
                     p.nom_point_collecte,
                     p.adresse_point_collecte
                FROM OBJET o
                JOIN POINTCOLLECTE p ON p.id_point_collecte = o.id_point_collecte
                WHERE o.id_statut_disponibilite = 0;";
    $query = $bdd->query($sql);
    $objects = $query->fetchAll(PDO::FETCH_ASSOC);
    return $objects;
}