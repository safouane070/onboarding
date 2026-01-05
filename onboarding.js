/* -------------------------------
   CHECKLIST INTERACTIE + PROGRESS
--------------------------------- */


// MOBILE MENU OPEN/DICHT
const hamburger = document.getElementById("hamburger");
const mobileMenu = document.getElementById("mobileMenu");

hamburger.addEventListener("click", () => {
    mobileMenu.classList.toggle("open");

    if (mobileMenu.classList.contains("open")) {
        mobileMenu.style.display = "flex";
    } else {
        mobileMenu.style.display = "none";
    }
});


document.addEventListener("DOMContentLoaded", () => {

    const items = document.querySelectorAll(".checklist-item");
    const progressText = document.querySelector(".progress-num");
    const progressBar = document.querySelector(".progress-bar");

    let completed = 0;

    // Tel en update progressie
    function updateProgress() {
        const total = items.length;
        const percentage = Math.round((completed / total) * 100);

        progressText.textContent = percentage + "%";

        // Update circle animation
        const stroke = 339.292;
        const offset = stroke - (stroke * (percentage / 100));
        progressBar.style.strokeDashoffset = offset;
    }

    // Klik-event voor checklist items
    items.forEach(item => {
        const circle = item.querySelector(".circle");

        item.addEventListener("click", () => {

            // Toggle checked state
            if (circle.classList.contains("checked")) {
                circle.classList.remove("checked");
                completed--;
            } else {
                circle.classList.add("checked");
                completed++;
            }

            // Herbereken de voortgang
            updateProgress();
        });
    });

});


/* -------------------------------
   RESPONSIVE NAVIGATION
--------------------------------- */

document.addEventListener("DOMContentLoaded", () => {
    
    const hamburger = document.querySelector(".hamburger");
    const mobileNav = document.querySelector(".nav-mobile");

    // Openen/sluiten van mobiel menu
    hamburger.addEventListener("click", () => {
        mobileNav.classList.toggle("open");
    });

});
