document.addEventListener('DOMContentLoaded', function () {
    const prevArrow = document.querySelector('.prev-arrow');
    const nextArrow = document.querySelector('.next-arrow'); // Ciblez la flèche suivante
    const imageMiniature = document.querySelector('.image-miniature img');
    const imageMiniatureContainer = document.querySelector('.image-miniature'); // Ciblez le conteneur de la miniature
    const currentImageSource = document.querySelector('.image-miniature source');
    const currentImage = document.getElementById('current-image');

    // Fonction pour rediriger vers l'URL de la page d'un post
    function redirectToPost(postUrl) {
        if (postUrl) {
            window.location.href = postUrl; // Redirection vers la page de la photo
        }
    }

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

        // Ajout de l'événement "click" pour rediriger vers la page précédente
        prevArrow.addEventListener('click', function () {
            const prevPostUrl = prevArrow.getAttribute('data-url'); // URL de la page du post précédent
            redirectToPost(prevPostUrl);
        });
    }

    if (nextArrow) {
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

        // Ajout de l'événement "click" pour rediriger vers la page suivante
        nextArrow.addEventListener('click', function () {
            const nextPostUrl = nextArrow.getAttribute('data-url'); // URL de la page du post suivant
            redirectToPost(nextPostUrl);
        });
    }
});
