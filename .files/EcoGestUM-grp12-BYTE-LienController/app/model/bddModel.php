<?php

function getDatabase(){
    $db_name = 'ECOGESTUM';
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $conn = new PDO("mysql:host=$hostname", $username, $password);
    $stmt = $conn->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$db_name'");
    if ($stmt->rowCount() == 0) {
        setup_database($conn);
    }
    return connectToDatabase();
}
function setup_database($conn){
    createDatabase($conn);
    insertData($conn);
    createObjet_disponible($conn);
    //setProcedure($conn);
}
function connectToDatabase(){
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $dbNames = 'ECOGESTUM';
//    try {
        $conn = new PDO("mysql:host=$hostname;dbname=$dbNames", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
//    } catch (PDOException $e){
//        error_log("Connection failed: " . $e->getMessage());
//        die('Impossible de se connecter au serveur MySQL');
//    }

}

function executionSQL($sqlFile, $conn = null){
    $sql = file_get_contents($sqlFile);
    if ($sql === false){
        die("Erreur lors de la lecture du fichier SQL");
    }
    $conn->exec($sql);
}
function createDatabase($conn){
    $sqlFile = __DIR__ . '/../../assets/sql/script_creation.sql';
    executionSQL($sqlFile, $conn);
}

function insertData($conn ){
    $sqlFile = __DIR__ . '/../../assets/sql/script_insertion.sql';
    executionSQL($sqlFile, $conn);
}

function setProcedure($conn){
    $sqlFileEnseignant = __DIR__ . '/../../assets/sql/script_enseignant.sql';
    $sqlFileEtudiant = __DIR__ . '/../../assets/sql/script_etudiant.sql';
    $sqlFilePresidence = __DIR__ . '/../../assets/sql/script_presidence.sql';
    executionSQL($sqlFileEnseignant, $conn);
    executionSQL($sqlFileEtudiant, $conn);
    executionSQL($sqlFilePresidence, $conn);
}

function createObjet_disponible($conn){
    $sql = "CREATE OR REPLACE VIEW objets_disponibles AS
                SELECT
                     o.id_objet,
                     o.nom_objet,
                     o.description_objet,
                     o.image_objet,
                     o.date_ajout_objet,
                     o.id_categorie,
                     p.nom_point_collecte,
                     p.adresse_point_collecte,
                     e.nom_etat,
                     u.nom_utilisateur
                FROM objet o
                JOIN statutdisponible s ON o.id_statut_disponibilite = s.id_statut_disponibilite
                JOIN POINTCOLLECTE p ON p.id_point_collecte = o.id_point_collecte
                JOIN ETAT e ON e.id_etat = o.id_etat
                JOIN UTILISATEUR u ON u.id_utilisateur = o.id_utilisateur
                WHERE s.nom_statut_disponibilite = 'Disponible';";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
}

function isUserExist($userId, $conn){
    $sql = "SELECT COUNT(*) FROM utilisateurs WHERE id_utilisateur = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$userId]);
    return $stmt->fetchColumn() > 0;
}

function isUserPasswordCorrect($userId, $password, $conn){
    $sql = "SELECT COUNT(*) FROM utilisateurs WHERE id_utilisateur = ? AND mot_de_passe = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$userId, $password]);
    return $stmt->fetchColumn() > 0;
}

function getUserType($userId, $conn){
    $sql = "SELECT type_utilisateur FROM utilisateurs WHERE id_utilisateur = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$userId]);
    return $stmt->fetchColumn();
}
function getNbObjPropUser($userId, $conn){
    $sql = "SELECT COUNT(*) FROM mes_objets_donnes";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$userId]);
    return $stmt->fetchColumn();
}

function getNbObjRecupUser($userId, $conn){
    $sql = "SELECT COUNT(*) FROM reservations_recues";
    $stmt = $conn->prepare($sql);
}

function createUser($nom,$prenom,$mail, $password, $role, $conn){
    $sql = "INSERT INTO utilisateur (nom_utilisateur,prenom_utilisateur,email_utilisateur, mdp_utilisateur, id_role) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$nom, $prenom,$mail, $password, $role]);
}

function getCatalogue($conn){
    $sql = "SELECT * FROM objets_disponibles";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}

function getObjet($id, $conn){
    if(!is_numeric($id))return null;
    if($id < 1)return null;
    $sql = "SELECT * FROM objets_disponibles 
JOIN CATEGORIE c ON c.id_categorie = objets_disponibles.id_categorie WHERE id_objet = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetch();
}
