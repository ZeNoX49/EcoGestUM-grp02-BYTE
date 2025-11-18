USE SAE3;
GO

/* ------ ETUDIANT ------ */

-- Requete 1 : Voir les objets disponibles
CREATE OR ALTER VIEW objets_disponibles AS
SELECT nom_objet, description_objet
FROM OBJET o
JOIN STATUTDISPONIBLE s ON o.id_statut_disponibilite = s.id_statut_disponibilite
WHERE s.nom_statut_disponibilite = 'Disponible';
GO

-- Requete 2 : Voir mes reservations
CREATE OR ALTER VIEW mes_reservations AS
SELECT o.nom_objet, r.date_reservation, sr.nom_statut_reservation
FROM RESERVER r
JOIN OBJET o ON r.id_objet = o.id_objet
JOIN STATUTRESERVATION sr ON r.id_statut_reservation = sr.id_statut_reservation
WHERE r.id_utilisateur = 1;
GO

-- Requete 3 : Voir les evenements e venir
CREATE OR ALTER VIEW evenements_a_venir AS
SELECT titre_evenement, description_evenement, date_debut_evenement
FROM EVENEMENT
WHERE date_debut_evenement >= GETDATE();
GO

-- Procedure 1 : Reserver un objet
CREATE OR ALTER PROCEDURE etudiant_reserver_objet
    @p_id_utilisateur INT,
    @p_id_objet INT
AS
BEGIN
    INSERT INTO RESERVER (id_objet, date_reservation, id_utilisateur, id_statut_reservation)
    VALUES (@p_id_objet, GETDATE(), @p_id_utilisateur, 1);
    
    UPDATE OBJET
    SET id_statut_disponibilite = 2
    WHERE id_objet = @p_id_objet;
END;
GO

-- Procedure 2 : Annuler ma reservation
CREATE OR ALTER PROCEDURE etudiant_annuler_reservation
    @p_id_utilisateur INT
AS
BEGIN
    DECLARE @v_id_objet INT;
    
    SELECT @v_id_objet = id_objet
    FROM RESERVER
    WHERE id_utilisateur = @p_id_utilisateur;
    
    DELETE FROM RESERVER
    WHERE id_utilisateur = @p_id_utilisateur;
    
    UPDATE OBJET
    SET id_statut_disponibilite = 1
    WHERE id_objet = @v_id_objet;
END;
GO

-- Procedure 3 : Rechercher un objet par categorie
CREATE OR ALTER PROCEDURE etudiant_rechercher_par_categorie
    @p_id_categorie INT
AS
BEGIN
    SELECT o.nom_objet, o.description_objet, s.nom_statut_disponibilite
    FROM OBJET o
    JOIN STATUTDISPONIBLE s ON o.id_statut_disponibilite = s.id_statut_disponibilite
    WHERE o.id_categorie = @p_id_categorie;
END;
GO


