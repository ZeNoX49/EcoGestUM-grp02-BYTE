/*=============================================================
  Projet : BYTE
  Fichier : script insertion.sql
  Auteurs : Envel CROQ
  Date de création : 23/10/2025
==============================================================*/


USE SAE3;
GO

-- Roles
INSERT INTO Role VALUES
(1, 'Étudiant'),
(2, 'Enseignant'),
(3, 'Présidence de l''université');
GO

-- Utilisateurs
INSERT INTO Utilisateur VALUES
(1, 'Dupont', 'Marie', 'marie.dupont@univ.fr', 'mdp123', 1),
(2, 'Martin', 'Pierre', 'pierre.martin@univ.fr', 'mdp456', 1),
(3, 'Durand', 'Sophie', 'sophie.durand@univ.fr', 'mdp789', 1),
(4, 'Bernard', 'Luc', 'luc.bernard@univ.fr', 'mdp321', 2),
(5, 'Petit', 'Anne', 'anne.petit@univ.fr', 'mdp654', 2),
(6, 'Moreau', 'Jean', 'jean.moreau@univ.fr', 'mdp987', 3),
(7, 'Leroy', 'Claire', 'claire.leroy@univ.fr', 'mdp147', 1),
(8, 'Simon', 'Paul', 'paul.simon@univ.fr', 'mdp258', 1),
(9, 'Laurent', 'Emma', 'emma.laurent@univ.fr', 'mdp369', 2),
(10, 'Lefebvre', 'Thomas', 'thomas.lefebvre@univ.fr', 'mdp741', 1);
GO

-- Catégories
INSERT INTO Categorie VALUES
(1, 'Livres', 'Manuels scolaires et ouvrages universitaires'),
(2, 'Électronique', 'Matériel informatique et électronique'),
(3, 'Mobilier', 'Meubles et équipements de bureau'),
(4, 'Vêtements', 'Vêtements et accessoires'),
(5, 'Sport', 'Équipements sportifs'),
(6, 'Papeterie', 'Fournitures de bureau et scolaires');
GO

-- Départements / Services
INSERT INTO DepSer VALUES
(1, 'Département Informatique', 4),
(2, 'Département Mathématiques', 5),
(3, 'Service Administratif', 6),
(4, 'Département Langues', 9);
GO

-- États
INSERT INTO Etat VALUES
(1, 'Neuf'),
(2, 'Très bon état'),
(3, 'Bon état'),
(4, 'État moyen'),
(5, 'Usagé');
GO

-- Statuts disponibilité
INSERT INTO STATUTDISPONIBLE VALUES
(1, 'Disponible'),
(2, 'Réservé'),
(3, 'Prêté'),
(4, 'Indisponible');
GO

-- Statuts réservation
INSERT INTO STATUTRESERVATION VALUES
(1, 'En attente'),
(2, 'Confirmée'),
(3, 'Annulée'),
(4, 'Complétée');
GO

-- Types d’échange
INSERT INTO TypeEchange VALUES
(1, 'Don'),
(2, 'Prêt'),
(3, 'Échange');
GO

-- Types d’événement
INSERT INTO TypeEvenement VALUES
(1, 'Collecte'),
(2, 'Atelier de réparation'),
(3, 'Brocante solidaire'),
(4, 'Sensibilisation');
GO

-- Points de collecte
INSERT INTO PointCollecte VALUES
(1, 'Bâtiment A, RDC', 'Point Central Campus'),
(2, 'Bibliothèque Universitaire', 'Point BU'),
(3, 'Restaurant Universitaire', 'Point RU'),
(4, 'Maison des Étudiants', 'Point MDE');
GO

-- Rapports
INSERT INTO Rapport VALUES
(1, 'Rapport mensuel janvier', 'Bilan des activités du mois', '2025-01-31', 6),
(2, 'Analyse des dons', 'Statistiques sur les objets donnés', '2025-02-15', 4),
(3, 'Rapport trimestriel', 'Synthèse du premier trimestre', '2025-03-31', 6);
GO

-- Communiqués
INSERT INTO Communique VALUES
(1, 'Nouvelle plateforme', 'Lancement de la plateforme anti-gaspillage', '2025-01-15T10:00:00', 6),
(2, 'Collecte spéciale', 'Grande collecte de matériel informatique', '2025-02-01T09:00:00', 4),
(3, 'Bilan positif', 'Merci pour votre participation', '2025-02-28T14:30:00', 6);
GO

-- Témoignages
INSERT INTO Temoignage VALUES
(1, 'Très satisfait de cette initiative, j''ai pu trouver les livres dont j''avais besoin', '2025-02-10T11:00:00', 1),
(2, 'Super concept ! J''ai donné mon ancien ordinateur qui peut servir à d''autres', '2025-02-15T16:30:00', 2),
(3, 'Plateforme facile à utiliser, je recommande', '2025-02-20T10:15:00', 3);
GO

-- Conseils
INSERT INTO Conseil VALUES
(1, 'Comment bien donner', 'Assurez-vous que vos objets soient propres et en bon état', '2025-01-20T10:00:00', 4),
(2, 'Réduire le gaspillage', 'Pensez à réparer avant de jeter', '2025-02-05T14:00:00', 5),
(3, 'Organiser son don', 'Apportez vos objets aux points de collecte', '2025-02-18T09:00:00', 9);
GO

-- Notifications
INSERT INTO Notification VALUES
(1, 'Votre réservation a été confirmée', '2025-02-20T10:30:00'),
(2, 'Nouvel objet disponible dans votre catégorie favorite', '2025-02-21T14:00:00'),
(3, 'Un événement se déroule demain sur le campus', '2025-02-22T08:00:00'),
(4, 'Votre don a bien été enregistré', '2025-02-23T11:00:00');
GO

-- Statistiques
INSERT INTO Statistique VALUES
(1, '2025-01-31', 'Objets donnés', '125', 6),
(2, '2025-01-31', 'Utilisateurs actifs', '89', 6),
(3, '2025-02-28', 'Objets donnés', '156', 6),
(4, '2025-02-28', 'Réservations', '67', 6);
GO

-- Objets
INSERT INTO Objet VALUES
(1, 'livre1.jpg', 'Manuel de Mathématiques L1', 'Analyse et algèbre linéaire', '2025-02-10T10:00:00', 1, 1, 1, 1, 2, 1),
(2, 'ordi1.jpg', 'Ordinateur portable HP', 'Core i5, 8Go RAM, bon état', '2025-02-12T14:30:00', 2, 2, 2, 1, 3, 2),
(3, 'bureau1.jpg', 'Bureau étudiant', 'Bureau avec tiroirs', '2025-02-14T09:00:00', 4, 1, 3, 1, 2, 3),
(4, 'livre2.jpg', 'Dictionnaire Anglais-Français', 'Édition récente', '2025-02-15T11:00:00', 2, 1, 7, 2, 1, 1),
(5, 'calculatrice.jpg', 'Calculatrice scientifique', 'Casio FX-92', '2025-02-16T13:00:00', 1, 3, 8, 1, 2, 6),
(6, 'veste.jpg', 'Veste universitaire', 'Taille M, couleur bleue', '2025-02-17T15:00:00', 4, 1, 10, 1, 2, 4),
(7, 'raquette.jpg', 'Raquette de badminton', 'Avec housse', '2025-02-18T10:30:00', 3, 2, 1, 3, 3, 5),
(8, 'livre3.jpg', 'Programmation Python', 'Pour débutants', '2025-02-19T16:00:00', 1, 1, 2, 1, 2, 1);
GO

-- Événements
INSERT INTO Evenement VALUES
(1, 'Grande Collecte de Printemps', 'Collecte générale', 'Collecte de tous types d''objets', '2025-03-15', '2025-03-17', 1, 4),
(2, 'Atelier Réparation Électronique', 'Atelier pratique', 'Apprenez à réparer vos appareils', '2025-03-20', '2025-03-20', 2, 5),
(3, 'Brocante Solidaire', 'Vente et échange', 'Donnez une seconde vie aux objets', '2025-04-05', '2025-04-06', 3, 6),
(4, 'Sensibilisation au Gaspillage', 'Conférence', 'Impact environnemental', '2025-04-10', '2025-04-10', 4, 9);
GO

-- Réservations
INSERT INTO RESERVER VALUES
(4, '2025-02-15', 3, 2),
(7, '2025-02-18', 8, 1);
GO

-- Associations Utilisateur-Département
INSERT INTO REGROUPER VALUES
(1, 1),
(2, 1),
(3, 2),
(7, 4),
(8, 1);
GO

-- Signalements
INSERT INTO Signale VALUES
(2, 3, 'Description ne correspond pas à l''état réel', '2025-02-13T16:00:00'),
(6, 1, 'Taille incorrecte dans la description', '2025-02-17T17:30:00');
GO

-- Inscriptions Événements
INSERT INTO INSCRIRE VALUES
(1, 1),
(2, 1),
(3, 2),
(7, 3),
(8, 4),
(10, 1),
(1, 3);
GO

-- Associations Utilisateur-Notification
INSERT INTO RECEVOIR VALUES
(1, 4),
(2, 2),
(3, 1),
(7, 3),
(8, 2);
GO
