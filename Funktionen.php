<?php
function db_oeffnen($dbname = "reiseverwaltung",$benutzername = "root")
{
	try
    {
      $db = new PDO("mysql:host=localhost;dbname=".$dbname.";charset=utf8",$benutzername);
    }
    catch (PDOException $e)
    {
      die("Verbindungsfehler!: " . $e->getMessage() . "<br/>");
	}
	return $db;
}


// A function to run a query with prepared statements and return the result
function runQuery($db, $sql, $param = null)
{
  try
  {
    if ($param == null)
      $stmt = $db->query($sql);
    else {
    $stmt = $db->prepare($sql);
    $stmt->execute($param);
    }
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
  }
  catch (PDOException $e)
  {
    die("Befehl-Fehler!: " . $e->getMessage() . "<br/>");
  }
  return $result;
}
?>