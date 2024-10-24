document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById("contactModal");
    const openModalBtns = document.querySelectorAll('a[href="#contact"]');
    const refPhotoField = document.querySelector('input[name="RefPhoto"]');

    // Fonction pour ouvrir la modale et (optionnellement) préremplir le champ référence
    const openModal = function (e) {
        e.preventDefault();

        const reference = this.getAttribute('data-reference');
        if (refPhotoField && reference) {
            refPhotoField.value = reference;
        } else if (refPhotoField) {
            refPhotoField.value = '';
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