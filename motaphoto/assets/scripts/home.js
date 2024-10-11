jQuery(document).ready(function($) {
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

                    if (nextPage >= maxPage) {
                        button.hide();
                    }
                }
            });
        }
    });

    // Événement pour les filtres
    $('#category-filter, #format-filter, #date-order').on('change', function() {
        $.ajax({
            url: wp_localize_script_params.ajax_url,
            type: 'POST',
            data: {
                action: 'filter_photos',
                category: $('#category-filter').val(), // Assurez-vous que le nom est correct ici
                format: $('#format-filter').val(),
                date_order: $('#date-order').val(),
                page: 1 // Pour charger la première page
            },
            success: function(response) {
                $('#photo-container').html(response);
                loadMoreButton.data('page', 1); // Réinitialiser le compteur de pages
                loadMoreButton.show(); // Afficher le bouton si masqué
            }
        });
    });
});
