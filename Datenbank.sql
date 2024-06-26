-- SQLBook: Code

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
  `name` varchar(40) NOT NULL,
  `dauer` int(40) NOT NULL,
  `preis` int(40) NOT NULL,
  `abfahrtsdatum` date NOT NULL,
  `abfahrtszeit` time NOT NULL,
  `freieplaetze` int(40) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`land_id`) REFERENCES `land`(`id`)
);

CREATE TABLE `reiseverwaltung`.`einstiegsort` (
  `id` int(40) NOT NULL Auto_Increment,
  `name` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `reiseverwaltung`.`buchung` (
  `id` int(40) NOT NULL Auto_Increment,
  `kunde_id` int(40) NOT NULL,
  `ziel_id` int(40) NOT NULL,
  `einstiegs_id` int(40) NOT NULL,
  `zeitstempel` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `personen` int(40) NOT NULL,
  `status` enum('offen','gebucht','storniert') NOT NULL DEFAULT 'offen',
  PRIMARY KEY (`id`),
  FOREIGN KEY (`kunde_id`) REFERENCES `kunde`(`id`),
  FOREIGN KEY (`ziel_id`) REFERENCES `ziel`(`id`),
  FOREIGN KEY (`einstiegs_id`) REFERENCES `einstiegsort`(`id`)
);

-- ALTER TABLE `reiseverwaltung`.`kunde` ADD `status` enum('offen','gebucht','storniert') NOT NULL DEFAULT 'offen' AFTER `personen`;

CREATE VIEW land_ziel AS
SELECT land.name as land_name, land.code AS land_code, ziel.name AS ziel, dauer, preis, abfahrtsdatum, abfahrtszeit, freieplaetze, ziel.id as ziel_id
FROM land
INNER JOIN ziel ON land.id = ziel.land_id;



-- * Password ist "123456789"
INSERT INTO `reiseverwaltung`.`kunde` (vorname, nachname, email, passwort, strasse, hausnummer, plz, ort, gebdat) VALUES
('Vorname', 'Nachname', 'test@mail.com', '$2y$10$aBJkWB0i7PBXaQivfhsYheM9JV/OfgtnrweblERBLuTvn7J6q6aEi', 'Strasse', 1, '12345', 'Ort', '2000-01-01');

-- * Generiert von GitHub Copilot
INSERT INTO `reiseverwaltung`.`land` (`name`, `code`) VALUES
('Belgien', 'be'),
('Bulgarien', 'bg'),
('Dänemark', 'dk'),
('Deutschland', 'de'),
('Estland', 'ee'),
('Finnland', 'fi'),
('Frankreich', 'fr'),
('Griechenland', 'gr'),
('Spanien', 'es'),
('Italien', 'it'),
('Österreich', 'at'),
('Schweiz', 'ch'),
('Niederlande', 'nl'),
('Luxemburg', 'lu'),
('Polen', 'pl'),
('Tschechien', 'cz'),
('Portugal', 'pt'),
('Schweden', 'se'),
('Ungarn', 'hu'),
('Irland', 'ie'),
('Kroatien', 'hr'),
('Litauen', 'lt'),
('Slowakei', 'sk'),
('Slowenien', 'si'),
('Rumänien', 'ro'),
('Zypern', 'cy'),
('Malta', 'mt'),
('Lettland', 'lv'),
('Türkei', 'tr');


-- * Generiert von ChatGPT

INSERT INTO ziel (`land_id`, `name`, `dauer`, `preis`, `abfahrtsdatum`, `abfahrtszeit`, `freieplaetze`) VALUES
(1, 'Berlin Stadtrundfahrt', 3, 100, '2023-08-10', '09:00:00', 0),
(1, 'Hamburg Hafenrundfahrt', 2, 80, '2023-08-12', '14:00:00', 3),
(1, 'Brüssel Sightseeing', 4, 120, '2023-08-15', '11:00:00', 10),
(1, 'Antwerpen Stadtrundgang', 2, 90, '2023-08-20', '13:00:00', 5),
(1, 'Gent Kanalfahrt', 1, 60, '2023-08-25', '10:00:00', 8),
(2, 'Sofia Stadtrundfahrt', 3, 110, '2023-08-11', '10:30:00', 2),
(2, 'Goldstrand Strandtour', 5, 150, '2023-08-14', '09:30:00', 6),
(2, 'Plowdiw Altstadtbesichtigung', 2, 85, '2023-08-19', '15:30:00', 4),
(2, 'Witoscha Bergwanderung', 6, 180, '2023-08-23', '12:30:00', 12),
(2, 'Warna Hafenrundgang', 1, 70, '2023-08-28', '11:30:00', 7),
(3, 'Kopenhagen Schlossbesichtigung', 4, 130, '2023-08-13', '14:45:00', 1),
(3, 'Aarhus Museumsbesuch', 3, 95, '2023-08-16', '10:45:00', 2),
(3, 'Odense Radtour', 2, 75, '2023-08-21', '09:45:00', 3),
(3, 'Roskilde Domführung', 1, 55, '2023-08-26', '13:45:00', 0),
(3, 'Esbjerg Hafenbesichtigung', 2, 85, '2023-08-30', '11:45:00', 4),
(4, 'Berlin Stadtrundfahrt', 3, 100, '2023-08-10', '09:00:00', 0),
(4, 'München Schloss Nymphenburg', 4, 120, '2023-08-14', '12:00:00', 2),
(4, 'Hamburg Hafenrundfahrt', 2, 80, '2023-08-19', '14:00:00', 5),
(4, 'Köln Domführung', 1, 60, '2023-08-24', '10:00:00', 8),
(4, 'Frankfurt Museumsbesuch', 3, 90, '2023-08-29', '11:00:00', 3),
(5, 'Tallinn Altstadtspaziergang', 2, 70, '2023-08-11', '10:00:00', 3),
(5, 'Pärnu Strandaufenthalt', 4, 150, '2023-08-16', '13:00:00', 7),
(5, 'Narva Festungstour', 3, 110, '2023-08-21', '11:00:00', 4),
(5, 'Tartu Universitätsbesichtigung', 2, 80, '2023-08-25', '09:00:00', 5),
(5, 'Haapsalu Schlossführung', 1, 50, '2023-08-30', '12:00:00', 1),
(6, 'Helsinki Stadtrundfahrt', 3, 100, '2023-08-12', '09:30:00', 2),
(6, 'Tampere Seenrundfahrt', 2, 75, '2023-08-17', '14:30:00', 3),
(6, 'Turku Altstadtwanderung', 1, 50, '2023-08-22', '10:30:00', 1),
(6, 'Rovaniemi Nordlichter-Tour', 5, 200, '2023-08-27', '11:30:00', 10),
(6, 'Porvoo Kanalfahrt', 2, 80, '2023-08-31', '13:30:00', 4),
(7, 'Paris Stadtrundfahrt', 4, 120, '2023-08-13', '10:00:00', 2),
(7, 'Versailles Schlossbesichtigung', 3, 90, '2023-08-18', '12:00:00', 4),
(7, 'Lyon Altstadtspaziergang', 2, 70, '2023-08-23', '09:00:00', 5),
(7, 'Marseille Hafenrundfahrt', 1, 50, '2023-08-28', '14:00:00', 1),
(7, 'Nizza Strandtag', 4, 150, '2023-09-02', '10:00:00', 7),
(8, 'Athen Akropolis-Tour', 3, 110, '2023-08-14', '11:30:00', 3),
(8, 'Santorin Inselrundfahrt', 5, 180, '2023-08-19', '14:30:00', 9),
(8, 'Thessaloniki Stadtrundgang', 2, 85, '2023-08-24', '10:30:00', 4),
(8, 'Rhodos Altstadtbesichtigung', 3, 100, '2023-08-29', '11:30:00', 6),
(8, 'Kreta Strandtag', 4, 120, '2023-09-03', '13:30:00', 5),
(9, 'Madrid Stadtrundfahrt', 3, 100, '2023-08-15', '09:00:00', 1),
(9, 'Barcelona Gaudí-Tour', 4, 130, '2023-08-20', '12:00:00', 3),
(9, 'Valencia Strandtag', 2, 80, '2023-08-25', '10:00:00', 4),
(9, 'Sevilla Alcazar-Besichtigung', 3, 90, '2023-08-30', '14:00:00', 2),
(9, 'Bilbao Guggenheim-Museum', 2, 75, '2023-09-04', '11:00:00', 5),
(10, 'Rom Kolosseum-Tour', 4, 120, '2023-08-16', '10:30:00', 2),
(10, 'Venedig Gondelfahrt', 3, 110, '2023-08-21', '13:30:00', 4),
(10, 'Florenz Museumsbesuch', 2, 90, '2023-08-26', '09:30:00', 3),
(10, 'Mailand Shoppingtour', 1, 60, '2023-08-31', '12:30:00', 2),
(10, 'Neapel Pompeji-Ausflug', 4, 130, '2023-09-05', '11:30:00', 6),
(10, 'Sizilien Inselrundfahrt', 5, 150, '2023-09-10', '14:30:00', 8),
(11, 'Wien Stadtrundgang', 3, 100, '2023-08-17', '09:00:00', 2),
(11, 'Salzburg Schloss Hellbrunn', 2, 80, '2023-08-22', '12:00:00', 3),
(11, 'Innsbruck Bergisel-Schanze', 1, 50, '2023-08-27', '10:00:00', 1),
(11, 'Graz Altstadtbesichtigung', 2, 75, '2023-09-01', '13:00:00', 4),
(11, 'Linz Donauschifffahrt', 3, 90, '2023-09-06', '11:00:00', 5),
(12, 'Zürich Stadtrundfahrt', 3, 100, '2023-08-18', '10:30:00', 2),
(12, 'Genf Seepromenade', 2, 70, '2023-08-23', '13:30:00', 3),
(12, 'Bern Altstadtrundgang', 1, 50, '2023-08-28', '09:30:00', 1),
(12, 'Basel Museumsbesuch', 2, 80, '2023-09-02', '12:30:00', 4),
(12, 'Lausanne Schlossführung', 3, 90, '2023-09-07', '10:30:00', 2),
(13, 'Amsterdam Grachtenfahrt', 3, 100, '2023-08-19', '11:00:00', 1),
(13, 'Den Haag Madurodam', 2, 80, '2023-08-24', '14:00:00', 3),
(13, 'Rotterdam Hafenrundfahrt', 1, 50, '2023-08-29', '10:00:00', 2),
(13, 'Utrecht Domturm-Besteigung', 2, 75, '2023-09-03', '13:00:00', 4),
(13, 'Eindhoven Technikmuseum', 3, 90, '2023-09-08', '11:00:00', 5),
(14, 'Luxemburg-Stadt Altstadtspaziergang', 3, 100, '2023-08-20', '09:30:00', 2),
(14, 'Vianden Burgbesichtigung', 2, 80, '2023-08-25', '12:30:00', 3),
(14, 'Echternach Wandertour', 1, 50, '2023-08-30', '09:30:00', 1),
(14, 'Diekirch Brauereibesichtigung', 2, 75, '2023-09-04', '12:30:00', 4),
(14, 'Müllerthal Felsenwanderung', 3, 90, '2023-09-09', '10:30:00', 2),
(15, 'Warschau Stadtrundfahrt', 3, 100, '2023-08-21', '10:00:00', 2),
(15, 'Krakau Altstadtbesichtigung', 2, 80, '2023-08-26', '13:00:00', 3),
(15, 'Breslau Oder-Schifffahrt', 1, 50, '2023-08-31', '11:00:00', 1),
(15, 'Danzig Marienburg-Tour', 3, 90, '2023-09-05', '14:00:00', 4),
(15, 'Poznań Marktplatz-Besuch', 2, 75, '2023-09-10', '10:00:00', 5),
(16, 'Prag Karlsbrücke-Besichtigung', 3, 100, '2023-08-22', '11:30:00', 3),
(16, 'Brünn Altstadtrundgang', 2, 80, '2023-08-27', '14:30:00', 4),
(16, 'Pilsen Bierbrauerei-Tour', 1, 50, '2023-09-01', '10:30:00', 2),
(16, 'Karlovy Vary Kurort-Besuch', 3, 90, '2023-09-06', '13:30:00', 5),
(16, 'Český Krumlov Schlossbesichtigung', 2, 75, '2023-09-11', '11:30:00', 3),
(17, 'Lissabon Stadtrundfahrt', 3, 100, '2023-08-23', '10:00:00', 2),
(17, 'Porto Weintour', 2, 80, '2023-08-28', '13:00:00', 3),
(17, 'Faro Strandausflug', 1, 50, '2023-09-02', '09:00:00', 1),
(17, 'Sintra Palastbesichtigung', 3, 90, '2023-09-07', '12:00:00', 4),
(17, 'Coimbra Universitätstour', 2, 75, '2023-09-12', '10:00:00', 5),
(18, 'Stockholm Stadtrundfahrt', 3, 100, '2023-08-24', '11:30:00', 3),
(18, 'Gotland Inselhopping', 4, 120, '2023-08-29', '14:30:00', 6),
(18, 'Malmö Schloss Malmöhus', 2, 85, '2023-09-03', '10:30:00', 4),
(18, 'Göteborg Hafenrundfahrt', 3, 100, '2023-09-08', '13:30:00', 7),
(18, 'Kiruna Nordlichter-Tour', 5, 150, '2023-09-13', '11:30:00', 8),
(19, 'Budapest Stadtrundfahrt', 3, 110, '2023-08-25', '10:00:00', 2),
(19, 'Balaton Seeuferwanderung', 2, 80, '2023-08-30', '13:00:00', 3),
(19, 'Esztergom Basilika-Besichtigung', 1, 50, '2023-09-04', '11:00:00', 1),
(19, 'Pécs Altstadtspaziergang', 2, 75, '2023-09-09', '14:00:00', 4),
(19, 'Debrecen Tierparkbesuch', 3, 90, '2023-09-14', '12:00:00', 5),
(20, 'Dublin Stadtrundgang', 3, 100, '2023-08-26', '09:30:00', 2),
(20, 'Galway Cliffs of Moher', 4, 130, '2023-08-31', '12:30:00', 4),
(20, 'Cork Hafenrundfahrt', 2, 80, '2023-09-05', '10:30:00', 4),
(20, 'Belfast Titanic Museum', 3, 90, '2023-09-10', '14:30:00', 2),
(20, 'Killarney Nationalpark-Tour', 2, 75, '2023-09-15', '11:30:00', 5),
(21, 'Zagreb Stadtrundgang', 3, 100, '2023-08-27', '10:00:00', 2),
(21, 'Split Diokletianpalast', 2, 80, '2023-09-01', '13:00:00', 3),
(21, 'Dubrovnik Stadtmauerrundgang', 1, 50, '2023-09-06', '09:00:00', 1),
(21, 'Zadar Sonnenuntergangs-Tour', 3, 90, '2023-09-11', '12:00:00', 4),
(21, 'Plitvicer Seen Wanderung', 2, 75, '2023-09-16', '10:00:00', 5),
(22, 'Vilnius Altstadtrundgang', 3, 100, '2023-08-28', '11:30:00', 3),
(22, 'Kaunas Schloss Rundfahrt', 4, 120, '2023-09-02', '14:30:00', 6),
(22, 'Klaipėda Hafenbesichtigung', 2, 85, '2023-09-07', '10:30:00', 4),
(22, 'Trakai Inselburg-Tour', 3, 100, '2023-09-12', '13:30:00', 7),
(22, 'Palanga Ostseestrand', 5, 150, '2023-09-17', '11:30:00', 8),
(23, 'Bratislava Stadtrundfahrt', 3, 100, '2023-08-29', '10:00:00', 2),
(23, 'Trenčín Burgbesichtigung', 2, 80, '2023-09-03', '13:00:00', 3),
(23, 'Banská Bystrica Altstadtspaziergang', 1, 50, '2023-09-08', '11:00:00', 1),
(23, 'Košice Domführung', 2, 75, '2023-09-13', '14:00:00', 4),
(23, 'Štrbské Pleso Bergwanderung', 3, 90, '2023-09-18', '12:00:00', 5),
(24, 'Ljubljana Stadtrundgang', 3, 100, '2023-08-30', '09:30:00', 2),
(24, 'Bled Bootsfahrt zur Insel', 4, 130, '2023-09-04', '12:30:00', 4),
(24, 'Maribor Weinverkostung', 2, 80, '2023-09-09', '10:30:00', 4),
(24, 'Piran Küstenwanderung', 3, 90, '2023-09-14', '14:30:00', 2),
(24, 'Postojna Tropfsteinhöhlen', 2, 75, '2023-09-19', '11:30:00', 5),
(25, 'Bukarest Stadtrundfahrt', 3, 100, '2023-08-31', '10:00:00', 2),
(25, 'Brașov Bran-Schloss', 4, 130, '2023-09-05', '13:00:00', 3),
(25, 'Sibiu Altstadtbesichtigung', 2, 80, '2023-09-10', '09:00:00', 4),
(25, 'Cluj-Napoca Botanischer Garten', 3, 90, '2023-09-15', '12:00:00', 2),
(25, 'Constanța Schwarzmeerstrand', 2, 75, '2023-09-20', '10:00:00', 5),
(26, 'Nikosia Altstadtrundgang', 3, 100, '2023-09-01', '11:30:00', 3),
(26, 'Limassol Hafenrundfahrt', 2, 80, '2023-09-06', '14:30:00', 4),
(26, 'Paphos Archäologische Stätten', 1, 50, '2023-09-11', '10:30:00', 1),
(26, 'Larnaka Salzseen-Tour', 3, 90, '2023-09-16', '13:30:00', 5),
(26, 'Ayia Napa Strandaufenthalt', 4, 120, '2023-09-21', '11:30:00', 3),
(27, 'Valletta Stadtrundgang', 3, 100, '2023-09-02', '10:00:00', 2),
(27, 'Mdina Festungstour', 2, 80, '2023-09-07', '13:00:00', 3),
(27, 'Gozo Inselrundfahrt', 1, 50, '2023-09-12', '11:00:00', 1),
(27, 'Marsaxlokk Fischerdorf-Besuch', 2, 75, '2023-09-17', '14:00:00', 4),
(27, 'Comino Blaue Lagune', 3, 90, '2023-09-22', '12:00:00', 5),
(28, 'Riga Altstadtrundgang', 3, 100, '2023-09-03', '09:30:00', 2),
(28, 'Jūrmala Strandtag', 4, 130, '2023-09-08', '12:30:00', 3),
(28, 'Sigulda Burgbesichtigung', 2, 80, '2023-09-13', '10:30:00', 4),
(28, 'Liepāja Strandspaziergang', 3, 90, '2023-09-18', '13:30:00', 2),
(28, 'Cēsis Mittelalterlicher Stadtrundgang', 2, 75, '2023-09-23', '11:30:00', 5);


-- * Erstellt von Sirac
INSERT INTO `reiseverwaltung`.`einstiegsort` (`name`) VALUES
('Fuchsmühl Kirche'),
('Fuchsmühl Schloß'),
('Fuchsmühl Brunner'),
('Pechbrunnen Ortsmitte'),
('Pechbrunnen Groschlattengrün Ortsmitte'),
('Wiesau Bahnhof'),
('Wiesau Egerstraße'),
('Waldershof Schafbruck'),
('Waldershof Ringstraße'),
('Marktredwitz Bahnhof'),
('Marktredwitz Marienstraße'),
('Marktredwitz Leutendorf'),
('Mitterteich Neupleußen'),
('Friedenfels Schönfuß'),
('Friedenfels Frauenreuth'),
('Waldsassen Bahnhof'),
('Waldsassen Hatzenreuth'),
('Waldsassen Chodauer Straße'),
('Wunsiedel Bahnhof'),
('Wunsiedel Holenbrunn'),
('Tröstau Siedlung'),
('Tröstau Vierst'),
('Tröstau Vordorf'),
('Erbendorf Plärn'),
('Erbendorf Frodersreuth'),
('Erbendorf Straßenschacht');