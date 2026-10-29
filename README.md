# Onboarding-app — Technolab

Een webapplicatie waarmee nieuwe medewerkers stap voor stap worden ingewerkt. De beheerder stelt
afvinklijsten samen en wijst ze toe; de medewerker ziet zijn eigen checklist en vinkt taken af.
Gebouwd tijdens de stage bij **Technolab (Leiden)**, voor zo'n 30 nieuwe medewerkers.

![PHP](https://img.shields.io/badge/PHP-8-777BB4?logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL%2FMariaDB-4479A1?logo=mysql&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-vanilla-F7DF1E?logo=javascript&logoColor=black)

## Functionaliteit

- **Inloggen en registreren** met gehashte wachtwoorden (`password_hash`) en twee rollen: beheerder en medewerker.
- **Beheer** (`root/admin_hub.php`): taken en afvinklijsten aanmaken, bewerken en verwijderen.
- **Toewijzen** (`root/toewijzen.php`): een afvinklijst koppelen aan een of meer medewerkers.
- **Checklist** (`root/checklist.php`): de medewerker ziet zijn eigen taken en vinkt ze af. Afvinken,
  bijwerken en verwijderen gaat zonder herladen via kleine API-endpoints (`api/task_*.php`).
- Database via **PDO met prepared statements**.

## Lokaal draaien (XAMPP)

1. Zet de map in `htdocs` en start Apache en MySQL.
2. Maak in phpMyAdmin een database `onboarding` aan en importeer `Database/onboarding.sql`.
3. Pas zo nodig de gegevens aan in `includes/db.php` (standaard: `root` zonder wachtwoord).
4. Open `http://localhost/onboarding/` en registreer een account.

## Team

Gebouwd met medestagiairs Amr Alhemyari en Chahid Benhammadi. Mijn deel (Safouane Lahoua): de
checklist-functionaliteit — toewijzen, afvinken, bijwerken en verwijderen — en de frontend daarvan.
