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
                <span class="welcome">Welkom terug!</span>
            </div>

            <!-- Hamburger -->
            <div class="hamburger" id="hamburger">
                <span></span><span></span><span></span>
            </div>

        </nav>

        <!-- Mobile dropdown -->
        <div class="mobile-menu" id="mobileMenu">
            <a href="onboarding.php">onboarding</a>
            <a href="toewijzen.php">toewijzen<a>
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

            <div class="checklist-section">

                <h1 class="title">Onboarding Checklist</h1>
                <p class="subtitle">Voltooi de volgende stappen om je account in te stellen.</p>

                <div class="checklist">

                    <div class="checklist-item">
                        <div class="left">
                            <div class="circle"></div>
                            <span>Bevestig je e-mailadres</span>
                        </div>
                        <button class="btn">Bekijk details</button>
                    </div>

                    <div class="checklist-item">
                        <div class="left">
                            <div class="circle"></div>
                            <span>Stel je profiel in</span>
                        </div>
                        <button class="btn">Bekijk details</button>
                    </div>

                    <div class="checklist-item">
                        <div class="left">
                            <div class="circle"></div>
                            <span>Voltooi de welkomsttour</span>
                        </div>
                        <button class="btn">Bekijk details</button>
                    </div>

                    <div class="checklist-item">
                        <div class="left">
                            <div class="circle"></div>
                            <span>Nodig een teamlid uit</span>
                        </div>
                        <button class="btn">Bekijk details</button>
                    </div>

                    <div class="checklist-item">
                        <div class="left">
                            <div class="circle"></div>
                            <span>Maak je eerste project aan</span>
                        </div>
                        <button class="btn">Bekijk details</button>
                    </div>

                </div>
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
