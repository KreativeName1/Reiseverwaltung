# Projekt Reiseverwaltung
Ein Projekt von:
- Sirac Orak
- Sascha Dierl
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

### TODO:
