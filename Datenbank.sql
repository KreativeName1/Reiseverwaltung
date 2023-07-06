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
  `code` char(2) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `reiseverwaltung`.`ziel` (
  `id` int(40) NOT NULL Auto_Increment,
  `land_id` int(40) NOT NULL,
  `name` int(40) NOT NULL,
  `dauer` int(40) NOT NULL,
  `preis` int(40) NOT NULL,
  `abfahrtsdatum` date NOT NULL,
  `abfahrtszeit` time NOT NULL,
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


-- Password ist "123456789"
INSERT INTO `reiseverwaltung`.`kunde` (vorname, nachname, email, passwort, strasse, hausnummer, plz, ort, gebdat) VALUES
('Vorname', 'Nachname', 'test@mail.com', '$2y$10$aBJkWB0i7PBXaQivfhsYheM9JV/OfgtnrweblERBLuTvn7J6q6aEi', 'Strasse', 1, '12345', 'Ort', '2000-01-01');

INSERT INTO `reiseverwaltung`.`land` (`name`, `code`) VALUES
('Deutschland', 'de'),
('Frankreich', 'fr'),
('Spanien', 'es'),
('Italien', 'it'),
('Österreich', 'at'),
('Schweiz', 'ch'),
('Niederlande', 'nl'),
('Belgien', 'be'),
('Luxemburg', 'lu'),
('Dänemark', 'dk'),
('Polen', 'pl'),
('Tschechien', 'cz'),
('Portugal', 'pt');


-- Deutschland
INSERT INTO ziel (land_id, name, dauer, preis, abfahrtsdatum, abfahrtszeit, freieplaetze)
VALUES (1, 'Berlin Stadtrundfahrt', 3, 100, '2023-08-10', '09:00:00', 0),
  (1, 'München Sightseeing', 2, 150, '2023-05-25', '10:30:00', 10),
  (1, 'Hamburg Hafenrundfahrt', 1, 80, '2023-09-05', '14:00:00', 15),
  (1, 'Köln Dombesichtigung', 2, 120, '2023-08-15', '11:00:00', 5),
  (1, 'Schwarzwald Wandertour', 4, 200, '2023-07-30', '08:00:00', 8),
  (1, 'Dresden Stadtrundgang', 3, 150, '2023-08-20', '10:00:00', 12),
  (1, 'Hannover Zoo', 1, 80, '2023-09-10', '09:00:00', 20),
  (1, 'Frankfurt am Main Skyline', 2, 120, '2023-08-25', '11:30:00', 10),
  (1, 'Nürnberg Altstadt', 1, 80, '2023-09-15', '10:00:00', 15),
  (1, 'Leipzig Zoo', 2, 120, '2023-08-30', '09:00:00', 10);

-- Frankreich
INSERT INTO ziel (land_id, name, dauer, preis, abfahrtsdatum, abfahrtszeit, freieplaetze)
VALUES (2, 'Paris Stadtrundgang', 3, 180, '2023-08-12', '10:00:00', 12),
  (2, 'Côte Azur Strandurlaub', 7, 500, '2023-07-28', '12:00:00', 6),
  (2, 'Loire-Tal Schlossbesichtigung', 2, 150, '2023-09-02', '09:30:00', 20),
  (2, 'Provence Weinverkostung', 1, 80, '2023-08-20', '15:30:00', 10),
  (2, 'Mont Saint-Michel Besuch', 2, 120, '2023-08-18', '11:30:00', 0);

-- Spanien
INSERT INTO ziel (land_id, name, dauer, preis, abfahrtsdatum, abfahrtszeit, freieplaetze)
VALUES (3, 'Barcelona Stadtrundfahrt', 3, 200, '2023-08-15', '10:00:00', 10),
  (3, 'Madrid Museumsbesuch', 2, 150, '2023-07-27', '11:00:00', 8),
  (3, 'Costa del Sol Strandurlaub', 5, 400, '2023-09-08', '12:30:00', 12),
  (3, 'Sevilla Flamenco-Show', 1, 80, '2023-08-10', '19:00:00', 20),
  (3, 'Valencia Aquarium-Besuch', 2, 100, '2023-08-25', '15:00:00', 15);

-- Italien
INSERT INTO ziel (land_id, name, dauer, preis, abfahrtsdatum, abfahrtszeit, freieplaetze)
VALUES (4, 'Rom Sightseeing', 4, 250, '2023-08-05', '10:00:00', 6),
  (4, 'Venedig Gondelfahrt', 2, 150, '2023-07-23', '11:30:00', 10),
  (4, 'Florenz Kunsttour', 3, 180, '2023-09-01', '09:00:00', 8),
  (4, 'Amalfiküste Küstenwanderung', 5, 350, '2023-08-22', '08:30:00', 0),
  (4, 'Mailand Shoppingtour', 2, 120, '2023-08-16', '14:00:00', 15);

-- Österreich
INSERT INTO ziel (land_id, name, dauer, preis, abfahrtsdatum, abfahrtszeit, freieplaetze)
VALUES (5, 'Wien Stadtrundfahrt', 3, 150, '2023-02-11', '10:00:00', 15),
  (5, 'Salzburg Schlossbesichtigung', 2, 120, '2023-07-24', '11:30:00', 20),
  (5, 'Innsbruck Skiausflug', 4, 300, '2023-09-04', '08:00:00', 10),
  (5, 'Graz Altstadtbummel', 1, 80, '2023-08-19', '13:30:00', 8),
  (5, 'Hallstatt Seenschifffahrt', 2, 130, '2023-07-29', '15:00:00', 12);

-- Schweiz
INSERT INTO ziel (land_id, name, dauer, preis, abfahrtsdatum, abfahrtszeit, freieplaetze)
VALUES (6, 'Zürich Stadtrundgang', 2, 180, '2023-08-14', '10:00:00', 12),
  (6, 'Genf Seebootstour', 1, 80, '2023-07-26', '11:00:00', 20),
  (6, 'Bern Altstadtbesichtigung', 2, 150, '2023-09-03', '09:30:00', 15),
  (6, 'Interlaken Abenteueraktivitäten', 3, 250, '2023-08-21', '12:00:00', 10),
  (6, 'Zermatt Matterhorn-Besteigung', 4, 350, '2023-08-17', '13:30:00', 8);

-- Niederlande
INSERT INTO ziel (land_id, name, dauer, preis, abfahrtsdatum, abfahrtszeit, freieplaetze)
VALUES (7, 'Amsterdam Grachtenfahrt', 2, 120, '2023-05-13', '10:00:00', 3),
  (7, 'Den Haag Museumsbesuch', 1, 80, '2023-07-22', '11:30:00', 12),
  (7, 'Rotterdam Hafenrundfahrt', 2, 150, '2023-09-07', '08:30:00', 20),
  (7, 'Utrecht Domturm-Besteigung', 1, 90, '2023-08-24', '14:00:00', 10),
  (7, 'Maastricht Altstadtbummel', 2, 130, '2023-07-31', '15:30:00', 8);
-- Belgien
INSERT INTO ziel (land_id, name, dauer, preis, abfahrtsdatum, abfahrtszeit, freieplaetze)
VALUES (8, 'Brüssel Stadtrundgang', 2, 120, '2023-08-13', '10:00:00', 12),
  (8, 'Antwerpen Hafenrundfahrt', 1, 80, '2023-07-25', '11:00:00', 20),
  (8, 'Gent Altstadtbesichtigung', 2, 150, '2023-09-05', '09:30:00', 15),
  (8, 'Brügge Grachtenfahrt', 1, 90, '2023-08-23', '14:00:00', 10),
  (8, 'Lüttich Museumsbesuch', 2, 130, '2023-07-30', '15:30:00', 8);
-- Luxemburg
INSERT INTO ziel (land_id, name, dauer, preis, abfahrtsdatum, abfahrtszeit, freieplaetze)
VALUES (9, 'Luxemburg Stadtrundgang', 2, 120, '2023-08-12', '10:00:00', 12),
  (9, 'Echternach Wandertour', 1, 80, '2023-07-21', '11:00:00', 20),
  (9, 'Vianden Burgbesichtigung', 2, 150, '2023-09-06', '09:30:00', 15),
  (9, 'Müllerthal Wanderung', 1, 90, '2023-08-22', '14:00:00', 10),
  (9, 'Clervaux Schlossbesichtigung', 2, 130, '2023-07-28', '15:30:00', 8);
-- Dänemark
INSERT INTO ziel (land_id, name, dauer, preis, abfahrtsdatum, abfahrtszeit, freieplaetze)
VALUES (10, 'Kopenhagen Stadtrundgang', 2, 120, '2023-08-11', '10:00:00', 12),
  (10, 'Aarhus Hafenrundfahrt', 1, 80, '2023-07-20', '11:00:00', 20),
  (10, 'Odense Altstadtbesichtigung', 2, 150, '2023-09-08', '09:30:00', 15),
  (10, 'Aalborg Grachtenfahrt', 1, 90, '2023-08-21', '14:00:00', 10),
  (10, 'Esbjerg Museumsbesuch', 2, 130, '2023-07-27', '15:30:00', 8);
-- Schweden
INSERT INTO ziel (land_id, name, dauer, preis, abfahrtsdatum, abfahrtszeit, freieplaetze)
VALUES (11, 'Stockholm Stadtrundgang', 2, 120, '2023-08-10', '10:00:00', 12),
  (11, 'Göteborg Hafenrundfahrt', 1, 80, '2023-07-19', '11:00:00', 20),
  (11, 'Malmö Altstadtbesichtigung', 2, 150, '2023-09-09', '09:30:00', 15),
  (11, 'Uppsala Grachtenfahrt', 1, 90, '2023-08-20', '14:00:00', 10),
  (11, 'Lund Museumsbesuch', 2, 130, '2023-07-26', '15:30:00', 8);
-- Norwegen
INSERT INTO ziel (land_id, name, dauer, preis, abfahrtsdatum, abfahrtszeit, freieplaetze)
VALUES (12, 'Oslo Stadtrundgang', 2, 120, '2023-08-09', '10:00:00', 12),
  (12, 'Bergen Hafenrundfahrt', 1, 80, '2023-07-18', '11:00:00', 20),
  (12, 'Trondheim Altstadtbesichtigung', 2, 150, '2023-09-10', '09:30:00', 15),
  (12, 'Stavanger Grachtenfahrt', 1, 90, '2023-08-19', '14:00:00', 10),
  (12, 'Drammen Museumsbesuch', 2, 130, '2023-07-25', '15:30:00', 8);
-- Finnland
INSERT INTO ziel (land_id, name, dauer, preis, abfahrtsdatum, abfahrtszeit, freieplaetze)
VALUES (13, 'Helsinki Stadtrundgang', 2, 120, '2023-08-08', '10:00:00', 12),
  (13, 'Turku Hafenrundfahrt', 1, 80, '2023-07-17', '11:00:00', 20),
  (13, 'Tampere Altstadtbesichtigung', 2, 150, '2023-09-11', '09:30:00', 15),
  (13, 'Oulu Grachtenfahrt', 1, 90, '2023-08-18', '14:00:00', 10),
  (13, 'Lahti Museumsbesuch', 2, 130, '2023-07-24', '15:30:00', 8);
