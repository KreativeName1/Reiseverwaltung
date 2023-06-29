<html>
  <head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="stylesheets/main.css">
    <link rel="stylesheet" type="text/css" href="stylesheets/reset.css">
  </head>
  <body>
    <div class="container">
      <div class="login">
        <h1>Login</h1>
        <form action="login.php" method="post">
          <input type="text" name="username" placeholder="Username" required="required" />
          <input type="password" name="password" placeholder="Password" required="required" />
          <button type="submit" class="btn accent">Login</button>
          <a href="Registrierung.php">Noch nicht Registriert?</a>
        </form>
      </div>
    </div>
</html>