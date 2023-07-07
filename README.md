# Projekt Reiseverwaltung
Ein Projekt von:
- Sirac Orak
- Sascha Dierl
- Abdulrahman Hassoun

In diesem Projekt kann man sich in der Reiseverwaltung registrieren und einloggen. Als erstet wird das Land ausgesucht und dann das Reiseziel.
Man kann die Reise buchen und angeben, wie viele Personen mitfahren. Er kann auch angeben, wo er einsteigen möchte.
Man hat auch die möglichkeit, alle bisherigen und zukünftigen Buchungen anzuschauen.

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
├─ scripts/
│  ├─ Funktionen.php
├─ stylesheets/
│  ├─ reset.css
│  ├─ main.css
├─ Start.php
├─ images/
Buchung.php
Datenbank.sql
Kunde.php
Login.html
Pruefe.php
Registrierung.html
Start.php
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
├─ datum
├─ uhrzeit
├─ anzahl
├─ einstiegsort
```

---

### TODO:
