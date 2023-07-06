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
    <?php
    // Php hier
    $mydb = db_oeffnen();
    $sql = "SELECT name, id
            From ziel
            Where CurrentDate < abfahrtsdatum
          ";
    $cursor=$mydb->query($sql);
    $satz=$cursor->fetch(PDO::FETCH_ASSOC);
    while($satz)
    {
    echo "<button type='radio' name='ziel' value='$satz[id]'>$satz[name]</button>";
    $satz=$cursor->fetch(PDO::FETCH_ASSOC);
    }
    ?>
  </head>
  <body>
    <header>
      <h1>Reiseverwaltung</h1>
    </header>
    <main class="c-vertical c-horizontal">
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