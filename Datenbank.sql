-- SQLBook: Code

CREATE DATABASE `reiseverwaltung`;

CREATE TABLE `reiseverwaltung`.`kunde` (
  `id` int(40) NOT NULL Auto_Increment,
  `vorname` varchar(40) NOT NULL,
  `nachname` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `passwort` varchar(255) NOT NULL,
  `strasse` varchar(40) NOT NULL,
  `hausnummer` int(40) NOT NULL,
  `plz` varchar(40) NOT NULL,
  `ort` varchar(40) NOT NULL,
  `gebdat` date NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `reiseverwaltung`.`land` (
  `id` int(40) NOT NULL Auto_Increment,
  `name` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `reiseverwaltung`.`ziel` (
  `id` int(40) NOT NULL Auto_Increment,
  `land_id` int(40) NOT NULL,
  `name` int(40) NOT NULL,
  `dauer` int(40) NOT NULL,
  `preis` int(40) NOT NULL,
  `abfahrtsdatum` date NOT NULL,
  `abfahrtszeit` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `freieplaetze` int(40) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`land_id`) REFERENCES `land`(`id`)
);

CREATE TABLE `reiseverwaltung`.`buchung` (
  `id` int(40) NOT NULL Auto_Increment,
  `kunde_id` int(40) NOT NULL,
  `ziel_id` int(40) NOT NULL,
  `datum` date NOT NULL,
  `uhrzeit` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `anzahl` int(40) NOT NULL,
  `einsteigsort` varchar(40) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`kunde_id`) REFERENCES `kunde`(`id`),
  FOREIGN KEY (`ziel_id`) REFERENCES `ziel`(`id`)
);

-- füge alle Lände in deutscher Sprache ein
INSERT INTO `reiseverwaltung`.`land` (`name`) VALUES ('Deutschland');
INSERT INTO `reiseverwaltung`.`land` (`name`) VALUES ('Frankreich');
INSERT INTO `reiseverwaltung`.`land` (`name`) VALUES ('Spanien');
INSERT INTO `reiseverwaltung`.`land` (`name`) VALUES ('Italien');
INSERT INTO `reiseverwaltung`.`land` (`name`) VALUES ('Österreich');
INSERT INTO `reiseverwaltung`.`land` (`name`) VALUES ('Schweiz');
INSERT INTO `reiseverwaltung`.`land` (`name`) VALUES ('Niederlande');
INSERT INTO `reiseverwaltung`.`land` (`name`) VALUES ('Belgien');
INSERT INTO `reiseverwaltung`.`land` (`name`) VALUES ('Luxemburg');
INSERT INTO `reiseverwaltung`.`land` (`name`) VALUES ('Dänemark');
INSERT INTO `reiseverwaltung`.`land` (`name`) VALUES ('Polen');
INSERT INTO `reiseverwaltung`.`land` (`name`) VALUES ('Tschechien');
INSERT INTO `reiseverwaltung`.`land` (`name`) VALUES ('Deutschland');

INSERT INTO `reiseverwaltung`.`ziel` (land_id, name, dauer, preis, abfahrtsdatum, abfahrtszeit, freieplaetze) VALUES
(1, 'Berlin', 5, 500, '2023-08-10', '2023-08-10 10:00:00', 10),
(2, 'Paris', 7, 800, '2023-09-15', '2023-09-15 14:30:00', 5),
(3, 'Rom', 4, 600, '2023-08-20', '2023-08-20 09:45:00', 8),
(4, 'London', 6, 700, '2023-09-01', '2023-09-01 11:00:00', 12),
(5, 'Madrid', 3, 400, '2023-08-05', '2023-08-05 13:15:00', 15),
(6, 'Tokio', 10, 1500, '2023-10-10', '2023-10-10 08:30:00', 3),
(7, 'New York', 8, 1200, '2023-09-25', '2023-09-25 12:45:00', 6),
(8, 'Sydney', 12, 2000, '2023-11-05', '2023-11-05 07:00:00', 2),
(9, 'Kairo', 5, 600, '2023-08-15', '2023-08-15 10:30:00', 9),
(10, 'Peking', 9, 1300, '2023-10-01', '2023-10-01 09:15:00', 4),
(11, 'Istanbul', 6, 800, '2023-09-05', '2023-09-05 11:30:00', 10),
(12, 'Rio de Janeiro', 14, 2500, '2023-12-01', '2023-12-01 06:45:00', 1),
(13, 'Moskau', 7, 900, '2023-09-10', '2023-09-10 10:45:00', 7),
(14, 'Hamburg', 3, 300, '2023-07-20', '2023-07-20 14:00:00', 15),
(15, 'Nizza', 5, 700, '2023-08-25', '2023-08-25 11:30:00', 8),
(16, 'Florenz', 4, 550, '2023-08-30', '2023-08-30 09:15:00', 12),
(17, 'Manchester', 6, 650, '2023-09-08', '2023-09-08 13:30:00', 9),
(18, 'Barcelona', 7, 800, '2023-09-18', '2023-09-18 10:45:00', 7),
(19, 'Kyoto', 8, 1400, '2023-10-05', '2023-10-05 08:00:00', 5),
(20, 'Los Angeles', 10, 1600, '2023-10-20', '2023-10-20 12:15:00', 3);