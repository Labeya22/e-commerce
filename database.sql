-- Active: 1670697101741@@127.0.0.1@3306@ventes_vehicules

DROP DATABASE IF EXISTS `ventes_vehicules`;

CREATE DATABASE IF NOT EXISTS `ventes_vehicules`;

USE `ventes_vehicules`;

CREATE TABLE utilisateurs(
    `utilisateur_id` VARCHAR(100) PRIMARY KEY  NOT NULL,
    `nom` varchar(255) NOT NULL,
    `utilisateur` varchar(50) NOT NULL,
    `prenom` varchar(50) NOT NULL,
    `email` varchar(255) NOT NULL,
    `token` varchar(255),
    `code` varchar(10),
    `password` varchar(255) NOT NULL,
    `isconfirm` tinyint NOT NULL DEFAULT '0',
    `create_at` datetime NOT NULL,
    `update_at` datetime DEFAULT NULL,
    `confirm_at` datetime DEFAULT NULL,
);