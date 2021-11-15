CREATE DATABASE `beadando`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  PRIMARY KEY(`id`)
);

CREATE TABLE `oldalak` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `szulo_id` int(11) NULL,
  `oldal_azonosito` varchar(255) NOT NULL,
  PRIMARY KEY(`id`)
);

CREATE TABLE `gep` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hely` varchar(255) NOT NULL,
  `tipus` varchar(255) NOT NULL,
  `ipcim` varchar(255) NOT NULL,
  PRIMARY KEY(`id`)
);

CREATE TABLE `szoftver` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nev` varchar(255) NOT NULL,
  `kategoria` varchar(255) NOT NULL,
  PRIMARY KEY(`id`)
);

CREATE TABLE `telepites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gepid` int(11) NOT NULL,
  `szoftverid` int(11) NOT NULL,
  `verzio` varchar(255) NULL,
  `datum` datetime NULL,
  PRIMARY KEY(`id`)
);

ALTER TABLE `telepites`
ADD CONSTRAINT FK_GEP
FOREIGN KEY (`gepid`) REFERENCES `gep`(`id`);

ALTER TABLE `telepites`
ADD CONSTRAINT FK_SZOFTVER
FOREIGN KEY (`szoftverid`) REFERENCES `szoftver`(`id`);
