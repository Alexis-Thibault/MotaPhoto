jQuery(document).ready(function() {
    let currentImageIndex = 0;
    let imagesArray = [];

    // Attache la fonction openLightbox à window pour qu'elle soit accessible globalement
    window.openLightbox = function(element) {
        const lightbox = jQuery('#lightbox');

        imagesArray = []; // Réinitialise le tableau

        // Remplir imagesArray avec les données des photos
        jQuery('.photo-block').each(function(index) {
            const imgUrl = jQuery(this).data('image-url');
            const imgCategory = jQuery(this).data('category');
            const imgReference = jQuery(this).data('reference');

            imagesArray.push({
                url: imgUrl,
                category: imgCategory,
                reference: imgReference,
            });

            // Si l'image correspond à celle que nous ouvrons, met à jour l'indice actuel
            if (imgUrl === jQuery(element).data('image-url')) {
                currentImageIndex = index;
            }
        });

        // Afficher l'image, la catégorie et la référence dans la lightbox
        updateLightboxContent();

        lightbox.css('display', 'flex');
    }

    window.closeLightbox = function() {
        jQuery('#lightbox').hide();
    }

    // Fonction pour aller à l'image précédente
    function showPreviousImage() {
        if (currentImageIndex > 0) {
            currentImageIndex--;
            updateLightboxContent();
        }
    }

    // Fonction pour aller à l'image suivante
    function showNextImage() {
        if (currentImageIndex < imagesArray.length - 1) {
            currentImageIndex++;
            updateLightboxContent();
        }
    }

    // Met à jour le contenu de la lightbox
    function updateLightboxContent() {
        const currentImage = imagesArray[currentImageIndex];

        // Assigner les valeurs de l'image actuelle
        jQuery('#lightbox-image').attr('src', currentImage.url);
        jQuery('.lightbox-category').text('Catégorie: ' + currentImage.category);
        jQuery('.lightbox-ref').text('Référence: ' + currentImage.reference);
    }

    // Ajoute les événements aux flèches
    jQuery('.lightbox-prev').on('click', showPreviousImage);
    jQuery('.lightbox-next').on('click', showNextImage);
});
