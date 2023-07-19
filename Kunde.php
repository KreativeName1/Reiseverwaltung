<html>
  <head>
    <title>Kunde</title>
    <link rel="stylesheet" type="text/css" href="stylesheets/main.css">
    <link rel="stylesheet" type="text/css" href="stylesheets/reset.css">
    <script defer src="scripts/Funktionen.js"></script>


    <?php
    session_start();
    if (!isset($_SESSION['user'])) header("Location: login.php");
    ?>
  </head>
  <body>
    <header>
      <h1>Traumreisen</h1>
      <nav>
      <a href="Ausloggen.php" class="btn">Ausloggen</a>
      <button class="btn" onclick="get('form').style.display = 'block'"><img src="images/settings.png" alt="Einstellungen"></button>
      </nav>
    </header>
    <main>
<?php
  include 'Funktionen.php';
  $db = db_oeffnen();

  $vergangene = "
  Select b.id, b.zeitstempel, b.personen, e.name as einstiegstelle, z.name as ziel, l.name as land, Date_Format(z.abfahrtsdatum, '%d.%m.%Y') as abfahrtsdatum, TIME_FORMAT(z.abfahrtszeit, '%H:%i') as abfahrtszeit, z.preis
  from buchung b
  INNER JOIN ziel z on z.id = b.ziel_id
  INNER JOIN land l on l.id = z.land_id
  INNER JOIN einstiegsort e on e.id = b.einstiegs_id
  where b.kunde_id = $_SESSION[user_id]
  and z.abfahrtsdatum < CURDATE()
  or ( z.abfahrtsdatum < CURDATE() AND z.abfahrtszeit < CURTIME());";

  $zukuenftige= "
  Select b.id, b.zeitstempel, b.personen, e.name as einstiegstelle, z.name as ziel, l.name as land, Date_Format(z.abfahrtsdatum, '%d.%m.%Y') as abfahrtsdatum, TIME_FORMAT(z.abfahrtszeit, '%H:%i') as abfahrtszeit, z.preis
  from buchung b
  INNER JOIN ziel z on z.id = b.ziel_id
  INNER JOIN land l on l.id = z.land_id
  INNER JOIN einstiegsort e on e.id = b.einstiegs_id
  where b.kunde_id = $_SESSION[user_id]
  and z.abfahrtsdatum > CURDATE()
  or ( z.abfahrtsdatum > CURDATE() AND z.abfahrtszeit > CURTIME());";

  // Zukünftige Buchungen ausgeben
  $buchungen = runQueryAll($db,$zukuenftige);
  echo "<h1 class='mb1'>Zukünftige Buchungen</h1>";
  if (count($buchungen) == 0) echo "<h2>Keine zukünftigen Buchungen</h2>";
  else {
    echo "<div class='grid'>";
    foreach ($buchungen as $buchung) { ausgabe($buchung); }
    echo "</div>";
  }

  // Vergangene Buchungen ausgeben
  $buchungen = runQueryAll($db,$vergangene);
  echo "<h1 class='mb1'>Vergangene Buchungen</h1>";
  if (count($buchungen) == 0) echo "<h2>Keine vergangenen Buchungen</h2>";
  else {
    echo "<div class='grid'>";
    foreach ($buchungen as $buchung) { ausgabe($buchung); }
    echo "</div>";
  }


  // Funktion zum ausgeben der Buchungen
  function ausgabe($buchung) {
    echo "
    <div class='card'>
      <div>
        <h2>$buchung[ziel]</h2>
        <p>$buchung[land]</p>
      </div>
      <div>
        <p class='flex-smallgap'><img src='images/kalender.png' class='icon'/>$buchung[abfahrtsdatum] $buchung[abfahrtszeit]</p>
        <p class='flex-smallgap'><img src='images/vor-dem-bus.png' class='icon'/>$buchung[einstiegstelle]</p>
        <p class='flex-smallgap'><img src='images/nutzer.png' class='icon'/>$buchung[personen] Person(en)</p>
        <p class='flex-smallgap'><img src='images/geld.png' class='icon'/>$buchung[preis] €</p>
        <a href='Buchung.php?id=$buchung[id]' class='mini btn'>Details</a>
      </div>
    </div>";
  }


  // Den Kunden aus der Datenbank holen
  $sql = "SELECT * FROM kunde WHERE email = '$_SESSION[user]'";
  $cursor=$db->query($sql);
  $kunde = $cursor->fetch(PDO::FETCH_ASSOC);

  $db = null;

  // Formular zum Ändern der Kundendaten
  echo"
  <form id='form' style='display:none' class='box' action='Update.php' method='post'>
    <button type='button' onclick=\"get('form').style.display = 'none'\" class='close'>
      <img src='images/buchstabe-x.png' alt='Schließen'>
    </button>
    <h1 class='center'>Kundendaten</h1>
    <p style='color:red' id='fehler'></p>
  <div class='flex'>
      <input value='$kunde[vorname]' type='text' id='vorname' name='vorname' placeholder='Vorname' required/>
      <input value='$kunde[nachname]' type='text' id='nachname' name='nachname' placeholder='Nachname' required/>
    </div>
    <div class='flex'>
      <input value='$kunde[gebdat]' type='date' id='gebdat' name='gebdat' required/>
      <input value='$kunde[email]' type='text' id='email' name='email' placeholder='Email' required/>
    </div>
    <div class='flex'>
      <input value='$kunde[strasse]' type='text' id='strasse' name='strasse' placeholder='Straße' required/>
      <input value='$kunde[hausnummer]' type='text' id='nummer' name='nummer' placeholder='Hausnummer' required/>
    </div>
    <div class='flex'>
      <input value='$kunde[plz]' type='number' id='plz' name='plz' placeholder='Postleitzahl' min='1' max='99999' required/>
      <input value='$kunde[ort]' type='text' id='ort' name='ort' placeholder='Ort' required/>
    </div>
    <h3 class='mb1 center'>Passwort ändern</h3>
    <div class='flex'>
    <input type='password' id='alt_password' name='alt_password' placeholder='Altes Password'/>
      <input type='password' id='neu_password' name='neu_password' placeholder='Neues Password'/>
      <input type='password' id='neu_password2' name='neu_password2' placeholder='Neues Password wiederholen'/>
      <button type='button' tooltip='Das Passwort muss mindestens 8 Zeichen beinhalten mit mindestens einen Groß- und Kleinbuchstaben, Sonderzeichen und Zahl'class='password-info'>
        <img class='icon' src='images/information.png'/>
      </button>
    </div>
    <button type='submit' id='btn' class='btn middle'>Speichern</button>
      <a href='Login.php' class='middle' >Bereits Registriert?</a>
      </form>
</div>";
?>
    </main>
    <footer>
      <p>© 2023 Traumreisen Wiesau GmbH</p>
      <p>© 2023 von webNview GmbH</p>
    </footer>
  </body>
</html>
<script>
// Boolean-Array, welches die Tests speichert
tests = [false, false, false, false, false, false, false, false];

var fehler = get("fehler");

// Prüft, ob alle Felder ausgefüllt sind
get("vorname").addEventListener("input", function () { tests[0] = TestInputLength(get("vorname"), 0); });
get("nachname").addEventListener("input", function () { tests[1] = TestInputLength(get("nachname"), 0); });
get("strasse").addEventListener("input", function () { tests[2] = TestInputLength(get("strasse"), 0); });
get("ort").addEventListener("input", function () { tests[3] = TestInputLength(get("ort"), 0); });

// Prüft, ob die Email-Adresse gültig ist
get("email").addEventListener("input", function () {
  tests[4] = TestInput(get("email"), checkEmail(get("email").value))

  if (tests[4]) fehler.innerHTML = "";
  else fehler.innerHTML = "Die Email-Adresse ist nicht gültig!";
});
// Prüft, ob das Passwort mindestens 8 Zeichen lang ist und ob es mindestens einen Groß- und Kleinbuchstaben, Sonderzeichen und Zahl beinhaltet
get("neu_password").addEventListener("input", function () {
  if (TestInput(get("neu_password"), checkPassword(get("neu_password").value))) fehler.innerHTML = "";
  else fehler.innerHTML = "Das Passwort ist nicht sicher genug!";
});
// Prüft, ob das Passwort mit dem wiederholten Passwort übereinstimmt
get("neu_password2").addEventListener("input", function () {
  if (TestInput(get("neu_password2"), get("neu_password").value == get("neu_password2").value)) fehler.innerHTML = "";
  else fehler.innerHTML = "Die Passwörter stimmen nicht überein!";
});
// Prüft, ob das Geburtsdatum vor dem heutigen Datum liegt und ob es angegeben wurde
get("gebdat").addEventListener("input", function () {
  tests[5] = TestInput(get("gebdat"), new Date(get("gebdat").value) < new Date());

  if (tests[5]) fehler.innerHTML = "";
  else fehler.innerHTML = "Das Geburtsdatum ist nicht gültig!";
});
// Prüft, ob die Hausnummer mindestens eine Zahl beinhaltet und optional einen Buchstaben am Ende hat
get("nummer").addEventListener("input", function () {
  tests[6] = TestInput(get("nummer"), /^[0-9]+[a-zA-Z]?$/.test(get("nummer").value));

  if (tests[6]) fehler.innerHTML = "";
  else fehler.innerHTML = "Die Hausnummer ist nicht gültig!";
});
// Prüft, ob die Postleitzahl 4 oder 5 Zeichen lang ist und ob es eine Zahl ist
get("plz").addEventListener("input", function () {
  tests[7] = TestInput(get("plz"), /^[0-9]{4,5}$/.test(get("plz").value));

  if (tests[7]) fehler.innerHTML = "";
  else fehler.innerHTML = "Die Postleitzahl ist nicht gültig!";
});

// Prüft alle 100ms, ob alle Felder ausgefüllt sind und aktiviert den Button
setInterval(function () {
  if (tests.every(function (e) { return e })) get("btn").disabled = false;
  else get("btn").disabled = true;
}, 100);

// Falls man auf die Seite geht und bereits was eingetragen wird, wird es beim Seitenladen überprüft
document.addEventListener('DOMContentLoaded', function() {
  document.querySelectorAll('input').forEach(function(input) {
    if (input.value) {
      input.dispatchEvent(new Event('input'));
    }
  });
});



function get(id) { return document.getElementById(id) }
// Diese Funktion testet, ob das Feld die richtige Länge hat und setzt die Border entsprechend auf grün oder rot
// Gibt true oder false zurück
function TestInputLength(element, len, direction=">") {
  if (direction = ">") {
    if (element.value.length > len) { element.style.border = "2px solid #4CAF50"; return true; }
    else { element.style.border = "2px solid red"; return false; }
  } else {
    if (element.value.length < len) { element.style.border = "2px solid #4CAF50"; return true; }
    else { element.style.border = "2px solid red"; return false; }
  }
}
// Diese Funktion testet, ob das if-Statement true oder false ist und setzt die Border entsprechend auf grün oder rot
// Gibt true oder false zurück
function TestInput(element, stmt) {
  if (stmt) { element.style.border = "2px solid #4CAF50"; return true;}
  else { element.style.border = "2px solid red"; return false; }
}
</script>