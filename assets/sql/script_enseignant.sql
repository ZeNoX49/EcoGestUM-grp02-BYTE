USE sae;

-- ===========================================================
-- VUES
-- ===========================================================

/* ------ ENSEIGNANT ------ */

-- -- Requete 4 : Voir mes objets donnes (exemple pour id_utilisateur = 2)
-- CREATE VIEW mes_objets_donnes AS
-- SELECT
--     nom_objet,
--     description_objet,
--     date_ajout_objet
-- FROM OBJET
-- WHERE id_utilisateur = 2;

-- -- Requete 5 : Voir les reservations de mes objets
-- CREATE VIEW reservations_de_mes_objets AS
-- SELECT
--     u.nom_utilisateur,
--     u.prenom_utilisateur,
--     o.nom_objet,
--     r.date_reservation
-- FROM RESERVER r
-- JOIN OBJET o ON r.id_objet = o.id_objet
-- JOIN UTILISATEUR u ON r.id_utilisateur = u.id_utilisateur
-- WHERE o.id_utilisateur = 2;


-- -- Requete 6 : Voir tous les objets par etat
-- CREATE VIEW objets_par_etat AS
-- SELECT
--     e.nom_etat,
--     COUNT(o.id_objet) AS nombre
-- FROM ETAT e
-- LEFT JOIN OBJET o ON e.id_etat = o.id_etat
-- WHERE o.id_utilisateur = 2
-- GROUP BY e.nom_etat;

-- ===========================================================
-- PROCEDURES STOCKeES
-- ===========================================================

-- Procedure 4 : Ajouter un objet
-- DROP PROCEDURE IF EXISTS enseignant_ajouter_objet;
CREATE PROCEDURE enseignant_ajouter_objet(
    IN p_nom VARCHAR(100),
    IN p_description VARCHAR(250),
    IN p_id_categorie INT,
    IN p_id_etat INT,
    IN p_id_utilisateur INT
)
BEGIN
    INSERT INTO OBJET (
        nom_objet,
        description_objet,
        date_ajout_objet,
        id_utilisateur,
        id_statut_disponibilite,
        id_etat,
        id_categorie
    )
    VALUES (
        p_nom,
        p_description,
        NOW(),
        p_id_utilisateur,
        1,
        p_id_etat,
        p_id_categorie
    );
END;

-- Procedure 5 : Modifier un objet
-- DROP PROCEDURE IF EXISTS enseignant_modifier_objet;
CREATE PROCEDURE enseignant_modifier_objet(
    IN p_id_objet INT,
    IN p_description VARCHAR(250),
    IN p_id_etat INT
)
BEGIN
UPDATE OBJET
SET
    description_objet = p_description,
    id_etat = p_id_etat
WHERE id_objet = p_id_objet;
END;

-- Procedure 6 : Creer un evenement
-- DROP PROCEDURE IF EXISTS enseignant_creer_evenement;
CREATE PROCEDURE enseignant_creer_evenement(
    IN p_titre VARCHAR(100),
    IN p_type VARCHAR(100),
    IN p_description VARCHAR(250),
    IN p_date_debut DATETIME,
    IN p_date_fin DATETIME,
    IN p_id_type_evenement INT,
    IN p_id_utilisateur INT
)
BEGIN
INSERT INTO EVENEMENT (
    titre_evenement,
    type_evenement,
    description_evenement,
    date_debut_evenement,
    date_fin_evenement,
    id_type_evenement,
    id_utilisateur
)
VALUES (
    p_titre,
    p_type,
    p_description,
    p_date_debut,
    p_date_fin,
    p_id_type_evenement,
    p_id_utilisateur
);
END;