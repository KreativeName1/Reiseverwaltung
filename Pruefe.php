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
 
      $_SESSION['stellen']=$_POST['stellen'];
      $_SESSION['personen']=$_POST['personen'];

      
      $db = db_oeffnen("reiseverwaltung","root");
      $sql = "SELECT *, Date_Format(gebdat, '%d.%m.%Y') as gebdat FROM kunde WHERE email = '$_SESSION[user]'";
      $cursor=$db->query($sql);
      $kunde = $cursor->fetch(PDO::FETCH_ASSOC);

      echo"<h2>Buchung von $kunde[vorname] $kunde[nachname]</h2>";

      $db = db_oeffnen("reiseverwaltung","root");
      $sql = "SELECT id, name FROM einstiegsort WHERE id = '$_SESSION[stellen]'";
      $cursor=$db->query($sql);
      $zielort = $cursor->fetch(PDO::FETCH_ASSOC);

      $sql = "SELECT *, DATE_FORMAT(abfahrtsdatum, '%d.%m.%Y') as abfahrtsdatum, TIME_FORMAT(abfahrtszeit, '%H:%i') as abfahrtszeit FROM land_ziel WHERE ziel_id = $_SESSION[ziel]";
      $cursor=$db->query($sql);
      $ziel = $cursor->fetch(PDO::FETCH_ASSOC);



      echo "<p style='margin-bottom: 1rem'> Sie haben die Kundennummer: $kunde[id]</p>";
      echo "<form action='BuchungEinfügen.php?ziel=$_SESSION[ziel]' method='post'>";
      echo"<table>";
      echo"<tr><th colspan=3>Buchungsdaten</th></tr>";
      echo"<tr><td> Land:</td> <td>$ziel[land_name]</td></tr>";
      echo"<tr><td> Zielort:</td> <td>$ziel[ziel]</td></tr>";
      echo"<tr><td> Personen</td> <td>$_SESSION[personen]</td></tr>";
      echo"<tr><td> Dauer</td> <td>$ziel[dauer] Tag(e)</td></tr>";
      echo"<tr><td> Einstiegsort:</td> <td>$zielort[name]</td></tr>";
      echo"<tr><td> Abfahrtszeit:</td> <td>$ziel[abfahrtszeit]</td></tr>";
      echo"<tr><td> Einstiegsort:</td> <td>$zielort[name]</td></tr>";
      echo"</table>";

      
      echo"<table>";
      echo"<tr><th colspan=3>Persönlichen Daten</th></tr>";
      echo"<tr><td> Vorname:</td> <td>$kunde[vorname]</td></tr>";
      echo"<tr><td> Nachname:</td> <td>$kunde[nachname]</td></tr>";
      echo"<tr><td> Straße:</td> <td>$kunde[strasse]</td></tr>";
      echo"<tr><td> Ort:</td> <td>$kunde[ort]</td></tr>";
      echo"<tr><td> Geburtstdatum:</td> <td>$kunde[gebdat]</td></tr>";
      echo"</table>";

      ?>
      <button type='submit' id='submit' class='btn middle'>Buchen</button>
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