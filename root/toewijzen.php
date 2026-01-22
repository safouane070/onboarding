<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit();
}

if (($_SESSION['role'] ?? 'user') !== 'admin') {
    header('Location: onboarding.php');
    exit();
}

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
$users = $pdo->query("SELECT id, username, email FROM users ORDER BY COALESCE(username, email)")->fetchAll();
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Afvinklijst Toewijzen</title>
    <link rel="stylesheet" href="../assets/css/toewijzen.css">
    <link rel="stylesheet" href="../assets/css/admin_nav.css">
</head>
<body>

<nav class="admin-nav">
    <span class="brand">Admin</span>
    <a href="admin_hub.php">Hub</a>
    <a href="connect_emails.php">E-mails koppelen</a>
    <a href="toewijzen.php" class="current">Toewijzen</a>
    <a href="checklist.php">Checklist</a>
    <a href="afvinklijsten_beheren.php">Afvinklijsten</a>
    <a href="onboarding.php">Onboarding</a>
    <a href="../auth/logout.php" class="logout" onclick="showLogoutModal(event, '../auth/logout.php')">Uitloggen</a>
</nav>

<!-- Logout confirmation modal -->
<div class="logout-modal" id="logoutModal">
    <div class="logout-modal-content">
        <h3>Uitloggen</h3>
        <p>Weet je zeker dat je wilt uitloggen?</p>
        <div class="logout-modal-buttons">
            <button class="btn-cancel" onclick="closeLogoutModal()">Annuleren</button>
            <button class="btn-confirm" onclick="confirmLogout()">Uitloggen</button>
        </div>
    </div>
</div>

<script>
let logoutUrl = '';

function showLogoutModal(event, url) {
    event.preventDefault();
    logoutUrl = url;
    document.getElementById('logoutModal').classList.add('show');
}

function closeLogoutModal() {
    document.getElementById('logoutModal').classList.remove('show');
}

function confirmLogout() {
    window.location.href = logoutUrl;
}
</script>

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
                                <p class="user-name"><?= htmlspecialchars($u["username"] ?: ($u["email"] ?? "")) ?></p>
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
