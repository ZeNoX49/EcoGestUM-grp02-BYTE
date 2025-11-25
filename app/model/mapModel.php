<?php

require_once "bddModel.php";

function getObjetsDisponibles() {
    $bdd = get_bdd();

    $objets_a_afficher = [];

    if (isset($bdd)) {
        if (isset($_GET['id'])) {
            $sql = "SELECT * FROM objets_disponibles WHERE id_objet = ?";
            $req = $bdd->prepare($sql);
            $req->execute([$_GET['id']]);
        }
        else
        {
            $req = $bdd->query("SELECT * FROM objets_disponibles");
        }
        $objets_a_afficher = $req->fetchAll(PDO::FETCH_ASSOC);
    }

    return $objets_a_afficher;
}

