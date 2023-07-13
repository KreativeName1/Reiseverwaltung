<html>
  <head>
    <title>Püfe</title>
    <link rel="stylesheet" type="text/css" href="stylesheets/main.css">
    <link rel="stylesheet" type="text/css" href="stylesheets/reset.css">
    <script defer src="scripts/Funktionen.js"></script>
    <?php
    session_start();
    if (!isset($_SESSION['user'])) header("Location: login.php");
    include 'Funktionen.php';
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
    <?php
 
      $stellen=$_POST['stellen'];
      $personen=$_POST['personen'];
    
      $zielId = $_SESSION['ziel'];
      $email = $_SESSION['user'];
      
      $db = db_oeffnen("reiseverwaltung","root");
      $sql = "SELECT id, vorname, nachname FROM kunde WHERE email = '$email'";
      $cursor=$db->query($sql);
      $kunde = $cursor->fetch(PDO::FETCH_ASSOC);

      echo"<h2>Buchung von $kunde[vorname] $kunde[nachname]</h2>";

      $db = db_oeffnen("reiseverwaltung","root");
      $sql = "SELECT id, name FROM einstiegsort WHERE id = '$stellen'";
      $cursor=$db->query($sql);
      $zielort = $cursor->fetch(PDO::FETCH_ASSOC);

      $sql = "SELECT *, DATE_FORMAT(abfahrtsdatum, '%d.%m.%Y') as abfahrtsdatum, TIME_FORMAT(abfahrtszeit, '%H:%i') as abfahrtszeit FROM land_ziel WHERE ziel_id = $_SESSION[ziel]";
      $cursor=$db->query($sql);
      $ziel = $cursor->fetch(PDO::FETCH_ASSOC);
      

      echo "<p style='margin-bottom: 1rem'> Sie haben die Kundennummer: $kunde[id]</p>";
      echo "<form action='Pruefe.php?ziel=$_SESSION[ziel]' method='post'>";
      
      echo"Sie haben das Land $ziel[land_name]</td></tr>";
      echo"Sie haben das Land  $personen";
      echo "$zielort[name]";




      echo"<table>";

      echo"</table>";

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