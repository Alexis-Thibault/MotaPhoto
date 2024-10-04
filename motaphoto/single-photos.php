
<?php
get_header();
?>

<section class="container photo">
    <div class="photo-content">
        <div class="photo-info">
            <div class="photo-info-content">
                <h2><?php the_title(); ?></h2>

                <p>Référence : 
                    <?php 
                    $reference = esc_html(get_post_meta(get_the_ID(), 'reference', true));
                    echo $reference; 
                    ?>
                </p>

                <p>Catégorie : 
                    <?php 
                    $categories = get_the_terms(get_the_ID(), 'categorie');
                    echo ($categories && !is_wp_error($categories)) ? 
                        esc_html(implode(', ', wp_list_pluck($categories, 'name'))) : 
                        'Aucune catégorie';
                    ?>
                </p>

                <p>Format : 
                    <?php 
                    $formats = get_the_terms(get_the_ID(), 'format');
                    echo ($formats && !is_wp_error($formats)) ? 
                        esc_html(implode(', ', wp_list_pluck($formats, 'name'))) : 
                        'Aucun format';
                    ?>
                </p>

                <p>Année : 
                    <?php 
                    echo esc_html(get_the_date('Y')); 
                    ?>
                </p>
            </div>
        </div>
        
        <div class="image">
            <?php 
            $image = get_field('image');
            if ($image) {
                echo '<img src="' . esc_url($image['url']) . '" alt="' . esc_attr($image['alt']) . '" id="current-image">';
            } else {
                echo '<p>Aucune image disponible.</p>';
            }
            ?>
        </div>
    </div>
    
    <div class="contact-image">
        <div class="contact">
            <p>
                Cette photo vous intéresse ? 
            </p>
            <a href="#contact" class="open-modal" data-reference="<?php echo esc_attr($reference); ?>">
                <button class="btn-contact">Contact</button>
            </a>
        </div>
        
        <div class="image-date">
            <div class="image-date-content">
                <div class="image-miniature">
                    <img src="" alt="">
                </div>

                <?php 
                    // Récupérer la photo précédente
                    $previous_post = get_previous_post();
                    if ($previous_post) {
                        $prev_image = get_field('image', $previous_post->ID);
                        $prev_image_url = $prev_image ? esc_url($prev_image['url']) : '';
                    } else {
                        $prev_image_url = ''; // Si aucune image précédente n'existe
                    }
                    // Récupérer la photo suivante
                    $next_post = get_next_post();
                    if ($next_post) {
                        $next_image = get_field('image', $next_post->ID);
                        $next_image_url = $next_image ? esc_url($next_image['url']) : '';
                    } else {
                        $next_image_url = ''; // Si aucune image suivante n'existe
                    }
                ?>
                <div class="prev-next">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/Line 6.svg'); ?>" alt="Flèche retour" 
                        class="prev-arrow" data-image="<?php echo esc_attr($prev_image_url); ?>">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/Line 7.svg'); ?>" alt="Flèche après" 
                        class="next-arrow" data-image="<?php echo esc_attr($next_image_url); ?>">
                </div>
            </div>
        </div>
    </div>
</section>

<?php
get_footer();
?>