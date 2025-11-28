<?php

require_once $_ENV['BONUS_PATH']."app/model/bddModel.php";

function insert_object($name, $description, $date, $id_collect_point, $id_trade_type, $id_user, $id_etat, $id_category, $quantite, $statut = 3) {
    $sql = "INSERT INTO OBJET (nom_objet, description_objet, date_ajout_objet, id_point_collecte, id_type_echange, id_utilisateur, id_statut_disponibilite, id_etat, id_categorie, quantite)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $params = [$name, $description, $date, $id_collect_point, $id_trade_type, $id_user, $statut, $id_etat, $id_category, $quantite];
    return insert($sql, $params);
}

function getObject($id_object) {
    $sql = "SELECT * FROM OBJET o
            JOIN CATEGORIE c ON c.id_categorie = o.id_categorie
            JOIN ETAT e ON e.id_etat = o.id_etat
            JOIN POINTCOLLECTE p ON p.id_point_collecte = o.id_point_collecte
            JOIN UTILISATEUR u ON u.id_utilisateur = o.id_utilisateur
            WHERE id_objet = ?";
    $params = [$id_object];
    return get($sql, $params);
}

function getObjectId($name, $description, $date) {
    $sql = "SELECT id_objet FROM OBJET
            WHERE nom_objet LIKE ? AND 
            description_objet LIKE ? AND 
            date_ajout_objet LIKE ?";
    $params = [$name, $description, $date];
    return get($sql, $params);
}

function getAllFilteredObjects($search = '', $catId = null, $etatNom = null, $location = '', $statut = null) {
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
    if (!empty($statut)) {
        $sql .= " AND id_statut_disponibilite = :statut";
        $params[':statut'] = $statut;
    }
    $stmt = $bdd->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getFilteredObjects($search = '', $catId = null, $etatNom = null, $location = '') {
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
    return get($sql, $params);
}

function getObjectUtilisateur($id_utilisateur) {
    $sql = "SELECT * FROM OBJET o
            JOIN CATEGORIE c ON c.id_categorie = o.id_categorie
            JOIN ETAT e ON e.id_etat = o.id_etat
            JOIN POINTCOLLECTE p ON p.id_point_collecte = o.id_point_collecte
            JOIN STATUTDISPONIBLE s ON s.id_statut_disponibilite = o.id_statut_disponibilite
            WHERE o.id_utilisateur = ?";
    $params = [$id_utilisateur];
    return get($sql, $params);
}

function getAllObject(){
    $sql = "SELECT * FROM OBJET o
            JOIN CATEGORIE c ON c.id_categorie = o.id_categorie
            JOIN ETAT e ON e.id_etat = o.id_etat
            JOIN POINTCOLLECTE p ON p.id_point_collecte = o.id_point_collecte
            JOIN STATUTDISPONIBLE s ON s.id_statut_disponibilite = o.id_statut_disponibilite
            JOIN UTILISATEUR u ON u.id_utilisateur = o.id_utilisateur";
            //LEFT JOIN RESERVER r ON r.id_objet = o.id_objet
    return get($sql);
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
    $sql = "DELETE FROM OBJET WHERE id_objet = ?";
    $params = [$id_objet];
    return delete($sql, $params);
}

function updateObject($id, $nom, $desc, $idPoint, $idEtat, $idCat, $quantite) {
    $sql = "UPDATE OBJET SET
            nom_objet = ?,
            description_objet = ?,
            id_point_collecte = ?,
            id_etat = ?,
            id_categorie = ?,
            quantite = ?,
            WHERE id_objet = ?";
    $params = [$nom, $desc, $idPoint, $idEtat, $idCat, $quantite, $id];
    return update($sql, $params);
}

function getStudentExchangeObjects($limit = null, $offset = 0) {
    $bdd = get_bdd();
    $sql = "SELECT o.*, c.nom_categorie, pc.nom_point_collecte, u.email_utilisateur, u.nom_utilisateur, u.prenom_utilisateur
            FROM OBJET o
            JOIN CATEGORIE c ON o.id_categorie = c.id_categorie
            LEFT JOIN POINTCOLLECTE pc ON o.id_point_collecte = pc.id_point_collecte
            JOIN UTILISATEUR u ON o.id_utilisateur = u.id_utilisateur
            WHERE o.id_type_echange = 3 AND o.id_statut_disponibilite = 1
            ORDER BY o.date_ajout_objet DESC";

    if ($limit !== null) {
        $sql .= " LIMIT :limit OFFSET :offset";
        $stmt = $bdd->prepare($sql);
        $stmt->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    $req = $bdd->query($sql);
    return $req->fetchAll(PDO::FETCH_ASSOC);
}

function countStudentExchangeObjects() {
    $bdd = get_bdd();
    $sql = "SELECT COUNT(*) FROM OBJET WHERE id_type_echange = 3 AND id_statut_disponibilite = 1";
    $req = $bdd->query($sql);
    return $req->fetchColumn();
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

function getObjectImage($id_objet) {
    $uploadDir = $_ENV['BONUS_PATH'].'assets/image/uploads/';
    $files = scandir($uploadDir);
    foreach ($files as $file) {
        if ((string)explode("_", $file)[0] === (string)$id_objet) {
            return $uploadDir.$file;
        }
    }
    return null;
}

function getAllObjectImage($id_objet) {
    $uploadDir = $_ENV['BONUS_PATH'].'assets/image/uploads/';
    $files = scandir($uploadDir);
    $images = [];
    foreach ($files as $file) {
        if ((string)explode("_", $file)[0] === (string)$id_objet) {
            $images[] = $uploadDir.$file;
        }
    }
    return $images;
}