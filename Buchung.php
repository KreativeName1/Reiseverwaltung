<html>
  <head>
    <title>Buchung</title>
    <link rel="stylesheet" type="text/css" href="stylesheets/main.css">
    <link rel="stylesheet" type="text/css" href="stylesheets/reset.css">
    <script defer src="scripts/Funktionen.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
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
      <?php
        $db = db_oeffnen();

        // Wenn der Kunde über die Kunde.php Seite kommt
        if (isset($_GET['id'])) {
          // Überprüft, ob die Buchung dem Kunden gehört, der gerade eingeloggt ist
          $sql = "SELECT * FROM buchung WHERE id = :id AND kunde_id = :user_id";
          $ergebnis = runQueryAll($db, $sql, [
            ":id" => $_GET['id'],
            ":user_id" => $_SESSION['user_id']
          ]);

          // Wenn die Buchung dem Kunden gehört wird die Buchung_id gespeichert,
          // sonst wird die Seite nicht angezeigt
          count($ergebnis) == 1 ? $buchung_id = $_GET['id'] : die("<h1>Kein Zugriff!</h1>");
        }
        // Wenn der Kunde gerade Gebucht hat
        else if (isset($_SESSION['buchung_id'])) {
          $buchung_id = $_SESSION['buchung_id'];
        }
        // Wenn der Kunde die Seite direkt aufruft
        else die("<h1>Kein Zugriff!</h1>");

        unset($_SESSION['buchung_id']);

        // Alle Daten holen
        $sql = "
        SELECT
        Date_Format(gebdat, '%d.%m.%Y') as gebdat,
        Date_Format(z.abfahrtsdatum, '%d.%m.%Y') as abfahrtsdatum,
        TIME_FORMAT(z.abfahrtszeit, '%H:%i') as abfahrtszeit,
        Date_Format(b.zeitstempel,'%d.%m.%Y') as buchung_datum,
        TIME_FORMAT(b.zeitstempel, '%H:%i') as buchung_zeit,
        k.id as kunde_id,
        k.vorname,
        k.nachname,
        k.strasse,
        k.hausnummer,
        k.ort,
        k.plz,
        l.name as land_name,
        e.name as einstiegs_name,
        b.personen,
        b.zeitstempel,
        b.id as buchung_id,
        z.name as ziel_name,
        z.preis,
        z.dauer
        FROM kunde k
        INNER JOIN buchung b ON b.id = $buchung_id
        INNER JOIN ziel z ON z.id = b.ziel_id
        INNER JOIN einstiegsort e ON e.id = b.einstiegs_id
        INNER JOIN land l ON l.id = z.land_id
        WHERE email = '$_SESSION[user]'
        ";
        $cursor=$db->query($sql);
        $daten = $cursor->fetch(PDO::FETCH_ASSOC);

        // Ausgabe der Daten
        echo "
        <button class='btn' style='margin-top:1rem' onclick ='createPDF()'>PDF Herunterladen</button>
        <div id='print' class='box c-horizontal c-vertical' style='margin-bottom:5rem'>
          <div class='c-horizontal' style='margin-bottom:.5rem'>
            <h2>Buchungsbestätigung</h2>
            <strong>Gebucht am $daten[buchung_datum] um $daten[buchung_zeit]</strong>
            <p>Buchungsnummer: $daten[buchung_id]</p>
          </div>
          <table>
            <tr><th colspan=3>Persönlichen Daten</th></tr>
            <tr><td> Kundennummer:</td> <td>$daten[kunde_id]</td></tr>
            <tr><td> Name:</td> <td>$daten[vorname] $daten[nachname]</td></tr>
            <tr><td> Straße:</td> <td>$daten[strasse] $daten[hausnummer]</td></tr>
            <tr><td> Ort:</td> <td>$daten[plz] $daten[ort]</td></tr>
            <tr><td> Geburtstdatum:</td> <td>$daten[gebdat]</td></tr>
          </table>
          <table>
            <tr><th colspan=3>Reisedaten</th></tr>
            <tr><td> Land:</td> <td>$daten[land_name]</td></tr>
            <tr><td> Ziel:</td> <td>$daten[ziel_name]</td></tr>
            <tr><td> Preis:</td> <td>$daten[preis] €</td></tr>
            <tr><td> Dauer:</td> <td>$daten[dauer] Tage</td></tr>
            <tr><td> Personen</td> <td>$daten[personen]</td></tr>
            <tr><td> Einstiegsort:</td> <td>$daten[einstiegs_name]</td></tr>
            <tr><td> Abfahrtsdatum/zeit:</td> <td>$daten[abfahrtsdatum] $daten[abfahrtszeit]</td></tr>
          </table>
          <strong>Traumreisen Wiesau GmbH</strong>
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
function createPDF() {
  // Holt sich das Element mit der ID print
  var element = document.getElementById('print');

  // Optionen für das PDF
  const opt = {
    format: 'A4',
    orientation: 'portrait',
    type: 'webp',
    html2canvas:  { scale: 5 },
    filename: '<?php echo "Buchung-Nr.$buchung_id.pdf" ?>'
  }

  // Wandelt das HTML zu PDF um und speichert es
  html2pdf().from(element).set(opt).save();
}
</script>