<?php
session_start();
include 'Funktionen.php';
$db = db_oeffnen();

// Buchung einfügen
runQuery(
  $db,
  "Insert into buchung(kunde_id, ziel_id, einstiegs_id, personen) Values
  (
    :kunde_id,
    :ziel_id,
    :einstiegs_id,
    :personen
  )",
  [
    'kunde_id' => $_SESSION['user_id'],
    'ziel_id' => $_SESSION['ziel'],
    'einstiegs_id' => $_SESSION['stellen'],
    'personen' => $_SESSION['personen']
  ]
  );

// Anzahl der freien Plätzen berechnen
$frei = $_SESSION['freie_plaetze'] - $_SESSION['personen'];

// Freie Plätze aktualisieren
runQuery(
  $db,
  "Update land_ziel Set freieplaetze = :frei Where ziel_id = :ziel_id",
  [
    'frei' => $frei,
    'ziel_id' => $_SESSION['ziel']
  ]
  );

// Datenbank schließen und weiterleiten auf Buchung.php
$db = null;
header("Location: Buchung.php");
?>