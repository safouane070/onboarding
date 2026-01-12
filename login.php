<?php
session_start();

// If user is already logged in, redirect to dashboard
if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit();
}

require_once 'db.php';

$error = '';
$username = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        $error = 'Vul zowel gebruikersnaal als wachtwoord in.';
    } else {
        try {
            // Check if user exists
            $stmt = $pdo->prepare("SELECT id, username, password, role FROM users WHERE username = ? OR email = ?");
            $stmt->execute([$username, $username]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password'])) {
                // Password is correct, start session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];

                // Regenerate session ID to prevent session fixation
                session_regenerate_id(true);

                // Redirect to onboarding
                header('Location: onboarding.php');
                exit();
            } else {
                $error = 'Ongeldige gebruikersnaam of wachtwoord.';
            }
        } catch (PDOException $e) {
            $error = 'Er is een fout opgetreden. Probeer het later opnieuw.';
            // For debugging: $error = 'Databasefout: ' . $e->getMessage();
        }
    }
}
?>
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
      <?php if ($error): ?>
        <div class="error-message">
          <p><?php echo htmlspecialchars($error); ?></p>
        </div>
      <?php endif; ?>

      <form method="POST" action="" novalidate>
        <div class="form-group">
          <label for="username">Gebruikersnaam:</label>
          <input id="username" name="username" type="text" value="<?php echo htmlspecialchars($username); ?>" required autofocus/>
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
    <p>© Technolab Leiden | Onboarding - Chahid</p>
  </footer>
</div>
</body>
</html>
