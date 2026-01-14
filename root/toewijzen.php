<?php
// ================= DB CONNECTIE =================
$host = "127.0.0.1";
$db   = "onboarding";
$user = "root";
$pass = "";
$charset = "utf8mb4";

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (Exception $e) {
    die("Databaseverbinding mislukt");
}

// ================= FORM VERWERKEN =================
$success = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $checklist_id = (int)($_POST["checklist_id"] ?? 0);
    $users = $_POST["users"] ?? [];

    if ($checklist_id && !empty($users)) {
        $stmt = $pdo->prepare("
            INSERT IGNORE INTO checklist_assignments (user_id, checklist_id)
            VALUES (:user_id, :checklist_id)
        ");

        foreach ($users as $user_id) {
            $stmt->execute([
                "user_id" => (int)$user_id,
                "checklist_id" => $checklist_id
            ]);
        }
        $success = true;
    }
}

// ================= DATA OPHALEN =================
$checklists = $pdo->query("SELECT id, title FROM checklists ORDER BY title")->fetchAll();
$users = $pdo->query("SELECT id, username, email FROM users ORDER BY username")->fetchAll();
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Afvinklijst Toewijzen</title>
    <link rel="stylesheet" href="../assets/css/toewijzen.css">
</head>
<body>

<header class="header">
    <nav class="nav">
        <div class="nav-left">
            <h1 class="brand">Technolab Leiden</h1>
        </div>
        <div class="nav-right desktop-only">
            <div class="avatar"></div>
        </div>
        <div class="hamburger" id="hamburger">
            <span></span><span></span><span></span>
        </div>
    </nav>

    <div class="mobile-menu" id="mobileMenu">
        <a href="#">Meldingen</a>
        <a href="#">Help</a>
        <a href="#">Profiel</a>
    </div>
</header>

<main class="container">
    <h2 class="title">Afvinklijst Toewijzen</h2>

    <?php if ($success): ?>
        <p style="color:green;font-weight:700;">✔ Checklist succesvol toegewezen</p>
    <?php endif; ?>

    <form method="post">
        <div class="columns">

            <!-- CHECKLIST -->
            <section class="card">
                <h3>Kies een Afvinklijst</h3>
                <label class="full">
                    <p class="label">Selecteer een lijst</p>
                    <div class="select-wrap">
                        <select name="checklist_id" required>
                            <option value="">-- Kies een checklist --</option>
                            <?php foreach ($checklists as $c): ?>
                                <option value="<?= $c["id"] ?>">
                                    <?= htmlspecialchars($c["title"]) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </label>
            </section>

            <!-- USERS -->
            <section class="card">
                <h3>Selecteer Gebruikers</h3>

                <div class="search">
                    <input type="text" id="userSearch" placeholder="Zoek op naam of e-mail...">
                </div>

                <p class="select-info" id="selectedCount">0 gebruikers geselecteerd</p>

                <div class="user-list" id="userList">
                    <?php foreach ($users as $u): ?>
                        <label class="user">
                            <input type="checkbox" name="users[]" value="<?= $u["id"] ?>">
                            <div class="avatar small"></div>
                            <div>
                                <p class="user-name"><?= htmlspecialchars($u["username"]) ?></p>
                                <p class="user-email"><?= htmlspecialchars($u["email"] ?? "") ?></p>
                            </div>
                        </label>
                    <?php endforeach; ?>
                </div>
            </section>

        </div>

        <div class="bottom">
            <button class="assign-btn" type="submit">Toewijzen ➜</button>
        </div>
    </form>
</main>

<script src="../assets/js/toewijzen.js"></script>
</body>
</html>
