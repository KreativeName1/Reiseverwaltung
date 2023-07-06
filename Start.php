<html>
  <head>
    <title>Start</title>
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
      <form class="box center" action="Buche.php" method="post">
        <h1>Land-Wahl</h1>
        <p>Wählen Sie das Land aus, in das Sie reisen möchten.</p>

        <div class="land-box">
      <?php
      $mydb = db_oeffnen();
      $sql = "SELECT DISTINCT name, id, code
      From land
      Order by name ASC";

      $cursor=$mydb->query($sql);
      while ( $satz=$cursor->fetch(PDO::FETCH_ASSOC))
      {
        echo "
        <a class='land' href='Buche.php?land=$satz[code]'>
          <img  src='https://hatscripts.github.io/circle-flags/flags/$satz[code].svg' width='48'>
          <p>$satz[name]</p>
        </a>
        ";
      }
    ?>
    </div>
    </form>
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