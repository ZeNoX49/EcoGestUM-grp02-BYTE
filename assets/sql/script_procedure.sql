USE ECOGESTUM;

-- Procedure 1 : Reserver un objet
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

-- Procedure 4 : Ajouter un objet
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

-- Procedure 7 : Rapport mensuel
CREATE PROCEDURE presidence_rapport_mois(
    IN p_mois INT,
    IN p_annee INT
)
BEGIN
SELECT
    COUNT(*) AS objets_ajoutes,
    p_mois AS mois,
    p_annee AS annee
FROM objet
WHERE MONTH(date_ajout_objet) = p_mois
  AND YEAR(date_ajout_objet) = p_annee;
END;

-- Procedure 8 : Statistiques par departement
CREATE PROCEDURE presidence_stats_departement(
    IN p_id_departement INT
)
BEGIN
SELECT
    d.nom_depser,
    COUNT(DISTINCT u.id_utilisateur) AS nombre_utilisateurs,
    COUNT(DISTINCT o.id_objet) AS objets_donnes,
    COUNT(DISTINCT r.id_utilisateur) AS reservations
FROM depser d
         LEFT JOIN utilisateur u ON d.id_utilisateur = u.id_utilisateur
         LEFT JOIN objet o ON u.id_utilisateur = o.id_utilisateur
         LEFT JOIN reserver r ON u.id_utilisateur = r.id_utilisateur
WHERE d.id_depser = p_id_departement
GROUP BY d.nom_depser;
END;

-- Procedure 9 : Liste complete des objets
CREATE PROCEDURE presidence_liste_complete_objets()
BEGIN
SELECT
    o.id_objet,
    o.nom_objet,
    c.nom_categorie,
    e.nom_etat,
    s.nom_statut_disponibilite,
    u.nom_utilisateur AS donneur
FROM objet o
         JOIN categorie c ON o.id_categorie = c.id_categorie
         JOIN etat e ON o.id_etat = e.id_etat
         JOIN statutdisponible s ON o.id_statut_disponibilite = s.id_statut_disponibilite
         JOIN utilisateur u ON o.id_utilisateur = u.id_utilisateur
ORDER BY o.date_ajout_objet DESC;
END;