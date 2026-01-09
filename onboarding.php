<?php
session_start();
require 'db.php';

$userId = $_SESSION['user_id'];

$stmt = $pdo->prepare("
    SELECT ci.id, ci.title,
           IF(cp.completed IS NULL, 0, cp.completed) AS completed
    FROM checklist_items ci
    JOIN checklist_assignments ca ON ca.checklist_id = ci.checklist_id
    LEFT JOIN checklist_progress cp ON cp.checklist_item_id = ci.id AND cp.user_id = ?
    WHERE ca.user_id = ?
");
$stmt->execute([$userId, $userId]);
$items = $stmt->fetchAll();

// Bereken voortgang
$total = count($items);
$done = array_sum(array_column($items,'completed'));
$percent = $total ? round($done/$total*100) : 0;
?>


<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Onboarding Dashboard</title>

    <link rel="stylesheet" href="onboarding.css" />
</head>

<body>

<div class="page">

    <!-- ========================= -->
    <!-- RESPONSIVE NAVIGATION BAR -->
    <!-- ========================= -->
    <header class="header">
        <nav class="nav">

            <div class="nav-left">
                <svg width="32" height="32" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4 4H18.6667V10.6667H12V28H4V4Z" fill="#44205F"></path>
                    <path d="M21.3333 21.3333H28V28H21.3333V21.3333Z" fill="#44205F"></path>
                </svg>
                <span class="brand">TechnoLab Leiden</span>
            </div>

            <div class="nav-right desktop-only">
                <span class="welcome">Welkom, <?php echo htmlspecialchars($_SESSION['username'] ?? 'Gebruiker'); ?>!</span>
                <a href="logout.php" class="logout-btn">Uitloggen</a>
            </div>

            <!-- Hamburger -->
            <div class="hamburger" id="hamburger">
                <span></span><span></span><span></span>
            </div>

        </nav>

        <!-- Mobile dropdown -->
        <div class="mobile-menu" id="mobileMenu">
            <a href="onboarding.php">Onboarding</a>
            <a href="toewijzen.php">Toewijzen</a>
            <a href="logout.php" class="mobile-logout">Uitloggen</a>
        </div>
    </header>

    <!-- ========================= -->
    <!-- MAIN CONTENT -->
    <!-- ========================= -->
    <main class="main">
        <div class="layout">

            <div class="progress-card">

                <div class="progress-wrapper">
                    <svg viewBox="0 0 120 120">
                        <circle cx="60" cy="60" r="54" class="progress-bg"></circle>
                        <circle cx="60" cy="60" r="54" class="progress-bar"></circle>
                    </svg>

                    <div class="progress-center">
                        <span class="progress-num">0%</span>
                        <span class="progress-text">voltooid</span>
                    </div>
                </div>

                <div class="progress-info">
                    <h2>Jouw Voortgang</h2>
                    <p>Laten we je account instellen. Voltooi alle stappen om te beginnen.</p>
                </div>
            </div>

            <div class="checklist">
                <?php foreach($items as $item): ?>
                    <div class="checklist-item">
                        <div class="left">
                            <div class="circle"></div>
                            <span><?= ($item['title']) ?></span>
                        </div>
                        <button class="btn" >Bekijk details</button>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>
    </main>

    <!-- ========================= -->
    <!-- FOOTER -->
    <!-- ========================= -->
    <footer class="footer">
        <p>© Technolab Leiden | Onboarding - Safouane</p>
    </footer>

</div>

<script src="onboarding.js"></script>
</body>
</html>
