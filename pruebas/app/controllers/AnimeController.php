<?php
require_once 'app/models/Anime.php';
require_once 'config.php';

class AnimeController {
    public function index() {
        $animes = Anime::getAll();
        require 'app/views/anime/index.php';
    }

    public function show($id) {
        $anime = Anime::getById($id);
        require 'app/views/anime/show.php';
    }
}
?>