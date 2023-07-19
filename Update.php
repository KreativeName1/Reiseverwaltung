<?php
include 'Funktionen.php';
$db = db_oeffnen();
session_start();
$vorname = $_POST['vorname'];
$nachname = $_POST['nachname'];
$strasse = $_POST['strasse'];
$hausnummer = $_POST['nummer'];
$plz = $_POST['plz'];
$ort = $_POST['ort'];
$gebdat = $_POST['gebdat'];
$email = $_POST['email'];
$alt_passwort = $_POST['alt_password'];
$neu_passwort = $_POST['neu_password'];
$neu_passwort2 = $_POST['neu_password2'];

$ergebnis = runQuery($db,"SELECT passwort FROM kunde WHERE email = '$_SESSION[user]'");
$passwort = $ergebnis['passwort'];
if (!empty($alt_passwort)) {
  if (password_verify($alt_passwort, $passwort)) {
    if ($neu_passwort == $neu_passwort2) {
      $passwort = password_hash($neu_passwort, PASSWORD_DEFAULT);
      // update passwort
      runQuery($db, "UPDATE kunde SET passwort = :passwort WHERE email = :email", [
        'passwort' => $passwort,
        'email' => $_SESSION['user']
      ]);
    } else {
      echo "<script>alert('Passwörter stimmen nicht überein!');</script>";
      return;
    }
  }
  else {
    echo "<script>alert('Altes Passwort ist falsch!');</script>";
    return;
  }
}
// test if email is already in use by another user
$ergebnis = runQuery($db,"SELECT email FROM kunde WHERE email = :email", [
  'email' => $email
]);
if ($ergebnis != null) {
  if ($ergebnis['email'] != $_SESSION['user']) {
    echo "<script>alert('Email bereits in Verwendung!');</script>";
    return;
  }
}
// update the rest
runQuery($db, "UPDATE kunde SET vorname = :vorname, nachname = :nachname, strasse = :strasse, hausnummer = :hausnummer, plz = :plz, ort = :ort, gebdat = :gebdat, email = :email WHERE email = :email", [
  'vorname' => $vorname,
  'nachname' => $nachname,
  'strasse' => $strasse,
  'hausnummer' => $hausnummer,
  'plz' => $plz,
  'ort' => $ort,
  'gebdat' => $gebdat,
  'email' => $email
]);

$_SESSION['user'] = $email;

header("Location: Kunde.php");
?>