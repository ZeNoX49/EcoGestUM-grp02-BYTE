USE MASTER;
GO
IF DB_ID('EcoGuest') IS NOT NULL
BEGIN
    ALTER DATABASE EcoGuest SET SINGLE_USER WITH ROLLBACK IMMEDIATE;
    DROP DATABASE EcoGuest;
END
GO
CREATE DATABASE EcoGuest;
GO
USE EcoGuest;
GO

-- Suppression tables si existent (sequence sere)
DROP TABLE IF EXISTS RECEVOIR;
DROP TABLE IF EXISTS INSCRIRE;
DROP TABLE IF EXISTS SIGNALER;
DROP TABLE IF EXISTS REGROUPER;
DROP TABLE IF EXISTS RESERVER;
DROP TABLE IF EXISTS EVENEMENT;
DROP TABLE IF EXISTS OBJET;
DROP TABLE IF EXISTS POINTCOLLECTE;
DROP TABLE IF EXISTS TYPEECHANGE;
DROP TABLE IF EXISTS TYPEEVENEMENT;
DROP TABLE IF EXISTS STATISTIQUE;
DROP TABLE IF EXISTS NOTIFICATION;
DROP TABLE IF EXISTS CONSEIL;
DROP TABLE IF EXISTS TEMOIGNAGE;
DROP TABLE IF EXISTS COMMUNIQUE;
DROP TABLE IF EXISTS RAPPORT;
DROP TABLE IF EXISTS STATUTRESERVATION;
DROP TABLE IF EXISTS STATUTDISPONIBLE;
DROP TABLE IF EXISTS ETAT;
DROP TABLE IF EXISTS DEPSER;
DROP TABLE IF EXISTS CATEGORIE;
DROP TABLE IF EXISTS UTILISATEUR;
DROP TABLE IF EXISTS ROLE;
GO

CREATE TABLE ROLE(
   id_role INT IDENTITY(1,1) PRIMARY KEY,
   nom_role VARCHAR(100) NOT NULL
);

CREATE TABLE UTILISATEUR(
   id_utilisateur INT IDENTITY(1,1) PRIMARY KEY,
   nom_utilisateur VARCHAR(50) NOT NULL,
   prenom_utilisateur VARCHAR(50) NOT NULL,
   email_utilisateur VARCHAR(100) NOT NULL,
   mdp_utilisateur VARCHAR(50),
   id_role INT NULL,
   FOREIGN KEY(id_role) REFERENCES ROLE(id_role) ON DELETE SET NULL
);

CREATE TABLE CATEGORIE(
   id_categorie INT IDENTITY(1,1) PRIMARY KEY,
   nom_categorie VARCHAR(100) NOT NULL,
   description_categorie VARCHAR(250)
);

CREATE TABLE DEPSER(
   id_depser INT IDENTITY(1,1) PRIMARY KEY,
   nom_depser VARCHAR(100) NOT NULL,
   id_utilisateur INT NULL UNIQUE,
   FOREIGN KEY(id_utilisateur) REFERENCES UTILISATEUR(id_utilisateur) ON DELETE SET NULL
);

CREATE TABLE ETAT(
   id_etat INT IDENTITY(1,1) PRIMARY KEY,
   nom_etat VARCHAR(100) NOT NULL
);

CREATE TABLE STATUTDISPONIBLE(
   id_statut_disponibilite INT IDENTITY(1,1) PRIMARY KEY,
   nom_statut_disponibilite VARCHAR(100) NOT NULL
);

CREATE TABLE STATUTRESERVATION(
   id_statut_reservation INT IDENTITY(1,1) PRIMARY KEY,
   nom_statut_reservation VARCHAR(100) NOT NULL
);

CREATE TABLE RAPPORT(
   id_rapport INT IDENTITY(1,1) PRIMARY KEY,
   titre_rapport VARCHAR(100) NOT NULL,
   contenu_rapport VARCHAR(250) NOT NULL,
   date_rapport DATE NOT NULL,
   id_utilisateur INT NULL,
   FOREIGN KEY(id_utilisateur) REFERENCES UTILISATEUR(id_utilisateur) ON DELETE SET NULL
);

CREATE TABLE COMMUNIQUE(
   id_communique INT IDENTITY(1,1) PRIMARY KEY,
   titre_communique VARCHAR(100) NOT NULL,
   contenu_communique VARCHAR(250) NOT NULL,
   date_communique DATETIME NOT NULL,
   id_utilisateur INT NULL,
   FOREIGN KEY(id_utilisateur) REFERENCES UTILISATEUR(id_utilisateur) ON DELETE SET NULL
);

CREATE TABLE TEMOIGNAGE(
   id_temoignage INT IDENTITY(1,1) PRIMARY KEY,
   contenu_temoignage VARCHAR(100) NOT NULL,
   date_temoignage DATETIME NOT NULL,
   id_utilisateur INT NULL,
   FOREIGN KEY(id_utilisateur) REFERENCES UTILISATEUR(id_utilisateur) ON DELETE SET NULL
);

CREATE TABLE CONSEIL(
   id_conseil INT IDENTITY(1,1) PRIMARY KEY,
   titre_conseil VARCHAR(250) NOT NULL,
   contenu_conseil VARCHAR(100) NOT NULL,
   date_conseil DATETIME NOT NULL,
   id_utilisateur INT NULL,
   FOREIGN KEY(id_utilisateur) REFERENCES UTILISATEUR(id_utilisateur) ON DELETE SET NULL
);

CREATE TABLE NOTIFICATION(
   id_notification INT IDENTITY(1,1) PRIMARY KEY,
   contenu_notification VARCHAR(200) NOT NULL,
   date_notification DATETIME NOT NULL
);

CREATE TABLE STATISTIQUE(
   id_statistique INT IDENTITY(1,1) PRIMARY KEY,
   date_statistique DATE NOT NULL,
   type_statistique VARCHAR(50) NOT NULL,
   valeur_statistique VARCHAR(50) NOT NULL,
   id_utilisateur INT NULL,
   FOREIGN KEY(id_utilisateur) REFERENCES UTILISATEUR(id_utilisateur) ON DELETE SET NULL
);

CREATE TABLE TYPEEVENEMENT(
   id_type_evenement INT IDENTITY(1,1) PRIMARY KEY,
   nom_type_evenement VARCHAR(50)
);

CREATE TABLE TYPEECHANGE(
   id_type_echange INT IDENTITY(1,1) PRIMARY KEY,
   nom_type_echange VARCHAR(50)
);

CREATE TABLE POINTCOLLECTE(
   id_point_collecte INT IDENTITY(1,1) PRIMARY KEY,
   adresse_point_collecte VARCHAR(100),
   nom_point_collecte VARCHAR(100)
);

CREATE TABLE OBJET(
   id_objet INT IDENTITY(1,1) PRIMARY KEY,
   image_objet VARCHAR(100),
   nom_objet VARCHAR(100) NOT NULL,
   description_objet VARCHAR(250),
   date_ajout_objet DATETIME NOT NULL,          -- change en DATETIME
   id_point_collecte INT NULL,
   id_type_echange INT NULL,
   id_utilisateur INT NOT NULL,
   id_statut_disponibilite INT NOT NULL,
   id_etat INT NULL,
   id_categorie INT NULL,
   FOREIGN KEY(id_point_collecte) REFERENCES POINTCOLLECTE(id_point_collecte) ON DELETE SET NULL,
   FOREIGN KEY(id_type_echange) REFERENCES TYPEECHANGE(id_type_echange) ON DELETE SET NULL,
   FOREIGN KEY(id_utilisateur) REFERENCES UTILISATEUR(id_utilisateur) ON DELETE CASCADE,
   FOREIGN KEY(id_statut_disponibilite) REFERENCES STATUTDISPONIBLE(id_statut_disponibilite) ON DELETE CASCADE,
   FOREIGN KEY(id_etat) REFERENCES ETAT(id_etat) ON DELETE SET NULL,
   FOREIGN KEY(id_categorie) REFERENCES CATEGORIE(id_categorie) ON DELETE SET NULL
);

CREATE TABLE EVENEMENT(
   id_evenement INT IDENTITY(1,1) PRIMARY KEY,
   titre_evenement VARCHAR(100) NOT NULL,
   type_evenement VARCHAR(100) NOT NULL,
   description_evenement VARCHAR(250),
   date_debut_evenement DATETIME NOT NULL,
   date_fin_evenement DATETIME NOT NULL,
   id_type_evenement INT NULL,
   id_utilisateur INT NOT NULL,
   FOREIGN KEY(id_type_evenement) REFERENCES TYPEEVENEMENT(id_type_evenement) ON DELETE SET NULL,
   FOREIGN KEY(id_utilisateur) REFERENCES UTILISATEUR(id_utilisateur) ON DELETE CASCADE
);

CREATE TABLE RESERVER(
   id_objet INT PRIMARY KEY,
   date_reservation DATE NOT NULL,
   id_utilisateur INT NOT NULL,
   id_statut_reservation INT NOT NULL,
   FOREIGN KEY(id_objet) REFERENCES OBJET(id_objet) ON DELETE CASCADE,
   FOREIGN KEY(id_utilisateur) REFERENCES UTILISATEUR(id_utilisateur) ON DELETE NO ACTION,
   FOREIGN KEY(id_statut_reservation) REFERENCES STATUTRESERVATION(id_statut_reservation) ON DELETE NO ACTION
);

CREATE TABLE REGROUPER(
   id_utilisateur INT,
   id_depser INT,
   PRIMARY KEY(id_utilisateur, id_depser),
   FOREIGN KEY(id_utilisateur) REFERENCES UTILISATEUR(id_utilisateur) ON DELETE CASCADE,
   FOREIGN KEY(id_depser) REFERENCES DEPSER(id_depser) ON DELETE CASCADE
);

CREATE TABLE SIGNALER(
   id_objet INT,
   id_utilisateur INT,
   description_signalement VARCHAR(250),
   date_signalement DATETIME NOT NULL,
   PRIMARY KEY(id_objet, id_utilisateur),
   FOREIGN KEY(id_objet) REFERENCES OBJET(id_objet) ON DELETE CASCADE,
   FOREIGN KEY(id_utilisateur) REFERENCES UTILISATEUR(id_utilisateur) ON DELETE NO ACTION
);

CREATE TABLE INSCRIRE(
   id_utilisateur INT,
   id_evenement INT,
   PRIMARY KEY(id_utilisateur, id_evenement),
   FOREIGN KEY(id_utilisateur) REFERENCES UTILISATEUR(id_utilisateur) ON DELETE CASCADE,
   FOREIGN KEY(id_evenement) REFERENCES EVENEMENT(id_evenement) ON DELETE NO ACTION
);

CREATE TABLE RECEVOIR(
   id_utilisateur INT,
   id_notification INT,
   PRIMARY KEY(id_utilisateur, id_notification),
   FOREIGN KEY(id_utilisateur) REFERENCES UTILISATEUR(id_utilisateur) ON DELETE CASCADE,
   FOREIGN KEY(id_notification) REFERENCES NOTIFICATION(id_notification) ON DELETE NO ACTION
);
GO