<html>
  <head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="stylesheets/main.css">
    <link rel="stylesheet" type="text/css" href="stylesheets/reset.css">
    <script defer src="scripts/Funktionen.js"></script>
  </head>
  <body>
    <header>
      <h1>Reiseverwaltung</h1>
    </header>
    <main class="c-vertical c-horizontal">
      <div class="box">
        <h1 class="center">Login</h1>
        <p style="color:red;" id="fehler"></p>
        <form action="" method="post">
          <div class="flex">
          <input type="text" id="email" name="email" placeholder="Email" required/>
          <input type="password" id="password" name="password" placeholder="Password" required/>
          </div>
          <button type="submit" id="btn" class="btn middle" disabled>Login</button>
          <a href="Registrierung.php" class="middle" >Noch nicht Registriert?</a>
        </form>
      </div>
</main>
<footer>
  <p>© 2023 Reiseverwaltung GmbH</p>
  <p>© 2023 von Firmenname GmbH</p>
</footer>
</html>
  <script>
    // Elemente aus dem DOM holen
    let email = document.getElementById("email");
    let password = document.getElementById("password");
    let btn = document.getElementById("btn");

    // Funktion zum überprüfen der Email Adresse und Passwort
    function handleInput() {
    if (checkEmail(email.value)) {
      email.style.border = "2px solid #4CAF50";
    } else {
      email.style.border = "2px solid red";
    }
    if (password.value.length >= 8) {
      password.style.border = "2px solid #4CAF50";
    } else {
      password.style.border = "2px solid red";
    }
    if (checkEmail(email.value) && password.value.length >= 8) {
      btn.disabled = false;
    } else {
      btn.disabled = true;
    }
  }

  // Event Listener für die Eingabefelder
  email.addEventListener("input", handleInput);
  password.addEventListener("input", handleInput);
  </script>
  <?php
      if (isset($_POST['email']) && isset($_POST['password'])) {

        $email = $_POST['email'];
        $password = $_POST['password'];

        // Verbindung zur Datenbank wird hergestellt mit PDO
        try {
          $pdo = new PDO('mysql:host=localhost;dbname=reiseverwaltung', 'root', '');
        } catch (PDOException $e) {
          print "Error!: " . $e->getMessage() . "<br/>";
          die();
        }
        // check if email exists. if yes, get password from database. if no, show error message
        try {
          $sql = "SELECT passwort FROM kunde WHERE email = :email";
          $stmt = $pdo->prepare($sql);
          $stmt->execute([
            ':email' => $email
          ]);
          // returns the password from the database, if the email exists.
          // if the email does not exist, it returns false
          $result = $stmt->fetch(PDO::FETCH_ASSOC);
            var_dump($result['passwort']);
          // if the email exists, check if the password is correct
          if ($result) {
            // if the password is correct, redirect to the index page
            if (password_verify($password, $result['passwort'])) {
              header('Location: start.php');
            } else {
              // if the password is incorrect, show error message
              echo "<script>document.getElementById('fehler').innerHTML = 'Passwort ist falsch!'</script>";
            }
          } else {
            // if the email does not exist, show error message
            echo "<script>document.getElementById('fehler').innerHTML = 'Email existiert nicht!'</script>";
          }

        } catch (PDOException $e) {
          print "Error!: " . $e->getMessage() . "<br/>";
          die();
        }
      }
    ?>