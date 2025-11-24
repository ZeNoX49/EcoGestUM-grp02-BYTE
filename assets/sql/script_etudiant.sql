USE sae;

-- ===========================================================
-- VUES
-- ===========================================================

/* ------ ETUDIANT ------ */

-- Requete 1 : Voir les objets disponibles
CREATE VIEW objets_disponibles AS
SELECT o.id_objet,
       o.nom_objet,
       o.description_objet,
       o.image_objet,
       o.date_ajout_objet,
       o.id_categorie,
       p.nom_point_collecte,
       p.adresse_point_collecte,
       p.latitude,
       p.longitude,
       e.nom_etat,
       u.nom_utilisateur
    FROM OBJET o
         JOIN POINTCOLLECTE p ON p.id_point_collecte = o.id_point_collecte
         JOIN ETAT e ON e.id_etat = o.id_etat
         JOIN UTILISATEUR u ON u.id_utilisateur = o.id_utilisateur
WHERE o.id_statut_disponibilite = 1;

-- Requete 2 : Voir mes reservations (exemple pour utilisateur id=1)
CREATE VIEW mes_reservations AS
SELECT o.nom_objet,
       r.date_reservation,
       sr.nom_statut_reservation
FROM RESERVER r
         JOIN OBJET o ON r.id_objet = o.id_objet
         JOIN STATUTRESERVATION sr ON r.id_statut_reservation = sr.id_statut_reservation
WHERE r.id_utilisateur = 1;

-- Requete 3 : Voir les evenements a venir
CREATE VIEW evenements_a_venir AS
SELECT titre_evenement,
       description_evenement,
       date_debut_evenement
FROM EVENEMENT
WHERE date_debut_evenement >= NOW();

-- ===========================================================
-- PROCEDURES STOCKeES
-- ===========================================================

-- Procedure 1 : Reserver un objet
-- DROP PROCEDURE IF EXISTS etudiant_reserver_objet;
CREATE PROCEDURE etudiant_reserver_objet(
    IN p_id_utilisateur INT,
    IN p_id_objet INT
)
BEGIN
INSERT INTO RESERVER (id_objet, date_reservation, id_utilisateur, id_statut_reservation)
VALUES (p_id_objet, CURDATE(), p_id_utilisateur, 1);

UPDATE OBJET
SET id_statut_disponibilite = 2
WHERE id_objet = p_id_objet;
END;

-- Procedure 2 : Annuler ma reservation
-- DROP PROCEDURE IF EXISTS etudiant_annuler_reservation;
CREATE PROCEDURE etudiant_annuler_reservation(
    IN p_id_utilisateur INT
)
BEGIN
    DECLARE
v_id_objet INT;

SELECT id_objet
INTO v_id_objet
FROM RESERVER
WHERE id_utilisateur = p_id_utilisateur LIMIT 1;

DELETE
FROM RESERVER
WHERE id_utilisateur = p_id_utilisateur;

IF
v_id_objet IS NOT NULL THEN
UPDATE OBJET
SET id_statut_disponibilite = 1
WHERE id_objet = v_id_objet;
END IF;
END;

-- Procedure 3 : Rechercher un objet par categorie
-- DROP PROCEDURE IF EXISTS etudiant_rechercher_par_categorie;
CREATE PROCEDURE etudiant_rechercher_par_categorie(
    IN p_id_categorie INT
)
BEGIN
SELECT o.nom_objet,
       o.description_objet,
       s.nom_statut_disponibilite
FROM OBJET o
         JOIN STATUTDISPONIBLE s ON o.id_statut_disponibilite = s.id_statut_disponibilite
WHERE o.id_categorie = p_id_categorie;
END;