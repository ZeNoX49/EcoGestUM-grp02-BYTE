USE ECOGESTUM;

-- Roles
INSERT INTO role (nom_role) VALUES
('etudiant'),
('Enseignant'),
('Presidence de l''universite');

-- Utilisateurs
INSERT INTO utilisateur (nom_utilisateur, prenom_utilisateur, email_utilisateur, mdp_utilisateur, id_role) VALUES
('Dupont', 'Marie', 'marie.dupont.etu@univ-lemans.fr', 'mdp123', 1),
('Martin', 'Pierre', 'pierre.martin.etu@univ-lemans.fr', 'mdp456', 1),
('Durand', 'Sophie', 'sophie.durand.etu@univ-lemans.fr', 'mdp789', 1),
('Bernard', 'Luc', 'luc.bernard@univ-lemans.fr', 'mdp321', 2),
('Petit', 'Anne', 'anne.petit@univ-lemans.fr', 'mdp654', 2),
('Moreau', 'Jean', 'jean.moreau@univ-lemans.fr', 'mdp987', 3),
('Leroy', 'Claire', 'claire.leroy.etu@univ-lemans.fr', 'mdp147', 1),
('Simon', 'Paul', 'paul.simon.etu@univ-lemans.fr', 'mdp258', 1),
('Laurent', 'Emma', 'emma.laurent@univ-lemans.fr', 'mdp369', 2),
('Lefebvre', 'Thomas', 'thomas.lefebvre.etu@univ-lemans.fr', 'mdp741', 1);

-- Categories
INSERT INTO categorie (nom_categorie, description_categorie, image_categorie) VALUES
('Materiel informatique', 'Materiel informatique et electronique', '💻'),
('Mobilier', 'Meubles et equipements de bureau', '🪑'),
('Livres', 'Manuels scolaires et ouvrages universitaires', '📚'),
('Materiel Pedagogique', 'Fournitures de bureau et scolaires', '🎓'),
('Equipement sportif', 'equipements sportifs', '⚽'),
('Petit electromenager', 'petit electromenager', '🔌'),
('Materiel multimédia', 'materiel multimédia', '📺'),
('Vetements', 'vetements', '👕');

-- Departements / Services
INSERT INTO depser (nom_depser, id_utilisateur) VALUES
('Departement Informatique', 4),
('Departement Mathematiques', 5),
('Service Administratif', 6),
('Departement Langues', 9);

-- etats
INSERT INTO etat (nom_etat) VALUES
('Neuf'),
('Tres bon etat'),
('Bon etat'),
('etat moyen'),
('Usage');

-- Statuts disponibilite
INSERT INTO statutdisponible (nom_statut_disponibilite) VALUES
('Disponible'),
('Reserve'),
('Prete'),
('Indisponible');

-- Statuts reservation
INSERT INTO statutreservation (nom_statut_reservation) VALUES
('En attente'),
('Confirmee'),
('Annulee'),
('Completee');

-- Types d'echange
INSERT INTO typeechange (nom_type_echange) VALUES
('Don'),
('Pret'),
('echange');

-- Types d'evenement
INSERT INTO typeevenement (nom_type_evenement) VALUES
('Collecte'),
('Atelier de reparation'),
('Brocante solidaire'),
('Sensibilisation');

-- Points de collecte
INSERT INTO pointcollecte (adresse_point_collecte, nom_point_collecte) VALUES
('Bâtiment A, RDC', 'Point Central Campus'),
('Bibliotheque Universitaire', 'Point BU'),
('Restaurant Universitaire', 'Point RU'),
('Maison des etudiants', 'Point MDE');

-- Rapports
INSERT INTO rapport (titre_rapport, contenu_rapport, date_rapport, id_utilisateur) VALUES
('Rapport mensuel janvier', 'Bilan des activites du mois', '2025-01-31', 6),
('Analyse des dons', 'Statistiques sur les objets donnes', '2025-02-15', 4),
('Rapport trimestriel', 'Synthese du premier trimestre', '2025-03-31', 6);

-- Communiques
INSERT INTO communique (titre_communique, contenu_communique, date_communique, id_utilisateur) VALUES
('Nouvelle plateforme', 'Lancement de la plateforme anti-gaspillage', '2025-01-15 10:00:00', 6),
('Collecte speciale', 'Grande collecte de materiel informatique', '2025-02-01 09:00:00', 4),
('Bilan positif', 'Merci pour votre participation', '2025-02-28 14:30:00', 6);

-- Temoignages
INSERT INTO temoignage (contenu_temoignage, date_temoignage, id_utilisateur) VALUES
('Tres satisfait de cette initiative, j\'ai pu trouver les livres dont j\'avais besoin', '2025-02-10 11:00:00', 1),
('Super concept ! J\'ai donne mon ancien ordinateur qui peut servir a d\'autres', '2025-02-15 16:30:00', 2),
('Plateforme facile a utiliser, je recommande', '2025-02-20 10:15:00', 3);

-- Conseils
INSERT INTO conseil (titre_conseil, contenu_conseil, date_conseil, id_utilisateur) VALUES
('Comment bien donner', 'Assurez-vous que vos objets soient propres et en bon etat', '2025-01-20 10:00:00', 4),
('Reduire le gaspillage', 'Pensez a reparer avant de jeter', '2025-02-05 14:00:00', 5),
('Organiser son don', 'Apportez vos objets aux points de collecte', '2025-02-18 09:00:00', 9);

-- Notifications
INSERT INTO notification (contenu_notification, date_notification) VALUES
('Votre reservation a ete confirmee', '2025-02-20 10:30:00'),
('Nouvel objet disponible dans votre categorie favorite', '2025-02-21 14:00:00'),
('Un evenement se deroule demain sur le campus', '2025-02-22 08:00:00'),
('Votre don a bien ete enregistre', '2025-02-23 11:00:00');

-- Statistiques
INSERT INTO statistique (date_statistique, type_statistique, valeur_statistique, id_utilisateur) VALUES
('2025-01-31', 'Objets donnes', '125', 6),
('2025-01-31', 'Utilisateurs actifs', '89', 6),
('2025-02-28', 'Objets donnes', '156', 6),
('2025-02-28', 'Reservations', '67', 6);

-- Objets
INSERT INTO objet (image_objet, nom_objet, description_objet, date_ajout_objet, id_point_collecte, id_type_echange, id_utilisateur, id_statut_disponibilite, id_etat, id_categorie) VALUES
('livre1.jpg', 'Manuel de Mathematiques L1', 'Analyse et algebre lineaire', '2025-02-10 10:00:00', 1, 1, 1, 1, 2, 1),
('ordi1.jpg', 'Ordinateur portable HP', 'Core i5, 8Go RAM, bon etat', '2025-02-12 14:30:00', 2, 2, 2, 1, 3, 2),
('bureau1.jpg', 'Bureau etudiant', 'Bureau avec tiroirs', '2025-02-14 09:00:00', 4, 1, 3, 1, 2, 3),
('livre2.jpg', 'Dictionnaire Anglais-Français', 'edition recente', '2025-02-15 11:00:00', 2, 1, 7, 2, 1, 1),
('calculatrice.jpg', 'Calculatrice scientifique', 'Casio FX-92', '2025-02-16 13:00:00', 1, 3, 8, 1, 2, 6),
('veste.jpg', 'Veste universitaire', 'Taille M, couleur bleue', '2025-02-17 15:00:00', 4, 1, 10, 1, 2, 4),
('raquette.jpg', 'Raquette de badminton', 'Avec housse', '2025-02-18 10:30:00', 3, 2, 1, 3, 3, 5),
('livre3.jpg', 'Programmation Python', 'Pour debutants', '2025-02-19 16:00:00', 1, 1, 2, 1, 2, 1);

-- evenements
INSERT INTO evenement (titre_evenement, type_evenement, description_evenement, date_debut_evenement, date_fin_evenement, id_type_evenement, id_utilisateur) VALUES
('Grande Collecte de Printemps', 'Collecte g�n�rale', 'Collecte de tous types d''''objets', '2025-03-15', '2025-03-17', 1, 4),
                                ('Atelier R�paration �lectronique', 'Atelier pratique', 'Apprenez � r�parer vos appareils', '2025-03-20', '2025-03-20', 2, 5),
                                ('Brocante Solidaire', 'Vente et �change', 'Donnez une seconde vie aux objets', '2025-04-05', '2025-04-06', 3, 6),
                                ('Sensibilisation au Gaspillage', 'Conf�rence', 'Impact environnemental', '2025-04-10', '2025-04-10', 4, 9);

-- Reservations
INSERT INTO reserver (id_objet, date_reservation, id_utilisateur, id_statut_reservation) VALUES
(4, '2025-02-15', 3, 2),
(7, '2025-02-18', 8, 1);

-- Associations Utilisateur-Departement
INSERT INTO regrouper (id_utilisateur, id_depser) VALUES
(1, 1),
(2, 1),
(3, 2),
(7, 4),
(8, 1);

-- Signalements
INSERT INTO signaler (id_objet, id_utilisateur, description_signalement, date_signalement) VALUES
(2, 3, 'Description ne correspond pas a l''etat reel', '2025-02-13 16:00:00'),
(6, 1, 'Taille incorrecte dans la description', '2025-02-17 17:30:00');

-- Inscriptions evenements
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
