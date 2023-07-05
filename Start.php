<html>
  <head>
    <title>Start</title>
    <link rel="stylesheet" type="text/css" href="stylesheets/main.css">
    <link rel="stylesheet" type="text/css" href="stylesheets/reset.css">
    <script defer src="scripts/Funktionen.js"></script>
  </head>
  <body>
    <header>
      <h1>Reiseverwaltung</h1>
    </header>
    <main class="c-vertical c-horizontal">
    <?php
    // Php hier
    $mydb = db_oeffnen("reiseverwaltung","root");
    $sql = "SELECT DISTINCT id, DISTINCT name
            From land
    
          ";
    $cursor=$mydb->query($sql);
    $satz=$cursor->fetch(PDO::FETCH_ASSOC);
    echo "<select name='land' size='1'>";
    echo "<option value='$satz[id]' checked> $satz[name]</option>";
    while ($satz)
    {
      $satz=$cursor->fetch(PDO::FETCH_ASSOC);

      echo "<option value='$satz[id]' checked> $satz[name]</option>";
    }




    function db_oeffnen($dbname,$benutzername)
{
	try 
    {
       $mydb =  new PDO("mysql:host=localhost;dbname=".$dbname.";charset=utf8",$benutzername);
    } 
    catch (PDOException $e)
    {
   
      echo( "Error!: " . $e->getMessage() . "<br/>");
	  die('das Programm wird beendet');
	}
	return $mydb;
}
    
    ?>
    </main>
    <footer>
      <p>© 2023 Reiseverwaltung GmbH</p>
      <p>© 2023 von Firmenname GmbH</p>
    </footer>
  </body>
</html>
  <script>
    // javascript hier
  </script>