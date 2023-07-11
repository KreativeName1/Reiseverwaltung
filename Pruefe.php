<html>
  <head>
    <title>Püfe</title>
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
      <h1>Reiseverwaltung</h1>
      <a href="Ausloggen.php" class="btn">Ausloggen</a>
    </header>
    <main class="c-vertical c-horizontal">
      
      <button class="btn back" onclick="history.back()">Zurück</button>
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