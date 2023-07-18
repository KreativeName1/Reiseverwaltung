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
    <?php
    // Php hier
    ?>
  </head>
  <body>
    <header>
      <h1>Traumreisen</h1>
      <a href="Ausloggen.php" class="btn">Ausloggen</a>
    </header>
    <main class="c-vertical c-horizontal">
      <?php
          include 'Funktionen.php';

          $vergangene = "
          Select b.zeitstempel, b.personen, e.name as einstiegstelle, z.name as ziel, l.name as land, z.abfahrtsdatum, z.abfahrtszeit, z.preis
          from buchung b
          INNER JOIN ziel z on z.id = b.ziel_id
          INNER JOIN land l on l.id = z.land_id
          INNER JOIN einstiegsort e on e.id = b.einstiegs_id
          where b.kunde_id = 1
          and z.abfahrtsdatum < CURDATE()
          or ( z.abfahrtsdatum < CURDATE() AND z.abfahrtszeit < CURTIME());";

          $zukuenftige= "
          Select b.zeitstempel, b.personen, e.name as einstiegstelle, z.name as ziel, l.name as land, z.abfahrtsdatum, z.abfahrtszeit, z.preis
          from buchung b
          INNER JOIN ziel z on z.id = b.ziel_id
          INNER JOIN land l on l.id = z.land_id
          INNER JOIN einstiegsort e on e.id = b.einstiegs_id
          where b.kunde_id = 1
          and z.abfahrtsdatum > CURDATE()
          or ( z.abfahrtsdatum > CURDATE() AND z.abfahrtszeit > CURTIME());";

          // Zukünftige Buchungen ausgeben
          $db = db_oeffnen();
          $buchungen = runQueryAll($db,$zukuenftige);
          echo "<div>";
          echo "<h2>Zukünftige Buchungen</h2>";
          if (count($buchungen) == 0) echo "<strong>Keine zukünftigen Buchungen</strong>";
          else foreach ($buchungen as $buchung) { ausgabe($buchung); }
          echo "</div>";

          // Vergangene Buchungen ausgeben
          $buchungen = runQueryAll($db,$vergangene);
          echo "<div>";
          echo "<h2>Vergangene Buchungen</h2>";
          if (count($buchungen) == 0) echo "<strong>Keine vergangenen Buchungen</strong>";
          else foreach ($buchungen as $buchung) { ausgabe($buchung); }
          echo "</div>";

          // Datenbankverbindung schließen
          $db = null;

          // Funktion zum ausgeben der Buchungen
          function ausgabe($buchung) {
            echo "<div>";
            echo "<h3>$buchung[zeitstempel]</h3>";
            echo "<p>$buchung[personen] Person(en)</p>";
            echo "<p>$buchung[einstiegstelle] -> $buchung[ziel]</p>";
            echo "<p>$buchung[land]</p>";
            echo "<p>$buchung[abfahrtsdatum] $buchung[abfahrtszeit]</p>";
            echo "<p>$buchung[preis] €</p>";
            echo "</div>";
          }
      ?>
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