USE ECOGESTUM;



CREATE TRIGGER setDateNotification
    BEFORE INSERT
    ON NOTIFICATION
    FOR EACH ROW
BEGIN
    SET NEW.date_notification = NOW();
END;


CREATE TRIGGER addNotification AFTER UPDATE ON OBJET FOR EACH ROW
BEGIN

    IF OLD.id_statut_disponibilite != NEW.id_statut_disponibilite THEN
        IF NEW.id_statut_disponibilite = 2 THEN
            INSERT INTO NOTIFICATION (contenu_notification)
            VALUES (CONCAT('Votre objet ', NEW.nom_objet, ' est disponible à la réservation'));
            INSERT INTO RECEVOIR (id_utilisateur, id_notification) VALUES (NEW.id_utilisateur, LAST_INSERT_ID());
        END IF;
    END IF;
END