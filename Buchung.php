<html>
  <head>
    <title>Buchung</title>
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
      <?php
      
       echo "<h2>Vielen Dank für Ihre Buchung</h2>";
      $pdf = new FPDF();
      $pdf->AddPage(); 
      $pdf->SetFont('Arial', 'B', 16);
      $pdf->Cell(0, 10, 'Buchung', 0, 1);
      $pdf->Cell(0, 10, "adddd" . ' - ' . "ddafsdf", 0, 1);
      echo '<br><a href="?pdf=1">Buchungsbestätigung als PDF herunterladen</a>';

      ?>
    </main>
    <footer>
      <p>© 2023 Traumreisen Wiesau GmbH</p>
      <p>© 2023 von webNview GmbH</p>
    </footer>
  </body>
</html>
  <script>
  </script>