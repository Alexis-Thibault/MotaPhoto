<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>MotaPhoto</title>
    <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" />
    <?php wp_head(); ?>
</head>
<body>

<header>
    <nav>
        <div>
            <a href="<?php echo home_url(); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Logo.png" alt="Logo">
            </a>
        </div>
        <div>
            <a href="<?php echo home_url(); ?>">Accueil</a>
            <a href="<?php echo home_url('/about'); ?>">À propos</a>
            <a href="<?php echo home_url('/contact'); ?>">Contact</a>
        </div>
    </nav>
</header>
