# Projekt Reiseverwaltung
Projekt zum Ende des ersten Ausbildungsjahres Fachinformatiker für Anwendungsentwicklung

Ein Projekt von:
- Sirac Orak
- Sascha Dierl (Hat das meiste gemacht)
- Abdulrahman Hassoun

 
In diesem Projekt kann man sich in der Reiseverwaltung registrieren und einloggen. Als erstes wird das Land ausgesucht und dann das Reiseziel.
Man kann die Reise buchen und angeben, wie viele Personen mitfahren. Man kann auch angeben, wo man einsteigen möchte.
Man hat auch die Möglichkeit, alle bisherigen und zukünftigen Buchungen anzuschauen
und die Kundendaten zu ändern.

Verwendete Sprachen:
- ![HTML](https://img.shields.io/badge/-HTML-000000?style=flat&logo=HTML5)
- ![CSS](https://img.shields.io/badge/-CSS-000000?style=flat&logo=CSS3)
- ![PHP](https://img.shields.io/badge/-PHP-000000?style=flat&logo=PHP)
- ![MySQL](https://img.shields.io/badge/-MySQL-000000?style=flat&logo=MySQL)
- ![JavaScript](https://img.shields.io/badge/-JavaScript-000000?style=flat&logo=JavaScript)


---

Dateistruktur:

```
Projekt/
├─ images/
├─ scripts/
│  ├─ Funktionen.js
├─ stylesheets/
│  ├─ reset.css
│  ├─ main.css
├─ stylesheets/
│  ├─ reset.css
│  ├─ main.css
Ausloggen.php
Buche.php
Buchung.php
BuchungEinfügen.php
Datenbank.sql
Funktionen.php
Kunde.php
Login.php
Pruefe.php
README.md
Registrierung.php
Start.php
Update.php
Zeige.php

```

Datenbank:

```
kunde
├─ id (PK)
├─ vorname
├─ nachname
├─ email
├─ passwort
├─ strasse
├─ hausnummer
├─ plz
├─ ort
├─ gebdat

land
├─ id (PK)
├─ name

ziel
├─ id (PK)
├─ land_id (FK)
├─ name
├─ dauer
├─ preis
├─ abfahrtsdatum
├─ abfahrtszeit
├─ freiePlaetze

buchung
├─ id (PK)
├─ kunde_id (FK)
├─ ziel_id (FK)
├─ timestamp
├─ personen
├─ einstiegsort
```

---

## Screenshots
![image](https://github.com/KreativeName1/Reiseverwaltung/assets/115576847/6a72cc4a-3f9a-4f75-95ba-02c8ab28d49f)
![image](https://github.com/KreativeName1/Reiseverwaltung/assets/115576847/ce60c100-f5c1-4acb-ac24-431b68a568a8)
![image](https://github.com/KreativeName1/Reiseverwaltung/assets/115576847/73622c65-0282-483d-bbb4-a90cf29783b2)
![image](https://github.com/KreativeName1/Reiseverwaltung/assets/115576847/67d72a23-f9b8-49c3-92fd-35a380d56aec)
![image](https://github.com/KreativeName1/Reiseverwaltung/assets/115576847/0a8613fa-cd25-4582-ba25-45ceb66d21e1)
![image](https://github.com/KreativeName1/Reiseverwaltung/assets/115576847/bd6e3654-d5f9-4b57-866b-ea1b6752cc08)
![image](https://github.com/KreativeName1/Reiseverwaltung/assets/115576847/220c60bf-a0f3-406d-a80a-c82b155e108e)







