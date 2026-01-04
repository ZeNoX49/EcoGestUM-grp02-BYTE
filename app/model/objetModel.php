<?php

require_once $_ENV['BONUS_PATH']."app/model/bddModel.php";

function insert_object($image, $name, $description, $date, $id_collect_point, $id_trade_type, $id_user, $id_etat, $id_category, $quantite) {
    $bdd = get_bdd();
    $stmt = $bdd->prepare("INSERT INTO OBJET (image_objet, nom_objet, description_objet, date_ajout_objet, id_point_collecte, id_type_echange, id_utilisateur, id_statut_disponibilite, id_etat, id_categorie, quantite) 
                          VALUES (:image_objet, :nom_objet, :description_objet, :date_ajout_objet, :id_point_collecte, :id_type_echange, :id_utilisateur, 1, :id_etat, :id_categorie, :quantite)");

    return $stmt->execute([
        ':image_objet' => $image,
        ':nom_objet' => $name,
        ':description_objet' => $description,
        ':date_ajout_objet' => $date,
        ':id_point_collecte' => $id_collect_point,
        ':id_type_echange' => $id_trade_type,
        ':id_utilisateur' => $id_user,
        ':id_etat' => $id_etat,
        ':id_categorie' => $id_category,
        ':quantite' => $quantite
    ]);
}

function getObject($id_object) {
    // ... (code existant inchangé) ...
    $bdd = get_bdd();
    $sql = "SELECT * FROM OBJET o
        JOIN CATEGORIE c ON c.id_categorie = o.id_categorie 
        JOIN ETAT e ON e.id_etat = o.id_etat
        JOIN POINTCOLLECTE p ON p.id_point_collecte = o.id_point_collecte
        JOIN UTILISATEUR u ON u.id_utilisateur = o.id_utilisateur
         WHERE id_objet = ?";
    
    
    $stmt = $bdd->prepare($sql);
    $stmt->execute([$id_object]);
    return $stmt->fetch();
}
function getAllFilteredObjects($search = '', $catId = null, $etatNom = null, $location = '', $statutDisponible = null) {
    $bdd = get_bdd();
    $sql = "SELECT * FROM allObject WHERE 1=1";
    $params = [];
    if (!empty($search)) {
        $sql .= " AND (nom_objet LIKE :search OR description_objet LIKE :search)";
        $params[':search'] = "%$search%";
    }
    if (!empty($catId)) {
        $sql .= " AND id_categorie = :cat";
        $params[':cat'] = $catId;
    }
    if (!empty($etatNom)) {
        $sql .= " AND nom_etat = :etat";
        $params[':etat'] = $etatNom;
    }
    if (!empty($location)) {
        $sql .= " AND (nom_point_collecte LIKE :loc OR adresse_point_collecte LIKE :loc)";
        $params[':loc'] = "%$location%";
    }
    if(!empty($statutDisponible)){
        $sql .= " AND nom_statut_disponibilite = :statut";
        $params[':statut'] = $statutDisponible;
    }
    $stmt = $bdd->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getFilteredObjects($search = '', $catId = null, $etatNom = null, $location = '') {
    $bdd = get_bdd();
    $sql = "SELECT * FROM objets_disponibles WHERE 1=1";
    $params = [];
    if (!empty($search)) {
        $sql .= " AND (nom_objet LIKE :search OR description_objet LIKE :search)";
        $params[':search'] = "%$search%";
    }
    if (!empty($catId)) {
        $sql .= " AND id_categorie = :cat";
        $params[':cat'] = $catId;
    }
    if (!empty($etatNom)) {
        $sql .= " AND nom_etat = :etat";
        $params[':etat'] = $etatNom;
    }
    if (!empty($location)) {
        $sql .= " AND (nom_point_collecte LIKE :loc OR adresse_point_collecte LIKE :loc)";
        $params[':loc'] = "%$location%";
    }
    $stmt = $bdd->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getAllEtats() {
    $bdd = get_bdd();
    $req = $bdd->query("SELECT * FROM ETAT");
    return $req->fetchAll(PDO::FETCH_ASSOC);
}

function getAllLocations() {
    $bdd = get_bdd();
    $req = $bdd->query("SELECT * FROM POINTCOLLECTE ORDER BY nom_point_collecte");
    return $req->fetchAll(PDO::FETCH_ASSOC);
}

function getIdPointCollecteByName($nom) {
    $bdd = get_bdd();
    $stmt = $bdd->prepare("SELECT id_point_collecte FROM POINTCOLLECTE WHERE nom_point_collecte LIKE ?");
    $stmt->execute([$nom]);
    return $stmt->fetchColumn();
}

function createPointCollecte($nom) {
    $bdd = get_bdd();
    $stmt = $bdd->prepare("INSERT INTO POINTCOLLECTE (nom_point_collecte, adresse_point_collecte) VALUES (?, ?)");
    $stmt->execute([$nom, "Adresse non spécifiée"]);
    return $bdd->lastInsertId();
}
function getObjectUtilisateur($id_utilisateur) {
    $bdd = get_bdd();
    $sql = "SELECT * FROM OBJET o
        JOIN CATEGORIE c ON c.id_categorie = o.id_categorie
        JOIN ETAT e ON e.id_etat = o.id_etat
        JOIN POINTCOLLECTE p ON p.id_point_collecte = o.id_point_collecte
         JOIN STATUTDISPONIBLE s ON s.id_statut_disponibilite = o.id_statut_disponibilite
         WHERE o.id_utilisateur = ?";
    $stmt = $bdd->prepare($sql);
    $stmt->execute([$id_utilisateur]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getAllObject(){
    $bdd = get_bdd();
    $req = $bdd->query("SELECT * FROM OBJET o
        JOIN CATEGORIE c ON c.id_categorie = o.id_categorie
        JOIN ETAT e ON e.id_etat = o.id_etat
        JOIN POINTCOLLECTE p ON p.id_point_collecte = o.id_point_collecte
         JOIN STATUTDISPONIBLE s ON s.id_statut_disponibilite = o.id_statut_disponibilite
         JOIN UTILISATEUR u ON u.id_utilisateur = o.id_utilisateur
         LEFT JOIN RESERVER r ON r.id_objet = o.id_objet");
    $req->execute();
    return $req->fetchAll(PDO::FETCH_ASSOC);
}

function countObjectStatus($objets, $id_status) {
    $count = 0;
    if (is_array($objets)) {
        foreach($objets as $objet) {
            if(isset($objet['id_statut_disponibilite']) && $objet['id_statut_disponibilite'] == $id_status) {
                $count++;
            }
        }
    }
    return $count;
}

function countObjectReserve($objets, $id_status) {
    $count = 0;
    if (is_array($objets)) {
        foreach($objets as $objet) {
            if(isset($objet['id_statut_disponibilite']) && $objet['id_statut_disponibilite'] == $id_status) {
                $count++;
            }
        }
    }
    return $count;
}

function deleteObject($id_objet){
    $bdd = get_bdd();
    $stmt = $bdd->prepare("DELETE FROM OBJET WHERE id_objet = :id");
    return $stmt->execute([':id' => $id_objet]);
}


function updateObject($id, $nom = null, $desc = null, $idPoint = null, $idEtat = null, $idCat = null, $quantite = null, $image = null)
{
    $bdd = get_bdd();
    
    $fields = [];
    $params = [':id' => $id];
    
    if ($nom !== null) {
        $fields[] = "nom_objet = :nom";
        $params[':nom'] = $nom;
    }
    if ($desc !== null) {
        $fields[] = "description_objet = :desc";
        $params[':desc'] = $desc;
    }
    if ($idPoint !== null) {
        $fields[] = "id_point_collecte = :idPoint";
        $params[':idPoint'] = $idPoint;
    }
    if ($idEtat !== null) {
        $fields[] = "id_etat = :idEtat";
        $params[':idEtat'] = $idEtat;
    }
    if ($idCat !== null) {
        $fields[] = "id_categorie = :idCat";
        $params[':idCat'] = $idCat;
    }
    if ($quantite !== null) {
        $fields[] = "quantite = :qte";
        $params[':qte'] = $quantite;
    }
    if ($image !== null) {
        $fields[] = "image_objet = :img";
        $params[':img'] = $image;
    }
    
    if (empty($fields)) {
        return false;
    }
    
    $sql = "UPDATE OBJET SET " . implode(", ", $fields) . " WHERE id_objet = :id";
    
    $stmt = $bdd->prepare($sql);
    return $stmt->execute($params);
}

function getNewObjectForReservation(): array
{
    $bdd = get_bdd();
    $sql = "SELECT o.*, u.nom_utilisateur, u.prenom_utilisateur, s.nom_statut_disponibilite,  pc.nom_point_collecte, pc.adresse_point_collecte, d.nom_depser AS nom_departement FROM OBJET o
            JOIN UTILISATEUR u ON o.id_utilisateur = u.id_utilisateur
            JOIN DEPSER d ON d.id_depser = u.id_depser
            JOIN STATUTDISPONIBLE s ON s.id_statut_disponibilite = o.id_statut_disponibilite
            JOIN POINTCOLLECTE pc on pc.id_point_collecte = o.id_point_collecte
            WHERE s.id_statut_disponibilite = 1";
    $stmt = $bdd->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function refuserObject($id){
    $bdd = get_bdd();
    $sql = "UPDATE OBJET SET id_statut_disponibilite = 4 WHERE id_objet = :id";
    $stmt = $bdd->prepare($sql);
    $stmt->execute([':id' => $id]);
    return $stmt->execute();
}

function accepterObject($id){
    $bdd = get_bdd();
    $sql = "UPDATE OBJET SET id_statut_disponibilite = 2 WHERE id_objet = :id";
    $stmt = $bdd->prepare($sql);
    $stmt->execute([':id' => $id]);
}

function getObjectDisponible(){
    $bdd = get_bdd();
    $sql = "SELECT o.*, u.nom_utilisateur, u.prenom_utilisateur, s.nom_statut_disponibilite,  pc.nom_point_collecte, pc.adresse_point_collecte, d.nom_depser AS nom_departement FROM OBJET o
            JOIN UTILISATEUR u ON o.id_utilisateur = u.id_utilisateur
            JOIN DEPSER d ON d.id_depser = u.id_depser
            JOIN STATUTDISPONIBLE s ON s.id_statut_disponibilite = o.id_statut_disponibilite
            JOIN POINTCOLLECTE pc on pc.id_point_collecte = o.id_point_collecte
            WHERE s.id_statut_disponibilite = 2 OR s.id_statut_disponibilite = 3";
    $stmt = $bdd->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getObjectIndiponible(){
    $bdd = get_bdd();
    $sql = "SELECT o.*, u.nom_utilisateur, u.prenom_utilisateur, s.nom_statut_disponibilite,  pc.nom_point_collecte, pc.adresse_point_collecte, d.nom_depser AS nom_departement FROM OBJET o
            JOIN UTILISATEUR u ON o.id_utilisateur = u.id_utilisateur
            JOIN DEPSER d ON d.id_depser = u.id_depser
            JOIN STATUTDISPONIBLE s ON s.id_statut_disponibilite = o.id_statut_disponibilite
            JOIN POINTCOLLECTE pc on pc.id_point_collecte = o.id_point_collecte
            WHERE s.id_statut_disponibilite = 4";
    $stmt = $bdd->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


// function getNbObjPropUser($id_user) {
//     $bdd = get_bdd();
//     $query = $bdd->query("SELECT COUNT(*) FROM mes_objets_donnes $id_user");
//     $objects = $query->fetchAll(PDO::FETCH_ASSOC);
//     return $objects;
// }

// function getNbObjRecupUser($id_user) {
//     $bdd = get_bdd();
//     $query = $bdd->query("SELECT COUNT(*) FROM reservations_recues $id_user");
//     $objects = $query->fetchAll(PDO::FETCH_ASSOC);
//     return $objects;
// }

