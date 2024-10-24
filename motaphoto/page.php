<?php get_header(); ?>

<main>
    <?php
    if ( have_posts() ) :
        while ( have_posts() ) : the_post();
            the_content(); // Ceci affiche le contenu de Gutenberg
        endwhile;
    endif;
    ?>
</main>

<?php get_footer(); ?>
