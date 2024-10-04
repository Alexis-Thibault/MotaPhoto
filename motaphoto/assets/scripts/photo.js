document.addEventListener('DOMContentLoaded', function () {
    const prevArrow = document.querySelector('.prev-arrow');
    const nextArrow = document.querySelector('.next-arrow'); // Ciblez la flèche suivante
    const imageMiniature = document.querySelector('.image-miniature img');
    const imageMiniatureContainer = document.querySelector('.image-miniature'); // Ciblez le conteneur de la miniature
    const currentImageSource = document.querySelector('.image-miniature source');
    const currentImage = document.getElementById('current-image');

    if (prevArrow) {
        prevArrow.addEventListener('mouseenter', function () {
            const newImageUrl = prevArrow.getAttribute('data-image');
            const newWebPUrl = newImageUrl.replace(/\.(jpe?g|png)$/, '.jpeg.webp');
            if (newImageUrl) {
                imageMiniature.src = newImageUrl;
                if (currentImageSource) {
                    currentImageSource.srcset = newWebPUrl;
                }
                imageMiniatureContainer.classList.add('show'); // Affiche la miniature
            }
        });

        prevArrow.addEventListener('mouseleave', function () {
            if (currentImage) {
                const originalImageUrl = currentImage.src;
                const originalWebPUrl = originalImageUrl.replace(/\.(jpe?g|png)$/, '.webp');
                imageMiniature.src = originalImageUrl;
                if (currentImageSource) {
                    currentImageSource.srcset = originalWebPUrl;
                }
                imageMiniatureContainer.classList.remove('show'); // Cache la miniature
            }
        });
    }

    if (nextArrow) { // Gérer l'événement de survol pour la flèche suivante
        nextArrow.addEventListener('mouseenter', function () {
            const newImageUrl = nextArrow.getAttribute('data-image');
            const newWebPUrl = newImageUrl.replace(/\.(jpe?g|png)$/, '.jpeg.webp');
            if (newImageUrl) {
                imageMiniature.src = newImageUrl;
                if (currentImageSource) {
                    currentImageSource.srcset = newWebPUrl;
                }
                imageMiniatureContainer.classList.add('show'); // Affiche la miniature
            }
        });

        nextArrow.addEventListener('mouseleave', function () {
            if (currentImage) {
                const originalImageUrl = currentImage.src;
                const originalWebPUrl = originalImageUrl.replace(/\.(jpe?g|png)$/, '.webp');
                imageMiniature.src = originalImageUrl;
                if (currentImageSource) {
                    currentImageSource.srcset = originalWebPUrl;
                }
                imageMiniatureContainer.classList.remove('show'); // Cache la miniature
            }
        });
    }
});
