USE ECOGESTUM;

-- ===========================================================
-- VUES
-- ===========================================================

/* ------ ETUDIANT ------ */

-- Requete 1 : Voir les objets disponibles
CREATE OR REPLACE VIEW objets_disponibles AS
SELECT
    o.nom_objet,
    o.description_objet,
    o.image_objet,
    p.nom_point_collecte,
    p.adresse_point_collecte
FROM objet o
JOIN POINTCOLLECTE p ON p.id_point_collecte = o.id_point_collecte
WHERE o.id_statut_disponibilite = 0;

-- Requete 2 : Voir mes reservations (exemple pour utilisateur id=1)
CREATE OR REPLACE VIEW mes_reservations AS
SELECT
    o.nom_objet,
    r.date_reservation,
    sr.nom_statut_reservation
FROM reserver r
JOIN objet o ON r.id_objet = o.id_objet
JOIN statutreservation sr ON r.id_statut_reservation = sr.id_statut_reservation
WHERE r.id_utilisateur = 1;

-- Requete 3 : Voir les evenements a venir
CREATE OR REPLACE VIEW evenements_a_venir AS
SELECT
    titre_evenement,
    description_evenement,
    date_debut_evenement
FROM evenement
WHERE date_debut_evenement >= NOW();

-- ===========================================================
-- PROCEDURES STOCKeES
-- ===========================================================

-- Procedure 1 : Reserver un objet
DROP PROCEDURE IF EXISTS etudiant_reserver_objet;
DELIMITER $$

CREATE PROCEDURE etudiant_reserver_objet(
    IN p_id_utilisateur INT,
    IN p_id_objet INT
)
BEGIN
INSERT INTO reserver (id_objet, date_reservation, id_utilisateur, id_statut_reservation)
VALUES (p_id_objet, CURDATE(), p_id_utilisateur, 1);

UPDATE objet
SET id_statut_disponibilite = 2
WHERE id_objet = p_id_objet;
END $$

DELIMITER ;

-- Procedure 2 : Annuler ma reservation
DROP PROCEDURE IF EXISTS etudiant_annuler_reservation;
DELIMITER $$

CREATE PROCEDURE etudiant_annuler_reservation(
    IN p_id_utilisateur INT
)
BEGIN
    DECLARE v_id_objet INT;

SELECT id_objet INTO v_id_objet
FROM reserver
WHERE id_utilisateur = p_id_utilisateur
    LIMIT 1;

DELETE FROM reserver
WHERE id_utilisateur = p_id_utilisateur;

IF v_id_objet IS NOT NULL THEN
UPDATE objet
SET id_statut_disponibilite = 1
WHERE id_objet = v_id_objet;
END IF;
END $$

DELIMITER ;

-- Procedure 3 : Rechercher un objet par categorie
DROP PROCEDURE IF EXISTS etudiant_rechercher_par_categorie;
DELIMITER $$

CREATE PROCEDURE etudiant_rechercher_par_categorie(
    IN p_id_categorie INT
)
BEGIN
SELECT
    o.nom_objet,
    o.description_objet,
    s.nom_statut_disponibilite
FROM objet o
         JOIN statutdisponible s ON o.id_statut_disponibilite = s.id_statut_disponibilite
WHERE o.id_categorie = p_id_categorie;
END $$

DELIMITER ;