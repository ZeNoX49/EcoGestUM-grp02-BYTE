USE ECOGESTUM;

-- ===========================================================
-- VUES
-- ===========================================================

/* ------ PRESIDENCE ------ */

-- Requête 7 : Statistiques par catégorie
CREATE OR REPLACE VIEW statistiques_par_categorie AS
SELECT
    c.nom_categorie,
    COUNT(o.id_objet) AS nombre_objets
FROM categorie c
         LEFT JOIN objet o ON c.id_categorie = o.id_categorie
GROUP BY c.nom_categorie;


-- Requête 8 : Nombre d'utilisateurs par rôle
CREATE OR REPLACE VIEW utilisateurs_par_role AS
SELECT
    r.nom_role,
    COUNT(u.id_utilisateur) AS nombre_utilisateurs
FROM role r
         LEFT JOIN utilisateur u ON r.id_role = u.id_role
GROUP BY r.nom_role;


-- Requête 9 : Vue globale des réservations
CREATE OR REPLACE VIEW vue_reservations AS
SELECT
    sr.nom_statut_reservation,
    COUNT(*) AS nombre
FROM reserver r
         JOIN statutreservation sr ON r.id_statut_reservation = sr.id_statut_reservation
GROUP BY sr.nom_statut_reservation;


-- ===========================================================
-- PROCEDURES STOCKÉES
-- ===========================================================


-- Procédure 7 : Rapport mensuel
CREATE OR REPLACE PROCEDURE presidence_rapport_mois(
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
END


-- Procédure 8 : Statistiques par département
CREATE OR REPLACE PROCEDURE presidence_stats_departement(
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
END


-- Procédure 9 : Liste complète des objets
CREATE OR REPLACE PROCEDURE presidence_liste_complete_objets()
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
END

