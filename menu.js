const hamburger = document.getElementById("hamburger");
const mobileMenu = document.getElementById("mobileMenu");
const closeMenu = document.getElementById("closeMenu");

hamburger.onclick = () => {
    mobileMenu.classList.add("open");
};

closeMenu.onclick = () => {
    mobileMenu.classList.remove("open");
};
