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
      <a href="Ausloggen.php" class="btn">Ausloggen</a>
    </header>
    <main>
      <?php
          include 'Funktionen.php';
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
          $db = db_oeffnen();
          $buchungen = runQueryAll($db,$zukuenftige);
          echo "<h2>Zukünftige Buchungen</h2>";
          if (count($buchungen) == 0) echo "<strong>Keine zukünftigen Buchungen</strong>";
          else {
            echo "<div class='grid'>";
            foreach ($buchungen as $buchung) { ausgabe($buchung); }
            echo "</div>";
          }

          // Vergangene Buchungen ausgeben
          $buchungen = runQueryAll($db,$vergangene);
          echo "<h2>Vergangene Buchungen</h2>";
          if (count($buchungen) == 0) echo "<strong>Keine vergangenen Buchungen</strong>";
          else {
            echo "<div class='grid'>";
            foreach ($buchungen as $buchung) { ausgabe($buchung); }
            echo "</div>";
          }
          $db = db_oeffnen("reiseverwaltung","root");
          $sql = "SELECT *, Date_Format(gebdat, '%d.%m.%Y') as gebdat FROM kunde WHERE email = '$_SESSION[user]'";
          $cursor=$db->query($sql);
          $kunde = $cursor->fetch(PDO::FETCH_ASSOC);

        echo"<table>";
        echo"<tr><th colspan=2>Ändern Sie Ihre Persönlichen Daten</th></tr>";
        echo"<tr><td>Vorname:</td><td><input type='text' value='$kunde[vorname]' name='vornameneu'></td></tr>";
        echo"<tr><td>Nachname:</td><td><input type='text' value='$kunde[nachname]' name='nachnameneu'></td></tr>";
        echo"<tr><td>Straße:</td><td><input type='text' value='$kunde[strasse]' name='strasse'></td></tr>";
        echo"<tr><td>Hausnummer:</td><td><input type='text' value='$kunde[hausnummer]' name='hausnummer'></td></tr>";
        echo"<tr><td>Postleitzahl:</td><td><input type='text' value='$kunde[plz]' name='plzneu'></td></tr>";
        echo"<tr><td>Ort:</td><td><input type='text' value='$kunde[ort]' name='ortneu'></td></tr>";
        echo"<tr><td>Geburtsdatum:</td><td><input type='text' value='$kunde[gebdat]' name='gebdatneu'></td></tr>";
        echo"<tr><td>E-Mail:</td><td><input type='text' value='$kunde[email]' name='emailneu'></td></tr>";
        echo"<tr><td>Passwort:</td><td><input type='text' value='$kunde[passwort]' name='passwortneu'></td></tr>";
        echo"</table>";
        
          //Die neuen Kundendaten in die Datenbank einschreiben
        $vorname = $_POST['vornameneu'];
        $nachname = $_POST['nachnameneu'];
        $strasse = $_POST['strasse'];
        $hausnummer = $_POST['hausnummer'];
        $plz = $_POST['plzneu'];
        $ort = $_POST['ortneu'];
        $gebdat = $_POST['gebdatneu'];
        $email = $_POST['emailneu'];
        $passwort = $_POST['passwortneu'];
          
          $db = db_oeffnen("reiseverwaltung","root");
          $sql="UPDATE kunden 
          SET vorname='$vorname', nachname='$nachname', email='$email', passwort='$passwort', strasse='$strasse', hausnummer='$hausnummer', plz='$plz', ort='$ort', gebdat='$gebdat',
          WHERE email = '$_SESSION[user]'";
       
        

          // Datenbankverbindung schließen
          $db = null;

          // Funktion zum ausgeben der Buchungen
          function ausgabe($buchung) {
            echo "<div class='card'>";
            echo "<div>";
            echo "<h2>$buchung[ziel]</h2>";
            echo "<p>$buchung[land]</p>";
            echo "</div>";
            echo "<div>";
            echo "<p class='flex-smallgap'><img src='images/kalender.png' class='icon'/>$buchung[abfahrtsdatum] $buchung[abfahrtszeit]</p>";
            echo "<p class='flex-smallgap'><img src='images/vor-dem-bus.png' class='icon'/>$buchung[einstiegstelle]</p>";
            echo "<p class='flex-smallgap'><img src='images/nutzer.png' class='icon'/>$buchung[personen] Person(en)</p>";
            echo "<p class='flex-smallgap'><img src='images/geld.png' class='icon'/>$buchung[preis] €</p>";
            echo "<a href='Buchung.php?id=$buchung[id]' class='mini btn'>Details</a>";
            echo "</div>";
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