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
    <?php
    $mydb = db_oeffnen();
    $sql = "SELECT DISTINCT name, id
            From land
            Order by name ASC";

    $cursor=$mydb->query($sql);
    $satz=$cursor->fetch(PDO::FETCH_ASSOC);
    echo "<select name='land' size='1'>";
    while ($satz)
    {
      echo "<option value='$satz[id]' checked> $satz[name]</option>";
      $satz=$cursor->fetch(PDO::FETCH_ASSOC);
    }
    echo "</select>";
    echo "<button type='submit' class='btn middle' name='sub'>Weiter</button>";


    ?>
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