document.addEventListener("DOMContentLoaded", function () {
    const menuToggle = document.getElementById("menuToggle");
    const navLinks = document.getElementById("navLinks");

    menuToggle.addEventListener("click", function () {
        navLinks.classList.toggle("active");
        menuToggle.classList.toggle("active"); // Ajoute ou enlève la classe active pour l'animation

        // Change le menu burger en croix
        if (menuToggle.classList.contains("active")) {
            menuToggle.setAttribute("aria-label", "Fermer le menu"); // Accessibilité
        } else {
            menuToggle.setAttribute("aria-label", "Ouvrir le menu");
        }
    });

    // Fermer le menu si on clique en dehors
    document.addEventListener("click", function(event) {
        if (!navLinks.contains(event.target) && !menuToggle.contains(event.target)) {
            navLinks.classList.remove("active");
            menuToggle.classList.remove("active");
        }
    });
});
