<?php

class ApiUserAnimesController {

    public function index(){
      echo 'api';
      return;
    }
    
    public function api() {
        $accion = isset($_POST["accion"]) ? $_POST["accion"] : '';

        if (trim($accion) == "get_all_user_animes") {
            $animes = UserAnimes::getAllUserAnimes();
            $this->sendJsonResponse($animes);
            return;
        }

        if (trim($accion) == "get_user_animes_by_user_id") {
            $user_id = isset($_POST["user_id"]) ? $_POST["user_id"] : '';
            $animes = UserAnimes::getUserAnimesByUserId($user_id);
            $this->sendJsonResponse($animes);
            return;
        }

        if (trim($accion) == "insert_user_anime") {
            $user_id = isset($_POST["user_id"]) ? $_POST["user_id"] : '';
            $anime_id = isset($_POST["anime_id"]) ? $_POST["anime_id"] : '';
            $status = isset($_POST["status"]) ? $_POST["status"] : '';
            $current_chapter = isset($_POST["current_chapter"]) ? $_POST["current_chapter"] : '';
            $rating = isset($_POST["rating"]) ? $_POST["rating"] : '';

            $registered = UserAnimes::getUserAnimeByUserAndAnimeId($user_id, $anime_id);

            if ($registered) { 
                UserAnimes::updateUserAnime($registered["anime_users_id"], $status, $current_chapter, $rating);
                return;
            }

            if (UserAnimes::registerUserAnime($user_id, $anime_id, $status, $current_chapter, $rating)) {
                $this->sendJsonResponse(["message" => "Anime registrado correctamente"]);
            } else {
                $this->sendJsonResponse(["error" => "Error al registrar el anime"]);
            }
            return;
        }

        if (trim($accion) == "update_user_anime") {
            $anime_id = isset($_POST["anime_id"]) ? $_POST["anime_id"] : '';
            $user_id = isset($_POST["user_id"]) ? $_POST["user_id"] : '';
            $chapter = isset($_POST["chapter"]) ? $_POST["chapter"] : '';
        
            $anime_updated = UserAnimes::updateUserAnime($anime_id, $user_id, $chapter);
        
            if ($anime_updated) {
                // Enviar el mensaje y los datos actualizados al cliente
                $this->sendJsonResponse([
                    "message" => "Anime actualizado correctamente",
                    "data" => $anime_updated
                ]);
            } else {
                $this->sendJsonResponse(["error" => "Error al actualizar el anime"]);
            }
            return;
        }

        if (trim($accion) == "get_chapters") {
            $anime_id = isset($_POST["anime_id"]) ? $_POST["anime_id"] : '';
            $user_id = isset($_POST["user_id"]) ? $_POST["user_id"] : '';

            $chapters = UserAnimes::getUserAnimeChapters($anime_id, $user_id);
            $this->sendJsonResponse($chapters);
            return;
        }

        if (trim($accion) == "delete_user_anime") {
            $anime_users_id = isset($_POST["anime_users_id"]) ? $_POST["anime_users_id"] : '';

            if (UserAnimes::deleteUserAnime($anime_users_id)) {
                $this->sendJsonResponse(["message" => "Anime eliminado correctamente"]);
            } else {
                $this->sendJsonResponse(["error" => "Error al eliminar el anime"]);
            }
            return;
        }

        $this->sendJsonResponse(["error" => "Acción no válida"]);
    }

    private function sendJsonResponse($data) {
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
}
?>
