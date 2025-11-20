<?php

require_once "app/model/utilisateurModel.php";
function create_database() {
    function execute($sqlFile) {
        $bdd = get_bdd();
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if (!file_exists($sqlFile)) {
            echo "❌ Fichier SQL introuvable : $sqlFile<br>";
            return false;
        }

        $sql = file_get_contents($sqlFile);

        if (!$sql || trim($sql) === "") {
            echo "❌ Le fichier SQL est vide : $sqlFile<br>";
            return false;
        }

        try {
            $bdd->exec($sql);
            echo "✔️ Script exécuté : $sqlFile<br>";
            return true;
        } catch (PDOException $e) {
            echo "❌ Erreur SQL dans $sqlFile : " . $e->getMessage() . "<br>";
            return false;
        }
    }

    function createUser($fname, $mail, $id_role) {
        if(insertUser("test", $fname, $mail, "test", $id_role)) {
            echo "✔️ Utilisateur $fname créer avec succès<br>";
        } else {
            echo "❌ L'tilisateur $fname n'as pu être créer<br>";
        }
    }

    if (!execute('assets/sql/script_creation.sql')) return;
    if (!execute('assets/sql/script_insertion.sql')) return;

    createUser("etudiant", "test.etudiant.etu@univ-lemans.fr", 1);
    createUser("enseignant", "test.enseignant@univ-lemans.fr", 2);
    createUser("presidence", "test.presidence@univ-lemans.fr", 3);

    execute('assets/sql/script_enseignant.sql');
    execute('assets/sql/script_etudiant.sql');
    execute('assets/sql/script_presidence.sql');
}

create_database();