USE ECOGESTUM;

-- Roles
INSERT INTO ROLE (nom_role) VALUES
('etudiant'),
('Enseignant'),
('Presidence de l''universite');

-- Departements / Services
INSERT INTO DEPSER (nom_depser) VALUES
('Departement Informatique'),
('Departement Mathematiques'),
('Departement Langues'),
('Service Administratif');

-- Utilisateurs
INSERT INTO UTILISATEUR (nom_utilisateur, prenom_utilisateur, email_utilisateur, mdp_utilisateur, id_role, id_depser) VALUES
('Dupont', 'Marie', 'marie.dupont.etu@univ-lemans.fr', '$2y$10$xP240TF99bEdbsIlMWy.jeyRqi7RtPFigmvSBXghqD2r0SeEjYuEK', 1, 1),
('Martin', 'Pierre', 'pierre.martin.etu@univ-lemans.fr', '$2y$10$pDe0Vkt.VXHvLoh.z5.uhOWSt/g7SHkVfGVx.fbe0Vz5B7mPvuXtK', 1, 2),
('Durand', 'Sophie', 'sophie.durand.etu@univ-lemans.fr', 'mdp789', 1, 3),
('Bernard', 'Luc', 'luc.bernard@univ-lemans.fr', 'mdp321', 2, 1),
('Petit', 'Anne', 'anne.petit@univ-lemans.fr', 'mdp654', 2, 2),
('Moreau', 'Jean', 'jean.moreau@univ-lemans.fr', '$2y$10$A.1rivSfxgL2XLXt2GDupuZmGjVA0.qAO7ardlE.3Zcif0WcdYdrO', 3, 4),
('Leroy', 'Claire', 'claire.leroy.etu@univ-lemans.fr', 'mdp147', 1, 1),
('Simon', 'Paul', 'paul.simon.etu@univ-lemans.fr', 'mdp258', 1, 2),
('Laurent', 'Emma', 'emma.laurent@univ-lemans.fr', 'mdp369', 2, 4),
('Lefebvre', 'Thomas', 'thomas.lefebvre.etu@univ-lemans.fr', 'mdp741', 1, 3);

-- Categories
INSERT INTO CATEGORIE (nom_categorie, description_categorie, image_categorie) VALUES
('Materiel informatique', 'Materiel informatique et electronique', 'fa-solid fa-laptop'),
('Mobilier', 'Meubles et equipements de bureau', 'fa-solid fa-chair'),
('Livres', 'Manuels scolaires et ouvrages universitaires', 'fa-solid fa-book'),
('Materiel Pedagogique', 'Fournitures de bureau et scolaires', 'fa-solid fa-graduation-cap'),
('Equipement sportif', 'equipements sportifs', 'fa-solid fa-futbol'),
('Petit electromenager', 'petit electromenager', 'fa-solid fa-plug'),
('Materiel multimédia', 'materiel multimédia', 'fa-solid fa-tv'),
('Vetements', 'vetements', 'fa-solid fa-shirt');

-- etats
INSERT INTO ETAT (nom_etat) VALUES
('Neuf'),
('Tres bon etat'),
('Bon etat'),
('etat moyen'),
('Usage');

-- Statuts disponibilite
INSERT INTO STATUTDISPONIBLE (nom_statut_disponibilite) VALUES
('En attente'),
('Disponible'),
('Reserve'),
('Indisponible');

-- Statuts reservation
INSERT INTO STATUTRESERVATION (nom_statut_reservation) VALUES
('En attente'),
('Confirmee'),
('Annulee'),
('Completee'),
('Refusee'),
('Approuvee');

-- Types d'echange
INSERT INTO TYPEECHANGE (nom_type_echange) VALUES
('Don'),
('Pret'),
('echange');

-- Types d'evenement
INSERT INTO TYPEEVENEMENT (nom_type_evenement) VALUES
('Collecte'),
('Atelier de reparation'),
('Brocante solidaire'),
('Sensibilisation'),
('Collecte generale'), 
('Atelier pratique'), 
('Vente et echange'), 
('Conference');

-- Points de collecte
INSERT INTO POINTCOLLECTE (adresse_point_collecte, nom_point_collecte, latitude, longitude) VALUES
('Bâtiment A, RDC', 'Point Central Campus', 48.08560704463375, -0.7579770016531365),
('Bibliotheque Universitaire', 'Point BU', 48.085892413181135, -0.758704595070684),
('Restaurant Universitaire', 'Point RU', 48.08658800126685, -0.7573470247388182),
('Maison des etudiants', 'Point MDE', 48.08566571581335, -0.7590628596498333);

-- Rapports
INSERT INTO RAPPORT (titre_rapport, contenu_rapport, date_rapport, id_utilisateur) VALUES
('Rapport mensuel janvier', 'Bilan des activites du mois', '2025-01-31', 6),
('Analyse des dons', 'Statistiques sur les objets donnes', '2025-02-15', 4),
('Rapport trimestriel', 'Synthese du premier trimestre', '2025-03-31', 6);

-- Communiques
INSERT INTO COMMUNIQUE (titre_communique, contenu_communique, date_communique, id_utilisateur) VALUES
('Nouvelle plateforme', 'Lancement de la plateforme anti-gaspillage', '2025-01-15 10:00:00', 6),
('Collecte speciale', 'Grande collecte de materiel informatique', '2025-02-01 09:00:00', 4),
('Bilan positif', 'Merci pour votre participation', '2025-02-28 14:30:00', 6);

-- Temoignages
INSERT INTO TEMOIGNAGE (contenu_temoignage, date_temoignage, id_utilisateur) VALUES
('Tres satisfait de cette initiative, j''ai pu trouver les livres dont j''avais besoin', '2025-02-10 11:00:00', 1),
('Super concept ! J''ai donne mon ancien ordinateur qui peut servir a d''autres', '2025-02-15 16:30:00', 2),
('Plateforme facile a utiliser, je recommande', '2025-02-20 10:15:00', 5),
('Grâce à ÉcoGestUM, j''ai pu équiper mon laboratoire avec du matériel informatique parfaitement fonctionnel. Plutôt que d''acheter du neuf, nous avons récupéré 10 ordinateurs du Service Informatique. Une économie de 8 000€ et un geste concret pour l''environnement !', '2025-01-27 16:30:29', 3);

-- Conseils
INSERT INTO CONSEIL (titre_conseil, contenu_conseil, date_conseil, id_utilisateur) VALUES
('Comment bien donner', 'Assurez-vous que vos objets soient propres et en bon etat', '2025-01-20 10:00:00', 4),
('Reduire le gaspillage', 'Pensez a reparer et/ou donner avant de jeter', '2025-02-05 14:00:00', 5),
('Organiser son don', 'Apportez vos objets aux points de collecte', '2025-02-18 09:00:00', 9);

-- Notifications
INSERT INTO NOTIFICATION (contenu_notification, date_notification) VALUES
('Votre reservation a ete confirmee', '2025-02-20 10:30:00'),
('Nouvel objet disponible dans votre categorie favorite', '2025-02-21 14:00:00'),
('Un evenement se deroule demain sur le campus', '2025-02-22 08:00:00'),
('Votre don a bien ete enregistre', '2025-02-23 11:00:00');

-- Statistiques
INSERT INTO STATISTIQUE (date_statistique, type_statistique, valeur_statistique, id_utilisateur) VALUES
('2025-01-31', 'Objets donnes', '125', 6),
('2025-01-31', 'Utilisateurs actifs', '89', 6),
('2025-02-28', 'Objets donnes', '156', 6),
('2025-02-28', 'Reservations', '67', 6);

-- Objets
INSERT INTO OBJET (nom_objet, description_objet, date_ajout_objet, id_point_collecte, id_type_echange, id_utilisateur, id_statut_disponibilite, id_etat, id_categorie) VALUES
('Manuel de Mathematiques L1', 'Analyse et algebre lineaire', '2025-02-10 10:00:00', 1, 1, 1, 1, 2, 1),
('Ordinateur portable HP', 'Core i5, 8Go RAM, bon etat', '2025-02-12 14:30:00', 2, 2, 2, 1, 3, 2),
('Bureau etudiant', 'Bureau avec tiroirs', '2025-02-14 09:00:00', 4, 1, 3, 1, 2, 3),
('Dictionnaire Anglais-Français', 'edition recente', '2025-02-15 11:00:00', 2, 1, 7, 2, 1, 1),
('Calculatrice scientifique', 'Casio FX-92', '2025-02-16 13:00:00', 1, 3, 8, 1, 2, 6),
('Veste universitaire', 'Taille M, couleur bleue', '2025-02-17 15:00:00', 4, 1, 10, 1, 2, 4),
('Raquette de badminton', 'Avec housse', '2025-02-18 10:30:00', 3, 2, 1, 3, 3, 5),
('Programmation Python', 'Pour debutants', '2025-02-19 16:00:00', 1, 1, 2, 1, 2, 1);

-- evenements
INSERT INTO EVENEMENT (titre_evenement, description_evenement, date_debut_evenement, date_fin_evenement, id_type_evenement, id_utilisateur) VALUES
('Grande Collecte de Printemps', 'Collecte de tous types d''objets', '2026-01-15', '2026-01-17', 1, 4),
('Atelier Reparation electronique', 'Apprenez a reparer vos appareils', '2026-01-20', '2026-01-20', 2, 5),
('Brocante Solidaire', 'Donnez une seconde vie aux objets', '2026-02-05', '2026-02-06', 3, 6),
('Sensibilisation au Gaspillage', 'Impact environnemental', '2026-02-10', '2026-02-10', 4, 9);

-- Reservations
INSERT INTO RESERVER (id_objet, date_reservation, id_utilisateur, id_statut_reservation) VALUES
(4, '2025-02-15', 3, 2),
(7, '2025-02-18', 8, 1);

-- Associations Utilisateur-Departement
INSERT INTO REGROUPER (id_utilisateur, id_depser) VALUES
(1, 1),
(2, 1),
(3, 2),
(7, 4),
(8, 1);

-- Signalements
INSERT INTO SIGNALER (id_objet, id_utilisateur, description_signalement, date_signalement) VALUES
(2, 3, 'Description ne correspond pas a l''etat reel', '2025-02-13 16:00:00'),
(6, 1, 'Taille incorrecte dans la description', '2025-02-17 17:30:00');

-- Inscriptions evenements
INSERT INTO INSCRIRE (id_utilisateur, id_evenement) VALUES
(1, 1),
(2, 1),
(3, 2),
(7, 3),
(8, 4),
(10, 1),
(1, 3);

-- Associations Utilisateur-Notification
INSERT INTO RECEVOIR (id_utilisateur, id_notification) VALUES
(1, 4),
(2, 2),
(3, 1),
(7, 3),
(8, 2);