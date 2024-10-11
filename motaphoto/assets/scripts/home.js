jQuery(document).ready(function($) {
    $('#load-more').on('click', function() {
        const button = $(this);
        let page = button.data('page');
        const maxPage = button.data('max-page');
        const nextPage = page + 1;

        if (nextPage <= maxPage) {
            $.ajax({
                url: wp_localize_script_params.ajax_url, // URL d'Ajax de WordPress
                type: 'POST',
                data: {
                    action: 'load_more_photos',
                    page: nextPage,
                },
                success: function(response) {
                    $('#photo-container').append(response); // Ajouter le nouveau contenu
                    button.data('page', nextPage); // Mettre à jour le numéro de page

                    if (nextPage >= maxPage) {
                        button.hide(); // Masquer le bouton s'il n'y a plus de pages à charger
                    }
                }
            });
        }
    });
});
