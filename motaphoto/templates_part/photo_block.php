<?php
$image = get_field('image');
$categories = wp_get_post_terms(get_the_ID(), 'categorie');
$reference = get_field('reference'); // Champ ACF 'reference'

if ($image) :
?>
    <div class="photo-block">
        <img class="photo-image" src="<?php echo esc_url($image['url']); ?>" alt="<?php the_title(); ?>">

        <div class="photo-title">
            <p><?php echo esc_html(get_the_title()); ?></p>
        </div>

        <?php if (!empty($categories)) : ?>
            <div class="photo-category">
                <p><?php echo esc_html($categories[0]->name); ?></p>
            </div>
        <?php endif; ?>

        <div class="icon-link">
            <a href="<?php echo esc_url(get_permalink()); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Icon_eye.png" alt="Détails">
            </a>
        </div>

        <!-- Icône fullscreen qui déclenche la lightbox -->
        <div class="icon-lightbox" onclick="openLightbox('<?php echo esc_url($image['url']); ?>', '<?php echo esc_html($categories[0]->name); ?>', '<?php echo esc_html($reference); ?>')">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Icon_fullscreen.png" alt="Icone lightbox">
        </div>
    </div>

<?php
else :
    echo '<p>Aucune photo trouvée.</p>';
endif;
?>
