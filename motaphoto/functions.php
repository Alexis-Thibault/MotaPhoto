<?php

function motaphoto_enqueue_styles() {
    wp_enqueue_style('motaphoto-style', get_stylesheet_uri());

    // Charger jQuery depuis WordPress
    wp_enqueue_script('jquery');

    // Charger Select2 CSS et JS
    wp_enqueue_style('select2-css', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css');
    wp_enqueue_script('select2-js', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js', array('jquery'), null, true);

    // Charger vos scripts en spécifiant 'jquery' comme dépendance
    wp_enqueue_script('motaphoto-script', get_template_directory_uri() . '/assets/scripts/scripts.js', array('jquery'), null, true);
    wp_enqueue_script('motaphoto-script-modal', get_template_directory_uri() . '/assets/scripts/modal.js', array('jquery'), null, true);
    wp_enqueue_script('motaphoto-script-photo', get_template_directory_uri() . '/assets/scripts/photo.js', array('jquery'), null, true);
    wp_enqueue_script('motaphoto-script-home', get_template_directory_uri() . '/assets/scripts/home.js', array('jquery', 'select2-js'), null, true);
    wp_enqueue_script('motaphoto-script-lightbox', get_template_directory_uri() . '/assets/scripts/lightbox.js', array('jquery'), null, true);

    // Utiliser wp_localize_script pour passer des variables PHP à votre script
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
    $paged = $_POST['page'];
    $category = isset($_POST['category']) ? $_POST['category'] : '';
    $format = isset($_POST['format']) ? $_POST['format'] : '';
    $sort_by = isset($_POST['sort_by']) ? $_POST['sort_by'] : 'newest';

    // Arguments de la requête
    $args = array(
        'post_type' => 'photos',
        'posts_per_page' => 8,
        'paged' => $paged,
    );

    // Ajouter les filtres
    if ($category) {
        $args['tax_query'][] = array(
            'taxonomy' => 'categorie',
            'field' => 'term_id',
            'terms' => $category,
        );
    }

    if ($format) {
        $args['tax_query'][] = array(
            'taxonomy' => 'format',
            'field' => 'term_id',
            'terms' => $format,
        );
    }

    // Tri par date
    if ($sort_by === 'oldest') {
        $args['order'] = 'ASC';
        $args['orderby'] = 'date';
    } else {
        $args['order'] = 'DESC';
        $args['orderby'] = 'date';
    }

    $photo_query = new WP_Query($args);

    if ($photo_query->have_posts()) :
        while ($photo_query->have_posts()) : $photo_query->the_post();
            get_template_part('templates_part/photo_block');
        endwhile;
    else :
        echo '<p>Aucune photo trouvée.</p>';
    endif;

    wp_die();
}

function filter_photos() {
    $paged = 1;

    // Récupérer les valeurs des filtres
    $category = $_POST['category'];
    $format = $_POST['format'];
    $date_order = $_POST['date_order'];

    // Arguments pour la requête
    $args = array(
        'post_type' => 'photos',
        'posts_per_page' => 8,
        'paged' => $paged,
        'orderby' => 'date',
        'order' => $date_order,
    );

    // Si une catégorie est sélectionnée
    if ($category) {
        $args['tax_query'][] = array(
            'taxonomy' => 'categorie',
            'field' => 'term_id',
            'terms' => $category,
        );
    }

    // Si un format est sélectionné
    if ($format) {
        $args['tax_query'][] = array(
            'taxonomy' => 'format',
            'field' => 'term_id',
            'terms' => $format,
        );
    }

    $photo_query = new WP_Query($args);

    if ($photo_query->have_posts()):
        while ($photo_query->have_posts()): $photo_query->the_post();
            get_template_part('templates_part/photo_block');
        endwhile;
    else:
        echo '<p>Aucune photo trouvée.</p>';
    endif;

    wp_die();
}

add_action('wp_ajax_filter_photos', 'filter_photos');
add_action('wp_ajax_nopriv_filter_photos', 'filter_photos');
add_action('wp_ajax_load_more_photos', 'load_more_photos');
add_action('wp_ajax_nopriv_load_more_photos', 'load_more_photos');
add_action('init', 'register_my_menus');
