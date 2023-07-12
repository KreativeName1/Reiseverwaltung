<html>
  <head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="stylesheets/main.css">
    <link rel="stylesheet" type="text/css" href="stylesheets/reset.css">
    <script defer src="scripts/Funktionen.js"></script>
  </head>
  <body>
    <header>
      <h1>Traumreisen</h1>
    </header>
    <main class="c-vertical c-horizontal">
      <div class="box">
        <h1 class="center">Login</h1>
        <p style="color:red;" id="fehler"></p>
        <form action="" method="post">
          <div class="flex">
          <input type="text" id="email" name="email" placeholder="Email" required/>
          <input type="password" id="password" name="password" placeholder="Password" required/>
          </div>
          <button type="submit" id="btn" class="btn middle" disabled>Login</button>
          <a href="Registrierung.php" class="middle" >Noch nicht Registriert?</a>
        </form>
      </div>
</main>
<footer>
  <p>© 2023 Traumreisen Wiesau GmbH</p>
  <p>© 2023 von webNview GmbH</p>
</footer>
</html>
<script>
// Elemente aus dem DOM holen
let email = document.getElementById("email");
let password = document.getElementById("password");
let btn = document.getElementById("btn");

// Wenn das Dokument geladen ist wird die Funktion handleInput ausgeführt,
// falls etwas bereits vorausgefüllt ist
document.addEventListener('DOMContentLoaded', handleInput, false);

// Event Listener für die Eingabefelder
email.addEventListener("input", handleInput);
password.addEventListener("input", handleInput);

// Funktion zum überprüfen der Email Adresse und Passwort
function handleInput() {
  if (checkEmail(email.value)) {
    email.style.border = "2px solid #4CAF50";
  } else {
    email.style.border = "2px solid red";
  }
  if (password.value.length >= 8) {
    password.style.border = "2px solid #4CAF50";
  } else {
    password.style.border = "2px solid red";
  }

  if (checkEmail(email.value) && password.value.length >= 8) {
    btn.disabled = false;
  } else {
    btn.disabled = true;
  }
}
</script>
<?php
if (isset($_POST['email']) && isset($_POST['password'])) {

  include "Funktionen.php";

  $email = $_POST['email'];
  $password = $_POST['password'];

  // Verbindung zur Datenbank wird hergestellt
  $db = db_oeffnen();


    // Passwort wird aus der Datenbank geholt
    $ergebnis = runQuery($db,"SELECT passwort FROM kunde WHERE email = :email", [':email' => $email]);

    // Falls ein Ergebnis zurück kommt wird das Passwort überprüft, ansonsten wird eine Fehlermeldung ausgegeben
    if ($ergebnis) {
      // Passwort wird überprüft, wenn es stimmt wird eine Session gestartet und der User wird weitergeleitet
      if (password_verify($password, $ergebnis['passwort'])) {
        session_start();
        $_SESSION['user'] = $email;
        header('Location: start.php');
      } else {
        echo "<script>document.getElementById('fehler').innerHTML = 'Passwort ist falsch!'</script>";
      }
    } else {
      echo "<script>document.getElementById('fehler').innerHTML = 'Email existiert nicht!'</script>";
    }
}
?>