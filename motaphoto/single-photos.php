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
                        $prev_post_url = get_permalink($previous_post->ID); // URL de la page précédente
                    } else {
                        $prev_image_url = '';
                        $prev_post_url = ''; // Si aucune page précédente
                    }

                    // Récupérer la photo suivante
                    $next_post = get_next_post();
                    if ($next_post) {
                        $next_image = get_field('image', $next_post->ID);
                        $next_image_url = $next_image ? esc_url($next_image['url']) : '';
                        $next_post_url = get_permalink($next_post->ID); // URL de la page suivante
                    } else {
                        $next_image_url = '';
                        $next_post_url = ''; // Si aucune page suivante
                    }
                ?>

                <div class="prev-next">
                    <?php if ($previous_post) : ?>
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/Line 6.svg'); ?>" alt="Flèche retour" 
                            class="prev-arrow" data-image="<?php echo esc_attr($prev_image_url); ?>" data-url="<?php echo esc_url($prev_post_url); ?>">
                    <?php else : ?>
                        <p>Il n'y a pas de photo moins récente.</p>
                    <?php endif; ?>
                    
                    <?php if ($next_post) : ?>
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/Line 7.svg'); ?>" alt="Flèche après" 
                            class="next-arrow" data-image="<?php echo esc_attr($next_image_url); ?>" data-url="<?php echo esc_url($next_post_url); ?>">
                    <?php else : ?>
                        <p>Il n'y a pas de photo plus récente.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <?php
        // Récupérer les catégories de la photo actuelle
        $categories = wp_get_post_terms(get_the_ID(), 'categorie');

        if (!empty($categories)) {
            // Prendre la première catégorie pour filtrer
            $category_id = $categories[0]->term_id;

            // Requête personnalisée pour récupérer 2 photos aléatoires de la même catégorie
            $args = array(
                'post_type' => 'photos', // Le slug de ton CPT 'photos'
                'posts_per_page' => 2, // Limiter à 2 photos
                'orderby' => 'rand', // Trier de façon aléatoire
                'post__not_in' => array(get_the_ID()), // Exclure la photo en cours
                'tax_query' => array(
                    array(
                        'taxonomy' => 'categorie', // La taxonomie 'categorie'
                        'field'    => 'term_id', // Filtrer par ID de la catégorie
                        'terms'    => $category_id, // ID de la catégorie courante
                    ),
                ),
            );

            $related_photos_query = new WP_Query($args);

            
            if ($related_photos_query->have_posts()) : ?>
                <div class="like">
                    <h3>Vous aimerez aussi</h3>
                    <div class="photo-container">
                        <?php
                        // Boucler sur les photos trouvées
                        while ($related_photos_query->have_posts()) : $related_photos_query->the_post();
                            get_template_part('templates_part/photo_block');
                        endwhile;
                        ?>
                    </div>
                </div> 
                <?php
                wp_reset_postdata(); // Réinitialiser la requête principale
            endif;
        }
    ?>
</section>

<?php
get_footer();
?>
