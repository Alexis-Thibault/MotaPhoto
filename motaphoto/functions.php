<?php

function motaphoto_enqueue_styles() {
    // Lier le fichier CSS principal
    wp_enqueue_style( 'motaphoto-style', get_stylesheet_uri() );
    
    // Charger les polices depuis le dossier du thème
    wp_enqueue_style( 'motaphoto-fonts', get_template_directory_uri() . '/assets/fonts/fonts.css', false );
}
add_action( 'wp_enqueue_scripts', 'motaphoto_enqueue_styles' );
