jQuery(document).ready(function($) {
    let currentImageIndex = 0;
    let imagesArray = [];

    window.openLightbox = function(element) {
        const lightbox = $('#lightbox');

        imagesArray = [];
        $('.photo-block').each(function(index) {
            const imgUrl = $(this).data('image-url');
            const imgCategory = $(this).data('category');
            const imgReference = $(this).data('reference');

            if (imgUrl && imgCategory && imgReference) {
                imagesArray.push({
                    url: imgUrl,
                    category: imgCategory,
                    reference: imgReference,
                });
                if (imgUrl === $(element).data('image-url')) {
                    currentImageIndex = index;
                }
            }
        });

        if (imagesArray.length > 0) {
            updateLightboxContent();
            lightbox.css('display', 'flex');
        } else {
            console.error("Aucune image valide trouvée pour la lightbox.");
        }
    };

    window.closeLightbox = function() {
        $('#lightbox').hide();
    };

    function showPreviousImage() {
        if (currentImageIndex > 0) {
            currentImageIndex--;
            updateLightboxContent();
        }
    }

    function showNextImage() {
        if (currentImageIndex < imagesArray.length - 1) {
            currentImageIndex++;
            updateLightboxContent();
        }
    }

    function updateLightboxContent() {
        const currentImage = imagesArray[currentImageIndex];

        if (currentImage) {
            $('#lightbox-image').attr('src', currentImage.url);
            $('.lightbox-category').text('Catégorie: ' + currentImage.category);
            $('.lightbox-ref').text('Référence: ' + currentImage.reference);
        } else {
            console.error("Erreur lors de la mise à jour du contenu de la lightbox.");
        }
    }

    $('.lightbox-prev').on('click', showPreviousImage);
    $('.lightbox-next').on('click', showNextImage);
});
