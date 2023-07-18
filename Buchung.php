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
     $db = db_oeffnen("reiseverwaltung","root");
     $sql = "SELECT *, Date_Format(gebdat, '%d.%m.%Y') as gebdat FROM kunde WHERE email = '$_SESSION[user]'";
     $cursor=$db->query($sql);
     $kunde = $cursor->fetch(PDO::FETCH_ASSOC);
     echo'<div id="print" style="display: none;">
  <h1>$kunde[vorname] $kunde[name]</h1>
</div>'

      ?>
<p>Buchungsbestätigung als PDF herunterladen</p>
<button type = "button" onclick = "createPDF()">PDF Herunterladen</button>
    </main>
    <footer>
      <p>© 2023 Traumreisen Wiesau GmbH</p>
      <p>© 2023 von webNview GmbH</p>
    </footer>
  </body>
</html>
<script>
function createPDF() {
  // Element mit der ID "print" wird in eine PDF umgewandelt und heruntergeladen
var element = document.getElementById('print');
html2pdf()

    .from(element)
    .save('Buchung.pdf');
}

</script>