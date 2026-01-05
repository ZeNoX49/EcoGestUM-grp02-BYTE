USE ECOGESTUM;

CREATE OR REPLACE VIEW objets_sauvegardes AS
SELECT o.*, u.nom_utilisateur, u.prenom_utilisateur, s.nom_statut_disponibilite,  pc.nom_point_collecte, pc.adresse_point_collecte, d.nom_depser AS nom_departement FROM OBJET o
JOIN UTILISATEUR u ON o.id_utilisateur = u.id_utilisateur
JOIN DEPSER d ON d.id_depser = u.id_depser
JOIN STATUTDISPONIBLE s ON s.id_statut_disponibilite = o.id_statut_disponibilite
JOIN POINTCOLLECTE pc on pc.id_point_collecte = o.id_point_collecte;

CREATE OR REPLACE VIEW evenements_sauvegardes AS
SELECT e.*, u.nom_utilisateur, u.prenom_utilisateur, t.nom_type_evenement
FROM EVENEMENT e
LEFT JOIN UTILISATEUR u ON u.id_utilisateur = e.id_utilisateur
LEFT JOIN TYPEEVENEMENT t ON t.id_type_evenement = e.id_type_evenement;

-- Requete 1 : Voir les objets disponibles
CREATE
OR REPLACE VIEW objets_disponibles AS
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
       u.nom_utilisateur,
       s.nom_statut_disponibilite
FROM OBJET o
         JOIN POINTCOLLECTE p ON p.id_point_collecte = o.id_point_collecte
         JOIN ETAT e ON e.id_etat = o.id_etat
         JOIN UTILISATEUR u ON u.id_utilisateur = o.id_utilisateur
         JOIN STATUTDISPONIBLE s ON s.id_statut_disponibilite = o.id_statut_disponibilite
WHERE o.id_statut_disponibilite = 2;

-- Requete 2 : Voir mes reservations (exemple pour utilisateur id=1)
CREATE
OR REPLACE VIEW mes_reservations AS
SELECT o.nom_objet,
       r.date_reservation,
       sr.nom_statut_reservation
FROM RESERVER r
         JOIN OBJET o ON r.id_objet = o.id_objet
         JOIN STATUTRESERVATION sr ON r.id_statut_reservation = sr.id_statut_reservation
WHERE r.id_utilisateur = 1;

-- Requete 3 : Voir les evenements a venir
CREATE
OR REPLACE VIEW evenements_a_venir AS
SELECT titre_evenement,
       description_evenement,
       date_debut_evenement
FROM EVENEMENT
WHERE date_debut_evenement >= NOW();

-- Requete 4 : Voir mes objets donnes (exemple pour id_utilisateur = 2)
CREATE VIEW mes_objets_donnes AS
SELECT
    nom_objet,
    description_objet,
    date_ajout_objet
FROM OBJET
WHERE id_utilisateur = 2;

-- Requete 5 : Voir les reservations de mes objets
CREATE VIEW reservations_de_mes_objets AS
SELECT
    u.nom_utilisateur,
    u.prenom_utilisateur,
    o.nom_objet,
    r.date_reservation
FROM RESERVER r
JOIN OBJET o ON r.id_objet = o.id_objet
JOIN UTILISATEUR u ON r.id_utilisateur = u.id_utilisateur
WHERE o.id_utilisateur = 2;


-- Requete 6 : Voir tous les objets par etat
CREATE VIEW objets_par_etat AS
SELECT
    e.nom_etat,
    COUNT(o.id_objet) AS nombre
FROM ETAT e
LEFT JOIN OBJET o ON e.id_etat = o.id_etat
WHERE o.id_utilisateur = 2
GROUP BY e.nom_etat;

-- Requete 7 : Statistiques par categorie
CREATE VIEW statistiques_par_categorie AS
SELECT
    c.nom_categorie,
    COUNT(o.id_objet) AS nombre_objets
FROM categorie c
LEFT JOIN objet o ON c.id_categorie = o.id_categorie
GROUP BY c.nom_categorie;

-- Requete 8 : Nombre d'utilisateurs par rôle
CREATE VIEW utilisateurs_par_role AS
SELECT
    r.nom_role,
    COUNT(u.id_utilisateur) AS nombre_utilisateurs
FROM role r
LEFT JOIN utilisateur u ON r.id_role = u.id_role
GROUP BY r.nom_role;

-- Requete 9 : Vue globale des reservations
CREATE VIEW vue_reservations AS
SELECT
    sr.nom_statut_reservation,
    COUNT(*) AS nombre
FROM reserver r
JOIN statutreservation sr ON r.id_statut_reservation = sr.id_statut_reservation
GROUP BY sr.nom_statut_reservation;

CREATE VIEW reservations AS
SELECT r.*,
       o.nom_objet, o.description_objet, o.image_objet,
       c.nom_categorie,
       s.nom_statut_reservation,
       pc.nom_point_collecte, pc.adresse_point_collecte,
       u.email_utilisateur as email_proprietaire,
       u.nom_utilisateur as nom_proprietaire,
       d.nom_depser as nom_departement
FROM RESERVER r
         JOIN OBJET o ON r.id_objet = o.id_objet
         JOIN CATEGORIE c ON o.id_categorie = c.id_categorie
         JOIN STATUTRESERVATION s ON r.id_statut_reservation = s.id_statut_reservation
         JOIN POINTCOLLECTE pc ON o.id_point_collecte = pc.id_point_collecte
         JOIN UTILISATEUR u ON o.id_utilisateur = u.id_utilisateur
         JOIN DEPSER d ON u.id_depser = d.id_depser;

CREATE VIEW allObject AS
SELECT o.*, u.nom_utilisateur, u.prenom_utilisateur, s.nom_statut_disponibilite,  pc.nom_point_collecte, pc.adresse_point_collecte,  c.nom_categorie, d.nom_depser AS nom_departement FROM OBJET o
         JOIN UTILISATEUR u ON o.id_utilisateur = u.id_utilisateur
         JOIN DEPSER d ON d.id_depser = u.id_depser
         JOIN STATUTDISPONIBLE s ON s.id_statut_disponibilite = o.id_statut_disponibilite
         JOIN POINTCOLLECTE pc on pc.id_point_collecte = o.id_point_collecte
         JOIN CATEGORIE c ON c.id_categorie = o.id_categorie;