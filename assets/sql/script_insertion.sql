/*=============================================================
  Projet : BYTE
  Fichier : script insertion.sql
  Auteurs : Envel CROQ
  Date de creation : 23/10/2025
==============================================================*/


USE SAE3;
GO

-- Roles
INSERT INTO Role VALUES
(1, 'etudiant'),
(2, 'Enseignant'),
(3, 'Presidence de l''universite');
GO

-- Utilisateurs
INSERT INTO Utilisateur VALUES
(1, 'Dupont', 'Marie', 'marie.dupont@univ-lemans.fr', 'mdp123', 1),
(2, 'Martin', 'Pierre', 'pierre.martin@univ-lemans.fr', 'mdp456', 1),
(3, 'Durand', 'Sophie', 'sophie.durand@univ-lemans.fr', 'mdp789', 1),
(4, 'Bernard', 'Luc', 'luc.bernard@univ-lemans.fr', 'mdp321', 2),
(5, 'Petit', 'Anne', 'anne.petit@univ-lemans.fr', 'mdp654', 2),
(6, 'Moreau', 'Jean', 'jean.moreau@univ-lemans.fr', 'mdp987', 3),
(7, 'Leroy', 'Claire', 'claire.leroy@univ-lemans.fr', 'mdp147', 1),
(8, 'Simon', 'Paul', 'paul.simon@univ-lemans.fr', 'mdp258', 1),
(9, 'Laurent', 'Emma', 'emma.laurent@univ-lemans.fr', 'mdp369', 2),
(10, 'Lefebvre', 'Thomas', 'thomas.lefebvre@univ-lemans.fr', 'mdp741', 1);
GO

-- Categories
INSERT INTO Categorie VALUES
(1, 'Livres', 'Manuels scolaires et ouvrages universitaires'),
(2, 'electronique', 'Materiel informatique et electronique'),
(3, 'Mobilier', 'Meubles et equipements de bureau'),
(4, 'Vetements', 'Vetements et accessoires'),
(5, 'Sport', 'equipements sportifs'),
(6, 'Papeterie', 'Fournitures de bureau et scolaires');
GO

-- Departements / Services
INSERT INTO DepSer VALUES
(1, 'Departement Informatique', 4),
(2, 'Departement Mathematiques', 5),
(3, 'Service Administratif', 6),
(4, 'Departement Langues', 9);
GO

-- etats
INSERT INTO Etat VALUES
(1, 'Neuf'),
(2, 'Tres bon etat'),
(3, 'Bon etat'),
(4, 'etat moyen'),
(5, 'Usage');
GO

-- Statuts disponibilite
INSERT INTO STATUTDISPONIBLE VALUES
(1, 'Disponible'),
(2, 'Reserve'),
(3, 'Prete'),
(4, 'Indisponible');
GO

-- Statuts reservation
INSERT INTO STATUTRESERVATION VALUES
(1, 'En attente'),
(2, 'Confirmee'),
(3, 'Annulee'),
(4, 'Completee');
GO

-- Types deechange
INSERT INTO TypeEchange VALUES
(1, 'Don'),
(2, 'Pret'),
(3, 'echange');
GO

-- Types deevenement
INSERT INTO TypeEvenement VALUES
(1, 'Collecte'),
(2, 'Atelier de reparation'),
(3, 'Brocante solidaire'),
(4, 'Sensibilisation');
GO

-- Points de collecte
INSERT INTO PointCollecte VALUES
(1, 'Betiment A, RDC', 'Point Central Campus'),
(2, 'Bibliotheque Universitaire', 'Point BU'),
(3, 'Restaurant Universitaire', 'Point RU'),
(4, 'Maison des etudiants', 'Point MDE');
GO

-- Rapports
INSERT INTO Rapport VALUES
(1, 'Rapport mensuel janvier', 'Bilan des activites du mois', '2025-01-31', 6),
(2, 'Analyse des dons', 'Statistiques sur les objets donnes', '2025-02-15', 4),
(3, 'Rapport trimestriel', 'Synthese du premier trimestre', '2025-03-31', 6);
GO

-- Communiques
INSERT INTO Communique VALUES
(1, 'Nouvelle plateforme', 'Lancement de la plateforme anti-gaspillage', '2025-01-15T10:00:00', 6),
(2, 'Collecte speciale', 'Grande collecte de materiel informatique', '2025-02-01T09:00:00', 4),
(3, 'Bilan positif', 'Merci pour votre participation', '2025-02-28T14:30:00', 6);
GO

-- Temoignages
INSERT INTO Temoignage VALUES
(1, 'Tres satisfait de cette initiative, j''ai pu trouver les livres dont j''avais besoin', '2025-02-10T11:00:00', 1),
(2, 'Super concept ! J''ai donne mon ancien ordinateur qui peut servir e d''autres', '2025-02-15T16:30:00', 2),
(3, 'Plateforme facile e utiliser, je recommande', '2025-02-20T10:15:00', 3);
GO

-- Conseils
INSERT INTO Conseil VALUES
(1, 'Comment bien donner', 'Assurez-vous que vos objets soient propres et en bon etat', '2025-01-20T10:00:00', 4),
(2, 'Reduire le gaspillage', 'Pensez e reparer avant de jeter', '2025-02-05T14:00:00', 5),
(3, 'Organiser son don', 'Apportez vos objets aux points de collecte', '2025-02-18T09:00:00', 9);
GO

-- Notifications
INSERT INTO Notification VALUES
(1, 'Votre reservation a ete confirmee', '2025-02-20T10:30:00'),
(2, 'Nouvel objet disponible dans votre categorie favorite', '2025-02-21T14:00:00'),
(3, 'Un evenement se deroule demain sur le campus', '2025-02-22T08:00:00'),
(4, 'Votre don a bien ete enregistre', '2025-02-23T11:00:00');
GO

-- Statistiques
INSERT INTO Statistique VALUES
(1, '2025-01-31', 'Objets donnes', '125', 6),
(2, '2025-01-31', 'Utilisateurs actifs', '89', 6),
(3, '2025-02-28', 'Objets donnes', '156', 6),
(4, '2025-02-28', 'Reservations', '67', 6);
GO

-- Objets
INSERT INTO Objet VALUES
(1, 'livre1.jpg', 'Manuel de Mathematiques L1', 'Analyse et algebre lineaire', '2025-02-10T10:00:00', 1, 1, 1, 1, 2, 1),
(2, 'ordi1.jpg', 'Ordinateur portable HP', 'Core i5, 8Go RAM, bon etat', '2025-02-12T14:30:00', 2, 2, 2, 1, 3, 2),
(3, 'bureau1.jpg', 'Bureau etudiant', 'Bureau avec tiroirs', '2025-02-14T09:00:00', 4, 1, 3, 1, 2, 3),
(4, 'livre2.jpg', 'Dictionnaire Anglais-Franeais', 'edition recente', '2025-02-15T11:00:00', 2, 1, 7, 2, 1, 1),
(5, 'calculatrice.jpg', 'Calculatrice scientifique', 'Casio FX-92', '2025-02-16T13:00:00', 1, 3, 8, 1, 2, 6),
(6, 'veste.jpg', 'Veste universitaire', 'Taille M, couleur bleue', '2025-02-17T15:00:00', 4, 1, 10, 1, 2, 4),
(7, 'raquette.jpg', 'Raquette de badminton', 'Avec housse', '2025-02-18T10:30:00', 3, 2, 1, 3, 3, 5),
(8, 'livre3.jpg', 'Programmation Python', 'Pour debutants', '2025-02-19T16:00:00', 1, 1, 2, 1, 2, 1);
GO

-- evenements
INSERT INTO Evenement VALUES
(1, 'Grande Collecte de Printemps', 'Collecte generale', 'Collecte de tous types d''objets', '2025-03-15', '2025-03-17', 1, 4),
(2, 'Atelier Reparation electronique', 'Atelier pratique', 'Apprenez e reparer vos appareils', '2025-03-20', '2025-03-20', 2, 5),
(3, 'Brocante Solidaire', 'Vente et echange', 'Donnez une seconde vie aux objets', '2025-04-05', '2025-04-06', 3, 6),
(4, 'Sensibilisation au Gaspillage', 'Conference', 'Impact environnemental', '2025-04-10', '2025-04-10', 4, 9);
GO

-- Reservations
INSERT INTO RESERVER VALUES
(4, '2025-02-15', 3, 2),
(7, '2025-02-18', 8, 1);
GO

-- Associations Utilisateur-Departement
INSERT INTO REGROUPER VALUES
(1, 1),
(2, 1),
(3, 2),
(7, 4),
(8, 1);
GO

-- Signalements
INSERT INTO Signale VALUES
(2, 3, 'Description ne correspond pas e l''etat reel', '2025-02-13T16:00:00'),
(6, 1, 'Taille incorrecte dans la description', '2025-02-17T17:30:00');
GO

-- Inscriptions evenements
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
