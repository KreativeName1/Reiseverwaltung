<html>
  <head>
    <title>Zeige</title>
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
      <h1 class="center">Ziel-Wahl</h1>
      <?php
        

        $code = $_GET['land'];
        $db = db_oeffnen();

        try {
          // Alle Zielorte des Landes werden aus der Datenbank geholt, die noch buchbar sind
          $sql = "SELECT *,
          DATE_FORMAT(abfahrtsdatum, '%d.%m.%Y') as abfahrtsdatum,
          TIME_FORMAT(abfahrtszeit, '%H:%i') as abfahrtszeit
          FROM land_ziel
          WHERE land_code = '$code'
          AND freieplaetze > 0
          AND abfahrtsdatum > CURDATE()
          OR (abfahrtsdatum = CURDATE()
          AND abfahrtszeit > CURTIME())";
          $cursor=$db->query($sql);
          $ergebnis=$cursor->fetch(PDO::FETCH_ASSOC);

          // Wenn keine Zeilen gefunden wurden, wird eine Fehlermeldung ausgegeben:
          if ($cursor->rowCount() == 0) {
            echo "<h3>Es gibt leider keine Zielorte, die Sie buchen können.</h3>";
            echo "<a style='margin:1rem' href='Start.php' class='btn'>Zurück</a>";
            exit();
          }

          // Ausgabe des Textes, welches Land ausgewählt wurde:
          echo "
          <div class='flex' style='margin-bottom: 2rem'>
            <img src='https://hatscripts.github.io/circle-flags/flags/$ergebnis[land_code].svg' width='64'>
            <div>
              <p>Sie haben $ergebnis[land_name] ausgewählt.</p>
              <p>Bitte wählen Sie ein Ziel aus:</p>
            </div>
            <img src='https://hatscripts.github.io/circle-flags/flags/$ergebnis[land_code].svg' width='64'>
          </div>";


          // Wenn Zeilen gefunden wurden, wird eine Tabelle ausgegeben:
          echo "<table>";
          echo "<tr><th>Ziel</th><th>Abfahrtsdatum</th><th>Abfahrtszeit</th><th>Freie Plätze</th><th></th></tr>";
          while ($ergebnis) {
            echo "<tr>";
            echo "<td><a href='Buche.php?ziel=$ergebnis[ziel_id]'>$ergebnis[ziel]</a></td>";
            echo "<td>$ergebnis[abfahrtsdatum]</td>";
            echo "<td>$ergebnis[abfahrtszeit]</td>";
            echo "<td>$ergebnis[freieplaetze]</td>";
            // Hier wird der Name des Zielorts genommen, um den Wikipedia-Link zu generieren:
            $name = explode(" ", $ergebnis['ziel'])[0];
            echo "<td><a href='https://de.wikipedia.org/wiki/$name' target='_blank'><img class='icon' width='1rem' src='images/information.png' /></a></td>";
            echo "</tr>";

            $ergebnis=$cursor->fetch(PDO::FETCH_ASSOC);
          }
          echo "</table>";

        } catch (PDOException $e) {
          die("Befehl-Fehler!: " . $e->getMessage() . "<br/>");
        }
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
    // javascript hier


  </script>