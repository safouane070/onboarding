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
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Admin Hub</title>
    <link rel="stylesheet" href="../assets/css/onboarding.css" />
    <link rel="stylesheet" href="../assets/css/admin_nav.css" />
</head>
<body>
<nav class="admin-nav">
    <span class="brand">Admin</span>
    <a href="admin_hub.php" class="current">Hub</a>
    <a href="connect_emails.php">E-mails koppelen</a>
    <a href="toewijzen.php">Toewijzen</a>
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

    <main class="main">
        <div class="layout">
            <div class="progress-card" style="grid-column: 1 / -1;">
                <div class="progress-info">
                    <h2>Beheer</h2>
                    <p>Kies een pagina hieronder.</p>
                </div>
            </div>

            <div class="checklist" style="grid-column: 1 / -1;">
                <div class="checklist-item">
                    <div class="left">
                        <span>E-mails koppelen</span>
                    </div>
                    <a class="btn" href="connect_emails.php">Open</a>
                </div>

                <div class="checklist-item">
                    <div class="left">
                        <span>Checklists toewijzen</span>
                    </div>
                    <a class="btn" href="toewijzen.php">Open</a>
                </div>

                <div class="checklist-item">
                    <div class="left">
                        <span>Checklist beheren</span>
                    </div>
                    <a class="btn" href="checklist.php">Open</a>
                </div>

                <div class="checklist-item">
                    <div class="left">
                        <span>Afvinklijsten beheren</span>
                    </div>
                    <a class="btn" href="afvinklijsten_beheren.php">Open</a>
                </div>

                <div class="checklist-item">
                    <div class="left">
                        <span>Onboarding dashboard</span>
                    </div>
                    <a class="btn" href="onboarding.php">Open</a>
                </div>
            </div>
        </div>
    </main>

    <footer class="footer">
        <p>Technolab Leiden | Admin</p>
    </footer>
</body>
</html>
