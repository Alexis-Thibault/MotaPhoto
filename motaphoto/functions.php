<?php

function motaphoto_enqueue_styles() {
    wp_enqueue_style('motaphoto-style', get_stylesheet_uri());

    wp_enqueue_script('motaphoto-script', get_template_directory_uri() . '/assets/scripts/scripts.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'motaphoto_enqueue_styles');


function register_my_menus() {
    register_nav_menus(
        array(
            'header-menu' => __('Menu d\'en-tête')
        )
    );
}
add_action('init', 'register_my_menus');
