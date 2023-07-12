<html>
  <head>
    <title>Buche</title>
    <link rel="stylesheet" type="text/css" href="stylesheets/main.css">
    <link rel="stylesheet" type="text/css" href="stylesheets/reset.css">
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
      $email = $_SESSION['user'];
      $ziel_id = $_GET['ziel'];
      $db = db_oeffnen();
        $sql = "SELECT id, vorname, nachname FROM kunde WHERE email = '$email'";
        $cursor=$db->query($sql);
        $kunde = $cursor->fetch(PDO::FETCH_ASSOC);

        $sql = "SELECT *, DATE_FORMAT(abfahrtsdatum, '%d.%m.%Y') as abfahrtsdatum, TIME_FORMAT(abfahrtszeit, '%H:%i') as abfahrtszeit FROM land_ziel WHERE ziel_id = $ziel_id";
        $cursor=$db->query($sql);
        $ziel = $cursor->fetch(PDO::FETCH_ASSOC);
        echo "<h2>$kunde[vorname] $kunde[nachname]</h2>";
        echo "<p style='margin-bottom: 1rem'>Kundennummer: $kunde[id]</p>";
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
          echo "Bitte Einstiegsort wählen";

        $sql = "SELECT id, name FROM einstiegsort";
        $cursor = $db->query($sql);
        $stellen = $cursor->fetch(PDO::FETCH_ASSOC);

       echo "<select name='stellen'>";
       
       while($stellen){
        echo "<option value='$stellen[id]'>$stellen[name]</option>";
        $stellen = $cursor->fetch(PDO::FETCH_ASSOC);
       }
       echo "</select>";
       echo "Einzahl der Plätze eingeben:<br>";
       
       echo "<input type='text' name='personen'>";
       echo "<button type='submit' id='submit' class='btn middle'>Weiter</button>";
       

      ?>
      <button class="btn back" onclick="history.back()">Zurück</button>
    </main>
    <footer>
      <p>© 2023 Traumreisen Wiesau GmbH</p>
      <p>© 2023 von webNview GmbH</p>
    </footer>
  </body>
</html>
  <script>
    <?php echo "var plaetze = $ziel[freieplaetze];"; ?>
        var personen = document.getElementsByName('personen')[0];
        var freieplaetze = document.getElementsByName('freieplaetze')[0];
        var submit = document.getElementById('submit');
        personen.addEventListener('input', function() {
          if (personen.value <= plaetze && personen.value > 0) {
            personen.style.border = "2px solid #4CAF50";
            submit.disabled = false;
          }
          else {
            personen.style.border = "2px solid red";
            submit.disabled = true;
            
          }
          });
  </script>