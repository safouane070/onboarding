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

$errors = [];
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $id = (int)($_POST['id'] ?? 0);
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');

    if ($action === 'delete' && $id) {
        try {
            $stmt = $pdo->prepare("DELETE FROM checklist_items WHERE checklist_id = ?");
            $stmt->execute([$id]);

            $stmt = $pdo->prepare("DELETE FROM checklist_assignments WHERE checklist_id = ?");
            $stmt->execute([$id]);

            $stmt = $pdo->prepare("DELETE FROM checklists WHERE id = ?");
            $stmt->execute([$id]);

            $success = 'Afvinklijst verwijderd.';
        } catch (PDOException $e) {
            $errors[] = 'Fout bij verwijderen: ' . $e->getMessage();
        }
    } elseif ($action === 'create' && $title) {
        try {
            $stmt = $pdo->prepare("INSERT INTO checklists (title, description) VALUES (?, ?)");
            $stmt->execute([$title, $description]);
            $success = 'Afvinklijst toegevoegd.';
        } catch (PDOException $e) {
            $errors[] = 'Fout bij toevoegen: ' . $e->getMessage();
        }
    } elseif ($action === 'edit' && $id && $title) {
        try {
            $stmt = $pdo->prepare("UPDATE checklists SET title = ?, description = ? WHERE id = ?");
            $stmt->execute([$title, $description, $id]);
            $success = 'Afvinklijst bijgewerkt.';
        } catch (PDOException $e) {
            $errors[] = 'Fout bij bewerken: ' . $e->getMessage();
        }
    }
}

$checklists = $pdo->query("SELECT * FROM checklists ORDER BY title")->fetchAll();
$edit = null;
if (isset($_GET['edit'])) {
    $stmt = $pdo->prepare("SELECT * FROM checklists WHERE id = ?");
    $stmt->execute([(int)$_GET['edit']]);
    $edit = $stmt->fetch();
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Afvinklijsten Beheren</title>
    <link rel="stylesheet" href="../assets/css/login.css"/>
    <link rel="stylesheet" href="../assets/css/admin_nav.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet"/>
</head>
<body>
<nav class="admin-nav">
    <span class="brand">Admin</span>
    <a href="admin_hub.php">Hub</a>
    <a href="connect_emails.php">E-mails koppelen</a>
    <a href="toewijzen.php">Toewijzen</a>
    <a href="checklist.php">Checklist</a>
    <a href="afvinklijsten_beheren.php" class="current">Afvinklijsten</a>
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

<main>
    <div class="login-box">
        <h1>Afvinklijsten Beheren</h1>

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

        <?php if ($edit): ?>
            <h2 style="font-size:20px;margin:0 0 20px 0;color:#374151;">Afvinklijst bewerken</h2>

            <form method="POST" action="" novalidate>
                <input type="hidden" name="action" value="edit">
                <input type="hidden" name="id" value="<?= $edit['id'] ?>">
                <div class="form-group">
                    <label for="title">Titel</label>
                    <input id="title" name="title" type="text" value="<?= htmlspecialchars($edit['title']) ?>" required>
                </div>
                <div class="form-group">
                    <label for="description">Beschrijving</label>
                    <textarea id="description" name="description" rows="3" placeholder="Optionele beschrijving"><?= htmlspecialchars($edit['description'] ?? '') ?></textarea>
                </div>
                <button type="submit">Bijwerken</button>
            </form>
        <?php else: ?>
            <h2 style="font-size:20px;margin:0 0 20px 0;color:#374151;">Nieuwe afvinklijst</h2>

            <form method="POST" action="" novalidate>
                <input type="hidden" name="action" value="create">
                <div class="form-group">
                    <label for="title">Titel</label>
                    <input id="title" name="title" type="text" placeholder="Nieuwe afvinklijst" required>
                </div>
                <div class="form-group">
                    <label for="description">Beschrijving</label>
                    <textarea id="description" name="description" rows="3" placeholder="Optionele beschrijving"></textarea>
                </div>
                <button type="submit">Toevoegen</button>
            </form>
        <?php endif; ?>

        <?php if (!empty($checklists)): ?>
            <div style="margin-top:24px;">
                <h2 style="font-size:18px;margin:0 0 16px 0;color:#374151;">Bestaande afvinklijsten</h2>
                <?php foreach ($checklists as $list): ?>
                    <div style="display:flex;align-items:center;justify-content:space-between;padding:16px;border:1px solid #e5e7eb;border-radius:8px;margin-bottom:12px;background:#fff;box-shadow:0 1px 3px rgba(0,0,0,0.05);">
                        <div>
                            <strong style="display:block;margin-bottom:4px;"><?= htmlspecialchars($list['title']) ?></strong>
                            <?php if ($list['description']): ?>
                                <small style="color:#6b7280;"><?= htmlspecialchars($list['description']) ?></small>
                            <?php endif; ?>
                        </div>
                        <div style="display:flex;gap:8px;">
                            <a href="?edit=<?= $list['id'] ?>" style="padding:8px 14px;font-size:0.85rem;background:#f3f4f6;color:#374151;text-decoration:none;border-radius:6px;transition:0.2s;">Bewerken</a>
                            <form method="POST" action="" style="display:inline;">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="id" value="<?= $list['id'] ?>">
                                <button type="submit" style="padding:8px 14px;font-size:0.85rem;background:#dc2626;color:#fff;border:none;border-radius:6px;cursor:pointer;transition:0.2s;" onclick="return confirm('Weet je zeker dat je deze afvinklijst wilt verwijderen?')">Verwijderen</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</main>

<footer>
    <p>© Technolab Leiden | Admin</p>
</footer>
</body>
</html>
