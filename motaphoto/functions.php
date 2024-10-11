<?php

function motaphoto_enqueue_styles() {
    wp_enqueue_style('motaphoto-style', get_stylesheet_uri());

    wp_enqueue_script('motaphoto-script', get_template_directory_uri() . '/assets/scripts/scripts.js', array(), null, true);
    wp_enqueue_script('motaphoto-script-modal', get_template_directory_uri() . '/assets/scripts/modal.js', array(), null, true);
    wp_enqueue_script('motaphoto-script-photo', get_template_directory_uri() . '/assets/scripts/photo.js', array(), null, true);
    wp_enqueue_script('motaphoto-script-home', get_template_directory_uri() . '/assets/scripts/home.js', array(), null, true);

    wp_localize_script('motaphoto-script-home', 'wp_localize_script_params', array(
        'ajax_url' => admin_url('admin-ajax.php'),
    ));
}
add_action('wp_enqueue_scripts', 'motaphoto_enqueue_styles');


function register_my_menus() {
    register_nav_menus(
        array(
            'header-menu' => __('Menu d\'en-tête')
        )
    );
}

function load_more_photos() {
    $paged = $_POST['page']; // Récupérer la page suivante depuis la requête AJAX

    // Nouvelle requête pour récupérer les 8 photos supplémentaires
    $args = array(
        'post_type' => 'photos',
        'posts_per_page' => 8,
        'paged' => $paged,
    );

    $photo_query = new WP_Query($args);

    if ($photo_query->have_posts()):
        while ($photo_query->have_posts()): $photo_query->the_post();
        
            // Charger le template part pour chaque nouvelle photo
            get_template_part('templates_part/photo_block');
        
        endwhile;
    endif;

    wp_die(); // Terminer la requête AJAX proprement
}


add_action('wp_ajax_load_more_photos', 'load_more_photos');
add_action('wp_ajax_nopriv_load_more_photos', 'load_more_photos'); // Pour les utilisateurs non connectés
add_action('init', 'register_my_menus');
