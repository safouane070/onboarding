<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Toegewezen Afvinklijst Aanpassen</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300..700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />

    <!-- CSS -->
    <link rel="stylesheet" href="checklist.css" />
</head>

<body class="page">

<div class="layout">

    <!-- ⭐⭐⭐ TECHNOLAB NAVBAR ⭐⭐⭐ -->
    <header class="header">
        <nav class="nav">

            <!-- LEFT LOGO -->
            <div class="nav-left">
                <svg viewBox="0 0 48 48" width="34">
                    <path d="M13.8261 30.5736C16.7203 29.8826 20.2244 29.4783 24 29.4783C27.7756 29.4783 31.2797 29.8826 34.1739 30.5736C36.9144 31.2278 39.9967 32.7669 41.3563 33.8352L24.8486 7.36089C24.4571 6.73303 23.5429 6.73303 23.1514 7.36089L6.64374 33.8352C8.00331 32.7669 11.0856 31.2278 13.8261 30.5736Z"/>
                </svg>
                <h1 class="brand">Technolab Leiden</h1>
            </div>

            <!-- RIGHT DESKTOP -->
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
    <!-- ⭐⭐⭐ EINDE TECHNOLAB NAVBAR ⭐⭐⭐ -->

    <!-- ⭐⭐⭐ ALLES HIERONDER IS 100% ONGWIJZIGD ⭐⭐⭐ -->
    <main class="main">

        <div class="top-bar">
            <div class="title-block">
                <h2>Toegewezen Afvinklijst Aanpassen</h2>
                <p>Bekijk en pas de afvinklijst hieronder aan voor de geselecteerde gebruiker.</p>
            </div>

            <div class="user-select">
                <label for="user-search">Selecteer een gebruiker</label>
                <div class="input-wrapper">

                    <!-- 🔥 SEARCH ICON NIET AANGEDRAAID -->
                    <span class="material-symbols-outlined input-icon">search</span>

                    <input id="user-search" type="text" placeholder="Zoek gebruiker..." />
                </div>

                <!-- DROPDOWN (id toegevoegd zodat JS 'm kan vinden) -->
                <div class="dropdown" id="userDropdown">
                    <ul>
                        <li class="dropdown-item">
                            <div class="avatar small" style='background-image:url("https://lh3.googleusercontent.com/aida-public/AB6AXuAybuPNJmx0r8NaFe1e5o55-2XJlDdA1Dqxec9TpKaxlEVRsPToGfIWiE7jh-Klp29tO6Huo3yI60cLZFFNK4IlkxdWxoUdhWfF39areZ_DgYjRajahvUhbKTHbREfzE4SyJ4TGYcuHMlsLJCUyQwR4jT31GgslkKEBmJLw2XUHN6WuNhwIUYx97SUvX7lplqmSKGwS-We7tzHbB1_KjDiQh1v72iMgEl9fWFmZAjp0u26I0G8kbVztkXOPPClcfcGiWx3Vn2u7B7c");'></div>
                            <div>
                                <p class="name">Janneke de Vries</p>
                                <p class="email">janneke.devries@example.com</p>
                            </div>
                        </li>

                        <li class="dropdown-item">
                            <div class="circle-letter">BP</div>
                            <div>
                                <p class="name">Bas Pietersen</p>
                                <p class="email">bas.pietersen@example.com</p>
                            </div>
                        </li>

                        <li class="dropdown-item">
                            <div class="circle-letter purple">LS</div>
                            <div>
                                <p class="name">Lotte Smits</p>
                                <p class="email">lotte.smits@example.com</p>
                            </div>
                        </li>

                        <li class="dropdown-item">
                            <div class="avatar small" style='background-image:url("https://lh3.googleusercontent.com/aida-public/AB6AXuBjHH-CqZrGjtDGuJ5AmCmZh0PvUF_ZU8IXn6WAMyzCxQLE-pyzB-G5D5pJsijvfb0d8J0aHW5mT_Pl8povCREDbr1xnETbC7bCbZ52BQk5jifgHJXiBGm86JbwFfOc3DChps2mTRcQ8cqke2_qwaxgKN0xIQoaGdjneB_rWDb_tV5zuG99-BMaGYaYAL7-H-GcsAWLKZ-6E49yuxqrw_Y8fHLFiikvo8KlV1YPgOfknX8GR-yTqISjbl8hRpADtWJxvQ770oJIAwc");'></div>
                            <div>
                                <p class="name">Erik van Dongen</p>
                                <p class="email">erik.vandongen@example.com</p>
                            </div>
                        </li>

                        <li class="dropdown-footer">Typ om meer gebruikers te zien…</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Checklist select -->
        <div class="checklist-select">
            <label for="checklist-btn">Selecteer een afvinklijst</label>
            <button id="checklist-btn">
                Veiligheidsprocedures Lab 1
                <span class="material-symbols-outlined">expand_more</span>
            </button>
        </div>

        <!-- Takenlijst -->
        <section class="task-section">
            <h3>Taken</h3>

            <div class="task-item">
                <span class="material-symbols-outlined drag-icon">drag_indicator</span>
                <p>Draag een veiligheidsbril</p>
                <button class="edit"><span class="material-symbols-outlined">edit</span></button>
                <button class="delete"><span class="material-symbols-outlined">delete</span></button>
            </div>

            <div class="task-item editing">
                <span class="material-symbols-outlined drag-icon">drag_indicator</span>
                <p>Controleer de noodstop van de lasersnijder"</p>
                <button class="ok"><span class="material-symbols-outlined">done</span></button>
                <button class="cancel"><span class="material-symbols-outlined">close</span></button>
            </div>

            <div class="task-item">
                <span class="material-symbols-outlined drag-icon">drag_indicator</span>
                <p>Zorg dat de afzuiging aan staat</p>
                <button class="edit"><span class="material-symbols-outlined">edit</span></button>
                <button class="delete"><span class="material-symbols-outlined">delete</span></button>
            </div>

            <div class="task-item personal">
                <span class="material-symbols-outlined drag-icon">drag_indicator</span>
                <p>Extra controle soldeerstation (persoonlijke taak)</p>

                <div class="personal-tag">
                    <span class="material-symbols-outlined">person</span>
                    <span>Gepersonaliseerd</span>
                </div>

                <button class="edit"><span class="material-symbols-outlined">edit</span></button>
                <button class="delete"><span class="material-symbols-outlined">delete</span></button>
            </div>

            <button class="add-task-btn">
                <span class="material-symbols-outlined">add_circle</span>
                Taak Toevoegen
            </button>
        </section>

        <div class="footer-actions">
            <button class="cancel-btn">Annuleren</button>
            <button class="save-btn">
                Opslaan
                <span class="material-symbols-outlined">save</span>
            </button>
        </div>

    </main>
</div>

<script src="toewijzen.js"></script>
</body>
</html>
