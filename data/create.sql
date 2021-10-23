CREATE DATABASE `beadando`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY(`id`)
);

CREATE TABLE `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `date_time` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  PRIMARY KEY(`id`)
);

CREATE TABLE `huzas` (
    `id` int(11) NOT NULL,
    `ev` int(11) NOT NULL,
    `het` int(11) NOT NULL,
    PRIMARY KEY (`id`)
);

CREATE TABLE `huzott` (
    `id` int(11) NOT NULL,
    `huzas_id` int(11) NOT NULL,
    `szam` int(11) NOT NULL,
    PRIMARY KEY (`id`)
);

CREATE TABLE `nyeremeny` (
    `id` int(11) NOT NULL,
    `huzas_id` int(11) NOT NULL,
    `talalat` int(11) NOT NULL,
    `darab` int(11) NOT NULL,
    `ertek` int(11) NOT NULL,
    PRIMARY KEY (`id`)
);

ALTER TABLE `huzott`
ADD CONSTRAINT FK_HUZAS
FOREIGN KEY (`huzas_id`) REFERENCES `huzas`(`id`);

ALTER TABLE `nyeremeny`
ADD CONSTRAINT FK_NYEREMENY
FOREIGN KEY (`huzas_id`) REFERENCES `huzas`(`id`);

ALTER TABLE `news`
ADD CONSTRAINT FK_NEWS
FOREIGN KEY (`user_id`) REFERENCES `user`(`id`);
