<?php get_header(); ?>

<?php 
// Récupérer les images de la médiathèque pour le background aléatoire
$args = array(
    'post_type'      => 'attachment',
    'post_mime_type' => 'image',
    'post_status'    => 'inherit',
    'posts_per_page' => -1,
);

$images = get_posts($args);

if ($images) {
    $random_image = $images[array_rand($images)];
    $image_url = wp_get_attachment_url($random_image->ID);
} else {
    $image_url = get_template_directory_uri() . '/images/nathalie-11.jpeg';
}
?>

<div class="header-home" style="background-image: url('<?php echo $image_url; ?>');">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/title-header-home.png" alt="Titre">
</div>

<!-- Filtres -->
<div class="filters container">
    <div class="taxonomies-filter">
        <select id="category-filter">
            <option value="">Catégories</option>
            <?php
            // Récupérer les catégories
            $categories = get_terms(array('taxonomy' => 'categorie')); // Remplace 'category' par le slug de ta taxonomie
            foreach ($categories as $category) {
                echo '<option value="' . $category->term_id . '">' . $category->name . '</option>';
            }
            ?>
        </select>

        <select id="format-filter">
            <option value="">Formats</option>
            <?php
            // Récupérer les formats
            $formats = get_terms(array('taxonomy' => 'format')); // Remplace 'format' par le slug de ta taxonomie
            foreach ($formats as $format) {
                echo '<option value="' . $format->term_id . '">' . $format->name . '</option>';
            }
            ?>
        </select>
    </div>
    <div class="date-filter">
        <select id="date-order">
            <option value="desc">Les plus récentes</option>
            <option value="asc">Les plus anciennes</option>
        </select>
    </div>
</div>

<!-- Section pour afficher les blocs d'images du CPT "photos" -->
<div class="photo-container container" id="photo-container">
    <?php 
    // Créer une nouvelle requête pour récupérer les photos du CPT "photos"
    $args = array(
        'post_type' => 'photos',
        'posts_per_page' => 8,
        'paged' => 1,
    );
    $photo_query = new WP_Query($args);

    if ($photo_query->have_posts()):
        while ($photo_query->have_posts()): $photo_query->the_post();
            get_template_part('templates_part/photo_block');
        endwhile;
        wp_reset_postdata();
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
