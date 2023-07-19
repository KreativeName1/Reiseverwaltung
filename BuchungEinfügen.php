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
  // save the "buchung_id" in the session
$_SESSION['buchung_id'] = runQuery($db,"SELECT id FROM buchung WHERE kunde_id = :kunde_id and ziel_id = :ziel_id and einstiegs_id = :einstiegs_id and personen = :personen", [
  'kunde_id' => $_SESSION['user_id'],
  'ziel_id' => $_SESSION['ziel'],
  'einstiegs_id' => $_SESSION['stellen'],
  'personen' => $_SESSION['personen']
])['id'];

//session daten löschen

unset($_SESSION['stellen']);
unset($_SESSION['ziel']);
unset($_SESSION['personen']);



// Datenbank schließen und weiterleiten auf Buchung.php
$db = null;
header("Location: Buchung.php");
?>