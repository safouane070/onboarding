<!DOCTYPE html>
<html lang="nl">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Technolab Login</title>
<link rel="stylesheet" href="login.css"/>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet"/>
</head>
<body>
<div class="container">
  <header>
    <img alt="Technolab Logo" class="logo" src=""/>
  </header>

  <main>
    <div class="login-box">
      <h1>Inloggen</h1>
      <form>
        <div class="form-group">
          <label for="username">Gebruikersnaam:</label>
          <input id="username" name="username" type="text" required/>
        </div>
        <div class="form-group">
          <label for="password">Wachtwoord:</label>
          <input id="password" name="password" type="password" required/>
        </div>
        <button type="submit">Log in</button>
      </form>
      <div class="links">
        <a href="registreren.php">Account aanmaken</a>
      </div>
    </div>
  </main>

  <footer>
    <p>© Technolab Leiden | Onboarding - Safouane</p>
  </footer>
</div>
</body>
</html>
