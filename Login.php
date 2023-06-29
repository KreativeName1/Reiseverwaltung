<html>
  <head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="stylesheets/main.css">
    <link rel="stylesheet" type="text/css" href="stylesheets/reset.css">
    <script defer src="Funktionen.js"></script>
  </head>
  <body>
    <header>
      <h1>Reiseverwaltung</h1>
    </header>
    <main class="c-vertical c-horizontal">
      <div class="box">
        <h1 class="center">Login</h1>
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
    if (password.value.length > 8) {
      password.style.border = "2px solid #4CAF50";
    } else {
      password.style.border = "2px solid red";
    }
    if (checkEmail(email.value) && password.value.length > 8) {
      btn.disabled = false;
    } else {
      btn.disabled = true;
    }
  }

  // Event Listener für die Eingabefelder
  email.addEventListener("input", handleInput);
  password.addEventListener("input", handleInput);
  </script>