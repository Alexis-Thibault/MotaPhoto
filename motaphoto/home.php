<?php get_header(); ?>

<?php 
// Récupérer les images de la médiathèque
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

<?php get_footer(); ?>
