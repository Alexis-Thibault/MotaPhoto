document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById("contactModal");
    const openModalBtns = document.querySelectorAll('a[href="#contact"]'); // Cible tous les liens qui ouvrent la modale
    const refPhotoField = document.querySelector('input[name="RefPhoto"]'); // Le champ référence du formulaire

    // Fonction pour ouvrir la modale et (optionnellement) préremplir le champ référence
    const openModal = function (e) {
        e.preventDefault();

        const reference = this.getAttribute('data-reference'); // Récupère la référence si elle existe
        if (refPhotoField && reference) {
            refPhotoField.value = reference; // Remplit le champ avec la référence
        } else if (refPhotoField) {
            refPhotoField.value = ''; // Vide le champ si pas de référence
        }

        modal.classList.remove("fade-out");
        modal.classList.add("visible");
    };

    // Fonction pour fermer la modale
    const closeModal = function () {
        modal.classList.add("fade-out");
        setTimeout(() => modal.classList.remove("visible"), 500);
    };

    // Ajoute l'event listener à tous les liens "Contact"
    openModalBtns.forEach(function (btn) {
        btn.addEventListener("click", openModal);
    });

    // Fermer la modale en cliquant en dehors
    window.addEventListener("click", function (e) {
        if (e.target === modal) {
            closeModal();
        }
    });
});