<html>
  <head>
    <title>Zeige</title>
    <link rel="stylesheet" type="text/css" href="stylesheets/main.css">
    <link rel="stylesheet" type="text/css" href="stylesheets/reset.css">
    <script defer src="scripts/Funktionen.js"></script>

    <?php
    // Php hier
    $mydb = db_oeffnen("Datenbank","root");
    $sql = "SELECT name, id
            From ziel
    
          ";
    $cursor=$mydb->query($sql);
    $satz=$cursor->fetch(PDO::FETCH_ASSOC);
    while($satz)
    {
    echo "<button type='radio' name='ziel' value='$satz[id]'>$satz[name]</botton>";
    $satz=$cursor->fetch(PDO::FETCH_ASSOC);
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
  </head>
  <body>
    <header>
      <h1>Reiseverwaltung</h1>
    </header>
    <main class="c-vertical c-horizontal">
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