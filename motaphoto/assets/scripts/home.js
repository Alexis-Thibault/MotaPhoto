jQuery(document).ready(function($) {
    // Initialiser Select2 pour les filtres
    $('#category-filter, #format-filter, #date-order').select2();

    // Charger plus de photos avec le bouton "Charger plus"
    const loadMoreButton = $('#load-more');

    loadMoreButton.on('click', function() {
        const button = $(this);
        let page = button.data('page');
        const maxPage = button.data('max-page');
        const nextPage = page + 1;

        if (nextPage <= maxPage) {
            $.ajax({
                url: wp_localize_script_params.ajax_url,
                type: 'POST',
                data: {
                    action: 'load_more_photos',
                    page: nextPage,
                    category: $('#category-filter').val(),
                    format: $('#format-filter').val(),
                    date_order: $('#date-order').val(),
                },
                success: function(response) {
                    $('#photo-container').append(response);
                    button.data('page', nextPage);

                    // Cacher le bouton si la dernière page est atteinte
                    if (nextPage >= maxPage) {
                        button.hide();
                    }
                }
            });
        }
    });

    // Filtrage des photos en fonction des filtres sélectionnés
    $('#category-filter, #format-filter, #date-order').on('change', function() {
        $.ajax({
            url: wp_localize_script_params.ajax_url,
            type: 'POST',
            data: {
                action: 'filter_photos',
                category: $('#category-filter').val(),
                format: $('#format-filter').val(),
                date_order: $('#date-order').val(),
                page: 1 
            },
            success: function(response) {
                $('#photo-container').html(response);
                loadMoreButton.data('page', 1);
                loadMoreButton.show(); // Rendre le bouton visible si des résultats existent
            }
        });
    });

    // Activation de l'opacité au clic sur un bloc photo
    $('.photo-block').on('click', function() {
        $(this).toggleClass('active');
    });
});

// Lightbox pour afficher les images en taille réelle
function openLightbox(imageUrl, categoryName, reference) {
    const lightbox = document.getElementById('lightbox');
    const lightboxImage = document.getElementById('lightbox-image');
    const lightboxCategory = document.querySelector('.lightbox-category');
    const lightboxRef = document.querySelector('.lightbox-ref');

    lightboxImage.src = imageUrl;
    lightboxCategory.textContent = 'Catégorie: ' + categoryName;
    lightboxRef.textContent = 'Référence: ' + reference;

    lightbox.style.display = 'flex';
}

function closeLightbox() {
    const lightbox = document.getElementById('lightbox');
    lightbox.style.display = 'none';
}
