<html><head>
  <title>Buche</title>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="stylesheets/reset.css">
  <link rel="stylesheet" type="text/css" href="stylesheets/main.css">
  <script type="text/javascript" src="scripts/Funktionen.js"></script>
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
  <main class="c-vertical c-horizontal" id="main">
    <h1>Buchung</h1>
    <h2>Sascha Dierl</h2><p style="margin-bottom: 1rem">Kundennummer: 13</p><form method="post">
        <table id="print">
          <tbody>
          <tr><td>Land</td><td>Estland</td></tr>
          <tr><td>Zielort</td><td>Narva Festungstour</td></tr>
          <tr><td>Dauer</td><td>3 Tag(e)</td></tr>
          <tr><td>Preis</td><td>110 €</td></tr>
          <tr><td>Abfahrtsdatum</td><td>21.08.2023</td></tr>
          <tr><td>Abfahrtszeit</td><td>11:00</td></tr>
          <tr><td>Freie Plätze</td><td>4</td></tr>
          </tbody></table>
        <button class="btn" type="button" name="download" onclick="createPDF()">Download</button>
        </main>
      <button class="btn back" onclick="history.back()">Zurück</button>
  <footer>
    <p>© 2023 Traumreisen Wiesau GmbH</p>
    <p>© 2023 von webNview GmbH</p>
  </footer>


</body>
</html>
