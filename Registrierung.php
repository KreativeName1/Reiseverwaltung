<html>
  <head>
    <title>Registrierung</title>
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
        <h1 class="center">Registrierung</h1>
        <p style="color:red;" id="fehler"></p>
        <form action="" method="post">
        <div class="flex">
            <input type="text" id="vorname" name="vorname" placeholder="Vorname" required/>
            <input type="text" id="nachname" name="nachname" placeholder="Nachname" required/>
          </div>
          <div class="flex">
            <input type="password" id="password" name="password" placeholder="Password" required/>
            <input type="password" id="password2" name="password2" placeholder="Password wiederholen" required/>
            <button type="button" tooltip="Password muss mindestens 8 Zeichen beinhalten mit mindestens einen Groß- und Kleinbuchstaben,Sonderzeichen und Zahl"class="invisible"><img class="icon" src="images/information.png"/></button>
          </div>
          <div class="flex">
            <input type="date" id="gebdat" name="gebdat" required/>
            <input type="text" id="email" name="email" placeholder="Email" required/>
          </div>
          <div class="flex">
            <input type="text" id="strasse" name="strasse" placeholder="Straße" required/>
            <input type="number" id="nummer" name="nummer" placeholder="Hausnummer" required/>
          </div>
          <div class="flex">
            <input type="number" id="plz" name="plz" placeholder="Postleitzahl" min="1" max="99999" required/>
            <input type="text" id="ort" name="ort" placeholder="Ort" required/>
          </div>
          <button type="submit" id="btn" class="btn middle">Registrieren</button>
          <a href="Login.php" class="middle" >Bereits Registriert?</a>
        </form>
      </div>
</main>
</html>
  <script>
    function get(id) { return document.getElementById(id) }
      function TestInputLength(element, len, direction=">") {
        if (direction = ">") {
          if (element.value.length > len) element.style.border = "2px solid #4CAF50";
          else element.style.border = "2px solid red";
        } else {
          if (element.value.length < len) element.style.border = "2px solid #4CAF50";
          else element.style.border = "2px solid red";
        }
      }
      function TestInput(element, stmt) {
        if (stmt) element.style.border = "2px solid #4CAF50";
        else element.style.border = "2px solid red";
      }

      get("vorname").addEventListener("input", function () { TestInputLength(get("vorname"), 0); });
      get("nachname").addEventListener("input", function () { TestInputLength(get("nachname"), 0); });
      get("strasse").addEventListener("input", function () { TestInputLength(get("strasse"), 0); });
      get("ort").addEventListener("input", function () { TestInputLength(get("ort"), 0); });
      get("email").addEventListener("input", function () { TestInput(get("email"), checkEmail(get("email").value))});
      get("gebdat").addEventListener("input", function () {
        TestInputLength(get("gebdat"), 0);
        let gebdat = new Date(get("gebdat").value)
        let heute = new Date();
        TestInput(get("gebdat"), gebdat < heute);
      });
      get("password").addEventListener("input", function () { TestInput(get("password"), checkPassword(get("password").value))});

      //TODO PLZ und Hausnummer Prüfung
      get("plz").addEventListener("input", function() {
        if (blz.value >= 4 && blz.value <=5) blz.style.border = "2px solid #4CAF50";
        else blz.style.border = "2px solid #red";
      });

      // Passwort validierung

  </script>