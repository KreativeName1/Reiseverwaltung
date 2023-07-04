# Reiseverwaltung
Ein Schulprojekt


# Projekt Reiseverwaltung

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
Kunde
├─ id
├─ vorname
├─ nachname
├─ email
├─ passwort
├─ strasse
├─ hausnummer
├─ plz
├─ ort
├─ gebdat

Land
├─ id
├─ name

Ziel
├─ id
├─ land_id
├─ name
├─ dauer
├─ preis
├─ abfahrtsdatum
├─ abfahrtszeit
├─ freiePlaetze

Buchung
├─ id
├─ kunde_id
├─ ziel_id
├─ datum
├─ uhrzeit
├─ anzahl
├─ einstiegsort
```