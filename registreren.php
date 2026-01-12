<?php
session_start();
require_once 'db.php';

$errors = [];
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm-password'] ?? '';

    // Validate input
    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $errors[] = "Alle velden zijn verplicht.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Ongeldig e-mailadres.";
    }

    if ($password !== $confirm_password) {
        $errors[] = "Wachtwoorden komen niet overeen.";
    }

    if (strlen($password) < 8) {
        $errors[] = "Wachtwoord moet minimaal 8 karakters lang zijn.";
    }

    if (empty($errors)) {
        try {
            // Check if username or email already exists
            $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
            $stmt->execute([$username, $email]);

            if ($stmt->rowCount() > 0) {
                $errors[] = "Gebruikersnaam of e-mailadres is al in gebruik.";
            } else {
                // Hash password and insert new user
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare("INSERT INTO users (username, email, password, created_at) VALUES (?, ?, ?, NOW())");

                if ($stmt->execute([$username, $email, $hashed_password])) {
                    $success = "Registratie succesvol! U kunt nu inloggen.";
                    // Clear form
                    $username = $email = '';
                } else {
                    $errors[] = "Er is een fout opgetreden. Probeer het later opnieuw.";
                }
            }
        } catch (PDOException $e) {
            $errors[] = "Databasefout: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Technolab Registeren</title>
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
      <h1>Account Aanmaken</h1>
      <?php if (!empty($errors)): ?>
        <div class="error-message">
          <?php foreach ($errors as $error): ?>
            <p><?php echo htmlspecialchars($error); ?></p>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>

      <?php if ($success): ?>
        <div class="success-message">
          <p><?php echo htmlspecialchars($success); ?></p>
        </div>
      <?php endif; ?>

      <form method="POST" action="" novalidate>
        <div class="form-group">
          <label for="username">Gebruikersnaam:</label>
          <input id="username" name="username" type="text" value="<?php echo isset($username) ? htmlspecialchars($username) : ''; ?>" required/>
        </div>
        <div class="form-group">
          <label for="email">E-mail:</label>
          <input id="email" name="email" type="email" value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>" required/>
        </div>
        <div class="form-group">
          <label for="password">Wachtwoord:</label>
          <input id="password" name="password" type="password" required/>
        </div>
        <div class="form-group">
          <label for="confirm-password">Bevestig wachtwoord:</label>
          <input id="confirm-password" name="confirm-password" type="password" required/>
        </div>
        <button type="submit">Registreren</button>
      </form>
      <div class="links">
        <a href="login.php">Terug naar inloggen</a>
      </div>
    </div>
  </main>

  <footer>
    <p>© Technolab Leiden | Onboarding - Chahid</p>
  </footer>
</div>
</body>
</html>
