<?php
session_start();
require_once __DIR__ . '/../includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit();
}

if (($_SESSION['role'] ?? 'user') !== 'admin') {
    header('Location: onboarding.php');
    exit();
}

$userId = isset($_GET['user_id']) ? (int)$_GET['user_id'] : null;

/* Alle users voor dropdown */
$users = $pdo->query("
    SELECT id, username, email
    FROM users
    ORDER BY COALESCE(username, email)
")->fetchAll(PDO::FETCH_ASSOC);

$checklist = null;
$tasks = [];

/* Checklist + taken van geselecteerde gebruiker */
if ($userId) {
    $stmt = $pdo->prepare("
        SELECT c.id, c.title
        FROM checklists c
        JOIN checklist_assignments ca ON ca.checklist_id = c.id
        WHERE ca.user_id = ?
        LIMIT 1
    ");
    $stmt->execute([$userId]);
    $checklist = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($checklist) {
        $stmt = $pdo->prepare("
            SELECT
                ci.id,
                ci.title,
                ci.sort_order,
                COALESCE(cp.completed, 0) AS completed
            FROM checklist_items ci
            LEFT JOIN checklist_progress cp
                ON cp.checklist_item_id = ci.id
               AND cp.user_id = ?
            WHERE ci.checklist_id = ?
            ORDER BY ci.sort_order
        ");
        $stmt->execute([$userId, $checklist['id']]);
        $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Checklist beheren</title>
    <link rel="stylesheet" href="../assets/css/checklist.css">
    <link rel="stylesheet" href="../assets/css/admin_nav.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
</head>
<body class="page">

<nav class="admin-nav">
    <span class="brand">Admin</span>
    <a href="admin_hub.php">Hub</a>
    <a href="connect_emails.php">E-mails koppelen</a>
    <a href="toewijzen.php">Toewijzen</a>
    <a href="checklist.php" class="current">Checklist</a>
    <a href="onboarding.php">Onboarding</a>
    <a href="../auth/logout.php">Uitloggen</a>
</nav>



<div class="layout">
<main class="main">

<!-- ================= TOP ================= -->
<div class="top-bar">
    <div class="title-block">
        <h2>Toegewezen Afvinklijst</h2>
        <p>Beheer taken per gebruiker</p>
    </div>

    <!-- ============ USER SEARCH (DROPDOWN) ============ -->
    <div class="user-select">
        <label for="user-search">Selecteer gebruiker</label>
        <div class="input-wrapper">
            <span class="material-symbols-outlined input-icon">search</span>
            <input
                id="user-search"
                type="text"
                placeholder="Zoek op naam of e-mail"
                autocomplete="off"
            >
        </div>

        <div class="dropdown" id="userDropdown">
            <?php foreach ($users as $u): ?>
                <div
                    class="dropdown-item"
                    data-id="<?= $u['id'] ?>"
                >
                    <div>
                        <strong><?= htmlspecialchars($u['username'] ?: ($u['email'] ?? '')) ?></strong><br>
                        <small><?= htmlspecialchars($u['email'] ?? '') ?></small>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- ================= TASKS ================= -->
<section
    class="task-section"
    id="taskSection"
    data-user-id="<?= $userId ?>"
    data-checklist-id="<?= $checklist['id'] ?? '' ?>"
>

<?php if (!$userId): ?>
    <p>Selecteer eerst een gebruiker.</p>

<?php elseif (!$checklist): ?>
    <p>Deze gebruiker heeft nog geen checklist.</p>

<?php else: ?>
    <h3><?= htmlspecialchars($checklist['title']) ?></h3>

    <div id="taskList">
        <?php foreach ($tasks as $task): ?>
            <div
                class="task-item"
                data-id="<?= $task['id'] ?>"
            >
                <span class="material-symbols-outlined drag-icon">drag_indicator</span>
                <input
                    type="checkbox"
                    class="task-complete"
                    <?= $task['completed'] ? 'checked' : '' ?>
                >
                <p class="task-title"><?= htmlspecialchars($task['title']) ?></p>
                <button class="edit" title="Bewerken">
                    <span class="material-symbols-outlined">edit</span>
                </button>
                <button class="delete" title="Verwijderen">
                    <span class="material-symbols-outlined">delete</span>
                </button>
            </div>
        <?php endforeach; ?>
    </div>

    <button class="add-task-btn" id="addTaskBtn">
        <span class="material-symbols-outlined">add</span>
        Nieuwe taak
    </button>
<?php endif; ?>

</section>
</main>
</div>

<script src="../assets/js/checklist.js"></script>
<script src="../assets/js/menu.js"></script>
</body>
</html>
