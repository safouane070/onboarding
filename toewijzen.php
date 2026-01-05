<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Afvinklijst Toewijzen</title>
    <link rel="stylesheet" href="toewijzen.css">
</head>

<body>

<header class="header">
    <nav class="nav">

        <!-- LEFT: LOGO -->
        <div class="nav-left">
            <svg viewBox="0 0 48 48" width="34">
                <path d="M13.8261 30.5736C16.7203 29.8826 20.2244 29.4783 24 29.4783C27.7756 29.4783 31.2797 29.8826 34.1739 30.5736C36.9144 31.2278 39.9967 32.7669 41.3563 33.8352L24.8486 7.36089C24.4571 6.73303 23.5429 6.73303 23.1514 7.36089L6.64374 33.8352C8.00331 32.7669 11.0856 31.2278 13.8261 30.5736Z"/>
            </svg>
            <h1 class="brand">Technolab Leiden</h1>
        </div>

        <!-- RIGHT (desktop) -->
        <div class="nav-right desktop-only">
            <div class="avatar"></div>
        </div>

        <!-- HAMBURGER -->
        <div class="hamburger" id="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>

    </nav>

    <!-- MOBILE MENU -->
    <div class="mobile-menu" id="mobileMenu">
        <a href="#">Meldingen</a>
        <a href="#">Help</a>
        <a href="#">Profiel</a>
    </div>
</header>

<main class="container">

    <h2 class="title">Afvinklijst Toewijzen</h2>

    <div class="columns">

        <!-- LIST SELECT -->
        <section class="card">
            <h3>Kies een Afvinklijst</h3>

            <label class="full">
                <p class="label">Selecteer een lijst</p>

                <div class="select-wrap">
                    <select>
                        <option selected>Veiligheidsprocedures Lab 1</option>
                        <option>Introductie 3D Printen</option>
                        <option>Onderhoud Lasersnijder</option>
                        <option>Basiselektronica Workshop</option>
                    </select>
                </div>
            </label>

            <div class="card-info">
                <div class="icon">i</div>
                <div>
                    <p class="info-title">Geselecteerde lijst</p>
                    <p class="info-value">Veiligheidsprocedures Lab 1</p>
                    <p class="info-text">Deze lijst bevat alle veiligheidscontroles voor laboratorium 1.</p>
                </div>
            </div>
        </section>

        <!-- USER SELECT -->
        <section class="card">
            <h3>Selecteer Gebruikers</h3>

            <div class="search">
                <input type="text" placeholder="Zoek op naam of e-mail...">
            </div>

            <p class="select-info">3 gebruikers geselecteerd</p>

            <div class="user-list">

                <label class="user">
                    <input type="checkbox" checked>
                    <div class="avatar small"></div>
                    <div>
                        <p class="user-name">Janneke de Vries</p>
                        <p class="user-email">janneke@example.com</p>
                    </div>
                </label>

                <label class="user">
                    <input type="checkbox">
                    <div class="avatar small"></div>
                    <div>
                        <p class="user-name">Pieter Janssen</p>
                        <p class="user-email">pieter@example.com</p>
                    </div>
                </label>

                <label class="user">
                    <input type="checkbox" checked>
                    <div class="avatar small"></div>
                    <div>
                        <p class="user-name">Fatima el Amrani</p>
                        <p class="user-email">fatima@example.com</p>
                    </div>
                </label>

            </div>

        </section>

    </div>

    <div class="bottom">
        <button class="assign-btn">Toewijzen ➜</button>
    </div>

</main>

<script src="toewijzen.js"></script>
</body>
</html>
