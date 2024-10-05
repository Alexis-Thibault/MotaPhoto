<?php
$image = get_field('image');

if ($image) :
    ?>
    <div class="photo-block">
        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php the_title(); ?>">
    </div>
    <?php
else :
    echo '<p>Aucune photo trouvée.</p>';
endif;
?>
