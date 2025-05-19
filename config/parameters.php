<?php
    define('views_controller',array(
        'homeController.php', 'aboutController.php', 'profileController.php', 'animeDetailsController.php', 'userListController.php', 'topAnimeController.php'));
    
    define('apis', array(
        'ApiUserController.php', 'ApiUserAnimesController.php', 'ApiAnimeController.php'));
    
    define('models', array(
        'User.php', 'Anime.php', 'UserAnimes.php'));

    define('url',"http://127.0.0.1/Ichiraku-Project/");

    define('action_default',"index");
    define('action_default_product',"content");