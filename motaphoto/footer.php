<footer>
    <a href="<?php echo site_url('/mentions-legales'); ?>">Mentions Légales</a>
    <a href="<?php echo site_url('/vie-privee'); ?>">Vie privée</a>
    <a href="#">Tous droits réservés</a>
</footer>

<!-- Lightbox structure -->
<div id="lightbox" class="lightbox" style="display: none;">
    <div class="lightbox-content">
        <span class="lightbox-close" onclick="closeLightbox()">&times;</span>
        <img id="lightbox-image" src="" alt="Image Lightbox">
        <div class="lightbox-details">
            <p class="lightbox-ref"></p>
            <p class="lightbox-category"></p>
        </div>
    </div>
</div>

<?php wp_footer(); ?>
<?php get_template_part('templates_part/contact-modal'); ?>

</body>
</html>
