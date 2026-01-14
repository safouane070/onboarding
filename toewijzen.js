// toewijzen.js
document.addEventListener("DOMContentLoaded", () => {
    // --- Mobile hamburger/menu ---
    const hamburger = document.getElementById("hamburger");
    const mobileMenu = document.getElementById("mobileMenu");

    if (hamburger && mobileMenu) {
        hamburger.addEventListener("click", (e) => {
            e.stopPropagation();
            mobileMenu.classList.toggle("show");
        });

        // klik buiten mobile menu sluit het
        document.addEventListener("click", (e) => {
            if (!mobileMenu.classList.contains("show")) return;
            if (mobileMenu.contains(e.target)) return;
            if (hamburger.contains(e.target)) return;
            mobileMenu.classList.remove("show");
        });
    }

    // --- User search + dropdown ---
    const userSearch = document.getElementById("user-search");
    const userDropdown = document.getElementById("userDropdown");

    // Als er geen dropdown of input is, skip
    if (userSearch && userDropdown) {

        // Helper: open dropdown
        const openDropdown = () => userDropdown.classList.add("show");
        // Helper: close dropdown
        const closeDropdown = () => userDropdown.classList.remove("show");
        // Toggle
        const toggleDropdown = () => userDropdown.classList.toggle("show");

        // Focus/typing opent dropdown
        userSearch.addEventListener("focus", openDropdown);
        userSearch.addEventListener("input", () => {
            // eenvoudige filter: verberg items die niet matchen
            const q = userSearch.value.trim().toLowerCase();
            const items = userDropdown.querySelectorAll(".dropdown-item");
            items.forEach(item => {
                const nameEl = item.querySelector(".name");
                const emailEl = item.querySelector(".email");
                const text = (nameEl?.textContent || "") + " " + (emailEl?.textContent || "");
                item.style.display = text.toLowerCase().includes(q) ? "" : "none";
            });
            openDropdown();
        });

        // Klik op een dropdown-item: vul input en sluit
        userDropdown.addEventListener("click", (e) => {
            const item = e.target.closest(".dropdown-item");
            if (!item) return;
            const name = item.querySelector(".name")?.textContent?.trim() || "";
            const email = item.querySelector(".email")?.textContent?.trim() || "";
            userSearch.value = name || email || userSearch.value;
            closeDropdown();
        });

        // Klik buiten sluit dropdown (maar klikken op input niet)
        document.addEventListener("click", (e) => {
            if (!userDropdown.classList.contains("show")) return;
            if (userDropdown.contains(e.target)) return;
            if (userSearch.contains(e.target)) return;
            closeDropdown();
        });

        // Esc om te sluiten
        document.addEventListener("keydown", (e) => {
            if (e.key === "Escape") {
                closeDropdown();
                mobileMenu?.classList.remove("show");
            }
        });
    }

    // --- Optioneel: keyboard navigatie (pijltjes en enter) ---
    // (lichte, niet-obligatoire implementatie)
    if (userSearch && userDropdown) {
        let idx = -1;
        userSearch.addEventListener("keydown", (e) => {
            const visibleItems = Array.from(userDropdown.querySelectorAll(".dropdown-item"))
                .filter(it => it.style.display !== "none");
            if (!visibleItems.length) return;

            if (e.key === "ArrowDown") {
                e.preventDefault();
                idx = Math.min(idx + 1, visibleItems.length - 1);
                visibleItems.forEach(i => i.classList.remove("highlight"));
                visibleItems[idx].classList.add("highlight");
            } else if (e.key === "ArrowUp") {
                e.preventDefault();
                idx = Math.max(idx - 1, 0);
                visibleItems.forEach(i => i.classList.remove("highlight"));
                visibleItems[idx].classList.add("highlight");
            } else if (e.key === "Enter") {
                e.preventDefault();
                if (idx >= 0 && visibleItems[idx]) {
                    visibleItems[idx].click();
                }
            }
        });

        // verwijder highlight bij sluiten/blur
        userSearch.addEventListener("blur", () => {
            setTimeout(() => { // timeout zodat click() op item nog kan gebeuren
                userDropdown.querySelectorAll(".dropdown-item.highlight")
                    .forEach(i => i.classList.remove("highlight"));
            }, 150);
        });
    }
});


document.addEventListener("DOMContentLoaded", () => {

    // ===== Mobile menu =====
    const hamburger = document.getElementById("hamburger");
    const mobileMenu = document.getElementById("mobileMenu");

    if (hamburger && mobileMenu) {
        hamburger.addEventListener("click", () => {
            mobileMenu.classList.toggle("open");
        });
    }

    // ===== User search =====
    const searchInput = document.getElementById("userSearch");
    const users = document.querySelectorAll(".user");

    searchInput.addEventListener("input", () => {
        const q = searchInput.value.toLowerCase();

        users.forEach(user => {
            const name = user.querySelector(".user-name").textContent;
            const email = user.querySelector(".user-email").textContent;
            user.style.display =
                (name + email).toLowerCase().includes(q) ? "flex" : "none";
        });
    });

    // ===== Selected counter =====
    const checkboxes = document.querySelectorAll(".user input[type='checkbox']");
    const counter = document.getElementById("selectedCount");

    function updateCounter() {
        const count = [...checkboxes].filter(c => c.checked).length;
        counter.textContent = `${count} gebruiker${count !== 1 ? "s" : ""} geselecteerd`;
    }

    checkboxes.forEach(cb => cb.addEventListener("change", updateCounter));
    updateCounter();

    // ===== Limit visible users (no scroll) =====
    const MAX_VISIBLE = 6;

    function limitUsers() {
        let shown = 0;
        users.forEach(user => {
            if (shown < MAX_VISIBLE) {
                user.style.display = "flex";
                shown++;
            } else {
                user.style.display = "none";
            }
        });
    }

    limitUsers();
});








