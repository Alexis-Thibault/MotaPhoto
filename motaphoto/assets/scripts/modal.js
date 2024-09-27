document.addEventListener("DOMContentLoaded", function() {
    const modal = document.getElementById("contactModal");
    const openModalBtn = document.querySelector('a[href="#contact"]');
    // Fonction pour ouvrir la modale
    const openModal = function(e) {
        e.preventDefault();
        modal.classList.add("visible");
    };

    // Fonction pour fermer la modale
    const closeModalFn = function() {
        modal.classList.remove("visible");
    };

    // Ouvrir la modale au clic sur le lien "Contact"
    openModalBtn.addEventListener("click", openModal);

    // Fermer la modale si on clique en dehors du contenu de la modale
    window.addEventListener("click", function(e) {
        // Vérifie si l'élément cliqué est bien la modale (et non son contenu)
        if (e.target === modal) {
            closeModalFn();
        }
    });
});
