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
      <h1>Reiseverwaltung</h1>
      <a href="Ausloggen.php" class="btn">Ausloggen</a>
    </header>
    <main class="c-vertical c-horizontal">
      <?php
      // Der Befehl zum Ziel-Datensatz zu holen:
        $code = $_GET['land'];
        $db = db_oeffnen();
        $sql = "SELECT DISTINCT name, id, code FROM land WHERE code = '$code'";
        $cursor=$db->query($sql);
        $satz=$cursor->fetch(PDO::FETCH_ASSOC);

        echo "<p>Sie haben $satz[name] ausgewählt.</p>";
        echo "<img src='https://hatscripts.github.io/circle-flags/flags/$satz[code].svg' width='48'>";
        try {
          $sql = "SELECT * FROM land_ziel WHERE land = '$code' AND freieplaetze > 0 AND abfahrtsdatum > CURDATE() OR (abfahrtsdatum = CURDATE() AND abfahrtszeit > CURTIME())";
          $cursor=$db->query($sql);
          echo "<table>";
          while ($ergebnis=$cursor->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td><a href='Buche.php?land=$satz[code]&ziel=$ergebnis[ziel]'>$ergebnis[ziel]</a></td>";
            echo "<td>$ergebnis[abfahrtsdatum]</td>";
            echo "<td>$ergebnis[abfahrtszeit]</td>";
            echo "<td>$ergebnis[freieplaetze]</td>";
            echo "</tr>";
        }
        echo "</table>";
        } catch (PDOException $e) {
          die("Befehl-Fehler!: " . $e->getMessage() . "<br/>");
        }
      ?>
    </main>
    <footer>
      <p>© 2023 Reiseverwaltung GmbH</p>
      <p>© 2023 von webNview GmbH</p>
    </footer>
  </body>
</html>
  <script>
    // javascript hier
  </script>