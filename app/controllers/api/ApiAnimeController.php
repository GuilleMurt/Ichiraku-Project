<?php

class ApiAnimeController{

    public function index(){
        echo 'api';
        return;
    }

    public function api(){
      $accion = isset($_POST["accion"]) ? $_POST["accion"] : '';

      if (trim($accion) == "get_animes") {
          $animes = Anime::getAllAnimes();
          $this->sendJsonResponse($animes);
          return;
      }
  
      if (trim($accion) == "insert_anime") {  
        $anime_id = isset($_POST["anime_id"]) ? $_POST["anime_id"] : '';
        $title = isset($_POST["title"]) ? $_POST["title"] : '';
        $image = isset($_POST["image"]) ? $_POST["image"] : '';
        $total_chapters = isset($_POST["total_chapters"]) ? $_POST["total_chapters"] : '';
        $status = isset($_POST["status"]) ? $_POST["status"] : '';
    
        // Verificar si el anime ya está registrado
        $anime = Anime::getAnimeById($anime_id);
    
        if ($anime) {
            return;
        }

        // Registrar el anime si no existe
        if (Anime::registerAnime($anime_id, $title, $image, $total_chapters, $status)) {
            $this->sendJsonResponse(["message" => "Anime registrado correctamente"]);
        } else {
            $this->sendJsonResponse(["error" => "Error al registrar el anime"]);
        }
        return;
      }
    }



    private function sanitizeUTF8($data) {
        $data = mb_convert_encoding($data, 'UTF-8', 'UTF-8');
        
        // Recortar espacios en blanco al inicio y al final
        $data = trim($data);
        
        // Escapar caracteres especiales para evitar inyecciones
        $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
        
        return $data;
  }

  private function sendJsonResponse($data) {
      header('Content-Type: application/json');
      header('Access-Control-Allow-Origin: *');
      $json = json_encode($data, JSON_UNESCAPED_UNICODE);
      if ($json === false) {
          error_log("Error al codificar en JSON: " . json_last_error_msg());
          echo json_encode(["error" => "Error al codificar en JSON: " . json_last_error_msg()]);
      } else {
          echo $json;
      }
  }
}
?>