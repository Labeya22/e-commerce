-- Active: 1670697101741@@127.0.0.1@3306@ventes_vehicules

DROP DATABASE IF EXISTS ventes_vehicules;

CREATE DATABASE ventes_vehicules;

USE ventes_vehicules;

CREATE TABLE admin(
    admin_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    username VARCHAR(50) UNIQUE NOT NULL,
    lastname VARCHAR(50) NOT NULL,
    createAt DATETIME NOT NULL,
    updateAt DATETIME
);


CREATE TABLE types (
    type_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    type VARCHAR(255) NOT NULL,
    create_at DATETIME NOT NULL
);


CREATE TABLE marques (
    marque_id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    marque VARCHAR(255) NOT NULL UNIQUE,
    create_at DATETIME NOT NULL
);



-- DROP TABLE vehicules;

CREATE TABLE vehicules(
    vehicule_id INT PRIMARY KEY AUTO_INCREMENT,
    vehicule VARCHAR(255) NOT NULL,
    image VARCHAR(255) NOT NULL,
    price FLOAT NOT NULL,
    typeid INT NULL,
    marqueid INT NOT NULL,
    desciption TEXT NOT NULL,
    create_at DATETIME NOT NULL,
    FOREIGN KEY(marqueid) REFERENCES marques(marque_id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(typeid) REFERENCES types(type_id) ON DELETE SET NULL ON UPDATE CASCADE
);

DROP TABLE medias;
CREATE TABLE medias(
    media_id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    vehiculeid INT,
    FOREIGN KEY(vehiculeid) REFERENCES vehicules(vehicule_id) ON DELETE CASCADE ON UPDATE CASCADE,
    media VARCHAR(255) NOT NULL
);




CREATE TABLE utilisateurs(
    utilisateur_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255) NOT NULL,
    utilisateur VARCHAR(50) UNIQUE NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    create_at DATETIME NOT NULL,
    update_at DATETIME
);


CREATE TABLE paniers(
    panier_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    vehiculeid INT NOT NULL,
    utilisateurid INT NOT NULL,
    quantite INT DEFAULT 1 NOT NULL,
    FOREIGN KEY(vehiculeid) REFERENCES vehicules(vehicule_id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(utilisateurid) REFERENCES utilisateurs(utilisateur_id) ON DELETE CASCADE ON UPDATE CASCADE
);

DROP TABLE factures;

CREATE TABLE factures(
    facture_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    sommes FLOAT NOT NULL,
    panierid INT NOT NULL,
    utilisateurid INT NOT NULL,
    FOREIGN KEY(panierid) REFERENCES paniers(panier_id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(utilisateurid) REFERENCES utilisateurs(utilisateur_id) ON DELETE CASCADE ON UPDATE CASCADE
); 




CREATE TABLE parametres(
    param_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    carburant VARCHAR(50) NOT NULL DEFAULT 'essence',
    kilometrage VARCHAR(50) NOT NULL DEFAULT '0kh',
    auto BOOLEAN NOT NULL DEFAULT 1,
    vehiculeid INT NOT NULL UNIQUE,
    FOREIGN KEY(vehiculeid) REFERENCES vehicules(vehicule_id) ON DELETE CASCADE ON UPDATE CASCADE
);

