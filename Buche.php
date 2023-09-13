<html>
  <head>
    <title>Buche</title>
    <link rel="stylesheet" type="text/css" href="stylesheets/reset.css">
    <link rel="stylesheet" type="text/css" href="stylesheets/main.css">
    <script defer src="scripts/Funktionen.js"></script>
    <?php
    session_start();
    if (!isset($_SESSION['user'])) header("Location: login.php");
    include "Funktionen.php";
    ?>
  </head>
  <body>
    <header>
      <h1>Traumreisen</h1>
      <nav>
        <a href="Kunde.php" class="btn">Buchungen</a>
        <a href="Ausloggen.php" class="btn">Ausloggen</a>
      </nav>
    </header>
    <main class="c-vertical c-horizontal">
      <h1>Buchung</h1>
      <?php
      // Ziel wird in Session gespeichert
      $_SESSION['ziel'] = $_GET['ziel'];

      // Kunde wird aus Datenbank geholt
      $email = $_SESSION['user'];
      $db = db_oeffnen();
      $sql = "SELECT id, vorname, nachname FROM kunde WHERE email = '$email'";
      $cursor=$db->query($sql);
      $kunde = $cursor->fetch(PDO::FETCH_ASSOC);

      // Ziel wird aus Datenbank geholt
      $sql = "SELECT *, DATE_FORMAT(abfahrtsdatum, '%d.%m.%Y') as abfahrtsdatum, TIME_FORMAT(abfahrtszeit, '%H:%i') as abfahrtszeit FROM land_ziel WHERE ziel_id = $_SESSION[ziel]";
      $cursor=$db->query($sql);
      $ziel = $cursor->fetch(PDO::FETCH_ASSOC);
      $_SESSION['freie_plaetze'] = $ziel['freieplaetze'];
      // Ausgabe der Daten
      echo "<h2>$kunde[vorname] $kunde[nachname]</h2>";
      echo "<p class='mb1'>Kundennummer: $kunde[id]</p>";
      echo "<form action='Pruefe.php?ziel=$_SESSION[ziel]' method='post'>";
      echo "
        <table>
          <tr><td>Land</td><td>$ziel[land_name]</td></tr>
          <tr><td>Zielort<td>$ziel[ziel]</td></tr>
          <tr><td>Dauer</td><td>$ziel[dauer] Tag(e)</td></tr>
          <tr><td>Preis</td><td>$ziel[preis] €</td></tr>
          <tr><td>Abfahrtsdatum</td><td>$ziel[abfahrtsdatum]</td></tr>
          <tr><td>Abfahrtszeit</td><td>$ziel[abfahrtszeit]</td></tr>
          <tr><td>Freie Plätze</td><td>$ziel[freieplaetze]</td></tr>
        </table>";
        ?>
        <div class='flex'>
          <div>
            <p>Einstiegsort</p>
            <select name='stellen'>
            <?php
             // Einstiegsorte werden aus Datenbank geholt
            $sql = "SELECT id, name FROM einstiegsort";
            $cursor = $db->query($sql);
            $stellen = $cursor->fetch(PDO::FETCH_ASSOC);

            // Ausgabe der Einstiegsorte
            while($stellen) {
              echo "<option value='$stellen[id]'>$stellen[name]</option>";
              $stellen = $cursor->fetch(PDO::FETCH_ASSOC);
            }
            ?>
            </select>
          </div>
        <div>
        <p>Anzahl der Personen</p>
        <input type='text' name='personen'>
        </div>
      </div>
      <div id='personen'>
       </div>
        <button type='submit' disabled id='submit' class='btn middle'>Weiter</button>
      </form>
      <button class="btn back" onclick="history.back()">Zurück</button>
    </main>
    <footer>
      <p>© 2023 Traumreisen Wiesau GmbH</p>
      <p>© 2023 von webNview GmbH</p>
    </footer>
  </body>
</html>
  <script>
    // Mit php wird die Anzahl der Freien Plätze gespeichert in js
    <?php echo "var plaetze = $ziel[freieplaetze];"; ?>

    // Elemente holen
    var personen = document.getElementsByName('personen')[0];
    var freieplaetze = document.getElementsByName('freieplaetze')[0];
    var submit = document.getElementById('submit');
    var div = document.getElementById('personen');

    // Event Listener zum Überprüfen der angegebenen Personenanzahl
    personen.addEventListener('input', function() {
      if (personen.value <= plaetze && personen.value > 0) {
        personen.style.border = "2px solid #4CAF50";
        div.innerHTML = "";
        for (var i = 0; i < personen.value; i++) {
          div.innerHTML += "<div><input class='person' type='text' name='vorname[]' placeholder='Vorname'><input type='text' name='nachname[]' placeholder='Nachname'></div>";
        }
      }
      else {
        personen.style.border = "2px solid red";
        submit.disabled = true;
        div.innerHTML = "";
      }
      });
      div.array.forEach(element => {
        
      });
  </script>