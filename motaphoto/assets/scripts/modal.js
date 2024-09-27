document.addEventListener("DOMContentLoaded", function() {
    const modal = document.getElementById("contactModal");
    const openModalBtn = document.querySelector('a[href="#contact"]');
    
    // Fonction pour ouvrir la modale
    const openModal = function(e) {
        e.preventDefault();
        modal.classList.remove("fade-out");
        modal.classList.add("visible");
    };

    // Fonction pour fermer la modale
    const closeModal = function() {
        modal.classList.add("fade-out"); 
        setTimeout(() => modal.classList.remove("visible"), 500);
    };

    // Ouvrir la modale
    openModalBtn.addEventListener("click", openModal);

    // Fermer la modale en cliquant en dehors
    window.addEventListener("click", function(e) {
        if (e.target === modal) {
            closeModal();
        }
    });
});
