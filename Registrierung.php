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
            <button type="button" tooltip="Das Passwort muss mindestens 8 Zeichen beinhalten mit mindestens einen Groß- und Kleinbuchstaben,Sonderzeichen und Zahl"class="invisible"><img class="icon" src="images/information.png"/></button>
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
          <button type="submit" id="btn" class="btn middle" disabled>Registrieren</button>
          <a href="Login.php" class="middle" >Bereits Registriert?</a>
        </form>
      </div>
</main>
</html>
  <script>
    tests = [false, false, false, false, false, false, false, false, false, false];
    function get(id) { return document.getElementById(id) }
      function TestInputLength(element, len, direction=">") {
        if (direction = ">") {
          if (element.value.length > len) { element.style.border = "2px solid #4CAF50"; return true; }
          else { element.style.border = "2px solid red"; return false; }
        } else {
          if (element.value.length < len) { element.style.border = "2px solid #4CAF50"; return true; }
          else { element.style.border = "2px solid red"; return false; }
        }
      }
      function TestInput(element, stmt) {
        if (stmt) { element.style.border = "2px solid #4CAF50"; return true;}
        else { element.style.border = "2px solid red"; return false; }
      }

      // Prüft, ob alle Felder ausgefüllt sind
      get("vorname").addEventListener("input", function () { tests[0] = TestInputLength(get("vorname"), 0); });
      get("nachname").addEventListener("input", function () { tests[1] = TestInputLength(get("nachname"), 0); });
      get("strasse").addEventListener("input", function () { tests[2] = TestInputLength(get("strasse"), 0); });
      get("ort").addEventListener("input", function () { tests[3] = TestInputLength(get("ort"), 0); });

      // Prüft, ob die Email-Adresse gültig ist
      get("email").addEventListener("input", function () {
        tests[4] = TestInput(get("email"), checkEmail(get("email").value))
      });
      // Prüft, ob das Passwort mindestens 8 Zeichen lang ist und ob es mindestens einen Groß- und Kleinbuchstaben, Sonderzeichen und Zahl beinhaltet
      get("password").addEventListener("input", function () {
        tests[5] = TestInput(get("password"), checkPassword(get("password").value))
      });
      // Prüft, ob das Passwort mit dem wiederholten Passwort übereinstimmt
      get("password2").addEventListener("input", function () {
        tests[6] = TestInput(get("password2"), get("password").value == get("password2").value)
      });
      // Prüft, ob das Geburtsdatum vor dem heutigen Datum liegt und ob es angegeben wurde
      get("gebdat").addEventListener("input", function () {
        tests[7] = TestInput(get("gebdat"), new Date(get("gebdat").value) < new Date());
      });
      // Prüft, ob die Hausnummer eine Zahl ist
      get("nummer").addEventListener("input", function () {
        if (isNaN(get("nummer").value))get("nummer").style.border = "2px solid red";
        else { get("nummer").style.border = "2px solid #4CAF50"; tests[8] = true; }
        tests[8] = TestInputLength(get("nummer"), 0);
      });
      // Prüft, ob die Postleitzahl 4 oder 5 Zeichen lang ist und ob es eine Zahl ist
      get("plz").addEventListener("input", function () {
        if (isNaN(get("plz").value)) get("plz").style.border = "2px solid red";
        else { get("nummer").style.border = "2px solid #4CAF50"; tests[9] = true; }
        if (get("plz").value.length == 5 || get("plz").value.length == 4) {
          get("plz").style.border = "2px solid #4CAF50";
          tests[9] = true;
        } else get("plz").style.border = "2px solid red";
      });
      // Prüft, ob alle Felder ausgefüllt sind und aktiviert den Button
      setInterval(function () {
        if (tests.every(function (e) { return e })) get("btn").disabled = false;
        else get("btn").disabled = true;
      }, 100);

  </script>