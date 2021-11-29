CREATE OR REPLACE DATABASE `beadando`;
USE `beadando`;


CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(255) NOT NULL COMMENT 'A felhasználó vezetékneve',
  `lastName` varchar(255) NOT NULL COMMENT 'A felhasználó utóneve',
  `email` varchar(255) NOT NULL COMMENT 'A felhasználó email címe',
  `password` varchar(255) NOT NULL COMMENT 'A felhasználó hash-elt jelszava',
  `role` int(11) NOT NULL COMMENT 'A felhasználó szerepköre - 2 regisztrált látogató - 3 admin',
  PRIMARY KEY(`id`)
);

CREATE TABLE `oldalak` (
  `id` int(11) NOT NULL COMMENT 'Az oldal elsődleges azonosítója',
  `tartalom` text null COMMENT 'A megjelenítendő tartalom',
  `szulo_id` int(11) NULL COMMENT 'Az oldalak struktúráját határozza meg',
  `oldal_azonosito` varchar(255) NOT NULL COMMENT 'Az URL generáláshoz szükséges',
  `kattinthato` boolean NOT NULL DEFAULT false COMMENT 'Az oldal megjeleníthető-e',
  `jogosultsag` int(11) NOT NULL COMMENT '1 látogató - 2 regisztrált látogató - 3 admin',
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
FOREIGN KEY (`gepid`) REFERENCES `gep`(`id`)
ON DELETE CASCADE;

ALTER TABLE `telepites`
ADD CONSTRAINT FK_SZOFTVER
FOREIGN KEY (`szoftverid`) REFERENCES `szoftver`(`id`)
ON DELETE CASCADE;
