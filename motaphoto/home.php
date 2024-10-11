<?php get_header(); ?>

<?php 
// Récupérer les images de la médiathèque pour le background aléatoire
$args = array(
    'post_type'      => 'attachment',
    'post_mime_type' => 'image',
    'post_status'    => 'inherit',
    'posts_per_page' => -1, // Récupérer toutes les images
);

$images = get_posts($args);

// Vérifier s'il y a des images
if ($images) {
    // Choisir une image aléatoire
    $random_image = $images[array_rand($images)];
    $image_url = wp_get_attachment_url($random_image->ID); // Obtenir l'URL de l'image
} else {
    // URL par défaut si aucune image n'est trouvée
    $image_url = get_template_directory_uri() . '/images/nathalie-11.jpeg';
}
?>

<div class="header-home" style="background-image: url('<?php echo $image_url; ?>');">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/title-header-home.png" alt="Titre">
</div>

<!-- Section où tu affiches les blocs d'images du CPT "photos" -->
<div class="photo-container container" id="photo-container">
    <?php 
    // Créer une nouvelle requête pour récupérer les photos du CPT "photos"
    $args = array(
        'post_type' => 'photos', // Type de contenu personnalisé
        'posts_per_page' => 8, // Récupérer les 8 premières photos
        'paged' => 1, // Première page
    );
    $photo_query = new WP_Query($args);

    if ($photo_query->have_posts()):
        while ($photo_query->have_posts()): $photo_query->the_post();
        
            // Passer l'image et les informations nécessaires à `photo_block.php`
            get_template_part('templates_part/photo_block');
        
        endwhile;
        wp_reset_postdata(); // Réinitialiser la requête
    else:
        echo '<p>Aucune photo trouvée.</p>';
    endif;
    ?>
</div>

<!-- Bouton Charger plus -->
<div class="load-more-container">
    <button id="load-more" data-page="1" data-max-page="<?php echo $photo_query->max_num_pages; ?>">Charger plus</button>
</div>

<?php get_footer(); ?>
