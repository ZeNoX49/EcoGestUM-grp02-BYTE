USE ECOGESTUM;

-- Roles
INSERT INTO role (nom_role) VALUES
                                ('Étudiant'),
                                ('Enseignant'),
                                ('Présidence de l''''université');

-- Utilisateurs
INSERT INTO utilisateur (nom_utilisateur, prenom_utilisateur, email_utilisateur, mdp_utilisateur, id_role) VALUES
('Dupont', 'Marie', 'marie.dupont@univ.fr', 'mdp123', 1),
('Martin', 'Pierre', 'pierre.martin@univ.fr', 'mdp456', 1),
('Durand', 'Sophie', 'sophie.durand@univ.fr', 'mdp789', 1),
('Bernard', 'Luc', 'luc.bernard@univ.fr', 'mdp321', 2),
('Petit', 'Anne', 'anne.petit@univ.fr', 'mdp654', 2),
('Moreau', 'Jean', 'jean.moreau@univ.fr', 'mdp987', 3),
('Leroy', 'Claire', 'claire.leroy@univ.fr', 'mdp147', 1),
('Simon', 'Paul', 'paul.simon@univ.fr', 'mdp258', 1),
('Laurent', 'Emma', 'emma.laurent@univ.fr', 'mdp369', 2),
('Lefebvre', 'Thomas', 'thomas.lefebvre@univ.fr', 'mdp741', 1);

-- Catégories
INSERT INTO categorie (nom_categorie, description_categorie) VALUES
('Livres', 'Manuels scolaires et ouvrages universitaires'),
('Électronique', 'Matériel informatique et électronique'),
('Mobilier', 'Meubles et équipements de bureau'),
('Vêtements', 'Vêtements et accessoires'),
('Sport', 'Équipements sportifs'),
('Papeterie', 'Fournitures de bureau et scolaires');

-- Départements / Services
INSERT INTO depser (nom_depser, id_utilisateur) VALUES
('Département Informatique', 4),
('Département Mathématiques', 5),
('Service Administratif', 6),
('Département Langues', 9);

-- États
INSERT INTO etat (nom_etat) VALUES
('Neuf'),
('Très bon état'),
('Bon état'),
('État moyen'),
('Usagé');

-- Statuts disponibilité
INSERT INTO statutdisponible (nom_statut_disponibilite) VALUES
('Disponible'),
('Réservé'),
('Prêté'),
('Indisponible');

-- Statuts réservation
INSERT INTO statutreservation (nom_statut_reservation) VALUES
('En attente'),
('Confirmée'),
('Annulée'),
('Complétée');

-- Types d?échange
INSERT INTO typeechange (nom_type_echange) VALUES
('Don'),
('Prêt'),
('Échange');

-- Types d?événement
INSERT INTO typeevenement (nom_type_evenement) VALUES
('Collecte'),
('Atelier de réparation'),
('Brocante solidaire'),
('Sensibilisation');

-- Points de collecte
INSERT INTO pointcollecte (adresse_point_collecte, nom_point_collecte) VALUES
('Bâtiment A, RDC', 'Point Central Campus'),
('Bibliothèque Universitaire', 'Point BU'),
('Restaurant Universitaire', 'Point RU'),
('Maison des Étudiants', 'Point MDE');

-- Rapports
INSERT INTO rapport (titre_rapport, contenu_rapport, date_rapport, id_utilisateur) VALUES
('Rapport mensuel janvier', 'Bilan des activités du mois', '2025-01-31', 6),
('Analyse des dons', 'Statistiques sur les objets donnés', '2025-02-15', 4),
('Rapport trimestriel', 'Synthèse du premier trimestre', '2025-03-31', 6);

-- Communiqués
INSERT INTO communique (titre_communique, contenu_communique, date_communique, id_utilisateur) VALUES
('Nouvelle plateforme', 'Lancement de la plateforme anti-gaspillage', '2025-01-15 10:00:00', 6),
('Collecte spéciale', 'Grande collecte de matériel informatique', '2025-02-01 09:00:00', 4),
('Bilan positif', 'Merci pour votre participation', '2025-02-28 14:30:00', 6);

-- Témoignages
INSERT INTO temoignage (contenu_temoignage, date_temoignage, id_utilisateur) VALUES
('Très satisfait de cette initiative, j\'ai pu trouver les livres dont j\'avais besoin', '2025-02-10 11:00:00', 1),
('Super concept ! J\'ai donné mon ancien ordinateur qui peut servir à d\'autres', '2025-02-15 16:30:00', 2),
('Plateforme facile à utiliser, je recommande', '2025-02-20 10:15:00', 3);

-- Conseils
INSERT INTO conseil (titre_conseil, contenu_conseil, date_conseil, id_utilisateur) VALUES
('Comment bien donner', 'Assurez-vous que vos objets soient propres et en bon état', '2025-01-20 10:00:00', 4),
('Réduire le gaspillage', 'Pensez à réparer avant de jeter', '2025-02-05 14:00:00', 5),
('Organiser son don', 'Apportez vos objets aux points de collecte', '2025-02-18 09:00:00', 9);

-- Notifications
INSERT INTO notification (contenu_notification, date_notification) VALUES
('Votre réservation a été confirmée', '2025-02-20 10:30:00'),
('Nouvel objet disponible dans votre catégorie favorite', '2025-02-21 14:00:00'),
('Un événement se déroule demain sur le campus', '2025-02-22 08:00:00'),
('Votre don a bien été enregistré', '2025-02-23 11:00:00');

-- Statistiques
INSERT INTO statistique (date_statistique, type_statistique, valeur_statistique, id_utilisateur) VALUES
('2025-01-31', 'Objets donnés', '125', 6),
('2025-01-31', 'Utilisateurs actifs', '89', 6),
('2025-02-28', 'Objets donnés', '156', 6),
('2025-02-28', 'Réservations', '67', 6);

-- Objets
INSERT INTO objet (image_objet, nom_objet, description_objet, date_ajout_objet, id_point_collecte, id_type_echange, id_utilisateur, id_statut_disponibilite, id_etat, id_categorie) VALUES
('livre1.jpg', 'Manuel de Mathématiques L1', 'Analyse et algèbre linéaire', '2025-02-10 10:00:00', 1, 1, 1, 1, 2, 1),
('ordi1.jpg', 'Ordinateur portable HP', 'Core i5, 8Go RAM, bon état', '2025-02-12 14:30:00', 2, 2, 2, 1, 3, 2),
('bureau1.jpg', 'Bureau étudiant', 'Bureau avec tiroirs', '2025-02-14 09:00:00', 4, 1, 3, 1, 2, 3),
('livre2.jpg', 'Dictionnaire Anglais-Français', 'Édition récente', '2025-02-15 11:00:00', 2, 1, 7, 2, 1, 1),
('calculatrice.jpg', 'Calculatrice scientifique', 'Casio FX-92', '2025-02-16 13:00:00', 1, 3, 8, 1, 2, 6),
('veste.jpg', 'Veste universitaire', 'Taille M, couleur bleue', '2025-02-17 15:00:00', 4, 1, 10, 1, 2, 4),
('raquette.jpg', 'Raquette de badminton', 'Avec housse', '2025-02-18 10:30:00', 3, 2, 1, 3, 3, 5),
('livre3.jpg', 'Programmation Python', 'Pour débutants', '2025-02-19 16:00:00', 1, 1, 2, 1, 2, 1);

-- Événements
INSERT INTO evenement (titre_evenement, type_evenement, description_evenement, date_debut_evenement, date_fin_evenement, id_type_evenement, id_utilisateur) VALUES
('Grande Collecte de Printemps', 'Collecte générale', 'Collecte de tous types d''''objets', '2025-03-15', '2025-03-17', 1, 4),
                                ('Atelier Réparation Électronique', 'Atelier pratique', 'Apprenez à réparer vos appareils', '2025-03-20', '2025-03-20', 2, 5),
                                ('Brocante Solidaire', 'Vente et échange', 'Donnez une seconde vie aux objets', '2025-04-05', '2025-04-06', 3, 6),
                                ('Sensibilisation au Gaspillage', 'Conférence', 'Impact environnemental', '2025-04-10', '2025-04-10', 4, 9);

-- Réservations
INSERT INTO reserver (id_objet, date_reservation, id_utilisateur, id_statut_reservation) VALUES
                                                                                             (4, '2025-02-15', 3, 2),
                                                                                             (7, '2025-02-18', 8, 1);

-- Associations Utilisateur-Département
INSERT INTO regrouper (id_utilisateur, id_depser) VALUES
                                                      (1, 1),
                                                      (2, 1),
                                                      (3, 2),
                                                      (7, 4),
                                                      (8, 1);

-- Signalements
INSERT INTO signaler (id_objet, id_utilisateur, description_signalement, date_signalement) VALUES
    (2, 3, 'Description ne correspond pas à l''''état réel', '2025-02-13 16:00:00'),
(6, 1, 'Taille incorrecte dans la description', '2025-02-17 17:30:00');

-- Inscriptions Événements
INSERT INTO inscrire (id_utilisateur, id_evenement) VALUES
(1, 1),
(2, 1),
(3, 2),
(7, 3),
(8, 4),
(10, 1),
(1, 3);

-- Associations Utilisateur-Notification
INSERT INTO recevoir (id_utilisateur, id_notification) VALUES
(1, 4),
(2, 2),
(3, 1),
(7, 3),
(8, 2);
