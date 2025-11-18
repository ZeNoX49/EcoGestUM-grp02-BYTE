USE SAE3;
GO

/* ------ Presidence ------ */

-- Requete 7 : Statistiques par categorie
CREATE OR ALTER VIEW statistiques_par_categorie AS
SELECT c.nom_categorie, COUNT(o.id_objet) AS nombre_objets
FROM CATEGORIE c
LEFT JOIN OBJET o ON c.id_categorie = o.id_categorie
GROUP BY c.nom_categorie;
GO

-- Requete 8 : Nombre d'utilisateurs par departement
CREATE OR ALTER VIEW utilisateurs_par_role AS
SELECT r.nom_role, COUNT(u.id_utilisateur) AS nombre_utilisateurs
FROM ROLE r
LEFT JOIN UTILISATEUR u ON r.id_role = u.id_role
GROUP BY r.nom_role;
GO

-- Requete 9 : Vue globale des reservations
CREATE OR ALTER VIEW vue_reservations AS
SELECT sr.nom_statut_reservation, COUNT(*) AS nombre
FROM RESERVER r
JOIN STATUTRESERVATION sr ON r.id_statut_reservation = sr.id_statut_reservation
GROUP BY sr.nom_statut_reservation;
GO

-- Procedure 7 : Rapport mensuel
CREATE OR ALTER PROCEDURE presidence_rapport_mois
    @p_mois INT,
    @p_annee INT
AS
BEGIN
    SELECT 
        COUNT(*) AS objets_ajoutes,
        @p_mois AS mois,
        @p_annee AS annee
    FROM OBJET
    WHERE MONTH(CAST(date_ajout_objet AS DATETIME)) = @p_mois
      AND YEAR(CAST(date_ajout_objet AS DATETIME)) = @p_annee;
END;
GO

-- Procedure 8 : Statistiques par departement
CREATE OR ALTER PROCEDURE presidence_stats_departement
    @p_id_departement INT
AS
BEGIN
    SELECT 
        d.nom_depser,
        COUNT(DISTINCT u.id_utilisateur) AS nombre_utilisateurs,
        COUNT(DISTINCT o.id_objet) AS objets_donnes,
        COUNT(DISTINCT r.id_utilisateur) AS reservations
    FROM DEPSER d
    LEFT JOIN UTILISATEUR u ON d.id_utilisateur = u.id_utilisateur
    LEFT JOIN OBJET o ON u.id_utilisateur = o.id_utilisateur
    LEFT JOIN RESERVER r ON u.id_utilisateur = r.id_utilisateur
    WHERE d.id_depser = @p_id_departement
    GROUP BY d.nom_depser;
END;
GO

-- Procedure 9 : Liste complete des objets
CREATE OR ALTER PROCEDURE presidence_liste_complete_objets
AS
BEGIN
    SELECT o.id_objet, o.nom_objet, c.nom_categorie, e.nom_etat, 
           s.nom_statut_disponibilite, u.nom_utilisateur AS donneur
    FROM OBJET o
    JOIN CATEGORIE c ON o.id_categorie = c.id_categorie
    JOIN ETAT e ON o.id_etat = e.id_etat
    JOIN STATUTDISPONIBLE s ON o.id_statut_disponibilite = s.id_statut_disponibilite
    JOIN UTILISATEUR u ON o.id_utilisateur = u.id_utilisateur
    ORDER BY o.date_ajout_objet DESC;
END;
GO