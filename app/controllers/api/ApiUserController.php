<?php

class ApiUserController{

    public function index(){
        echo 'api';
        return;
    }

    public function api(){
      $accion = isset($_POST["accion"]) ? $_POST["accion"] : '';
  
      if(trim($accion) == "get_user_name"){  
          $user_email = isset($_POST["user_email"]) ? $_POST["user_email"] : '';
  
          $user = User::getUserByEmail($user_email);
  
          if ($user) {
              $response = array(
                "user_id" => $this->sanitizeUTF8($user["user_id"]),
                "user_name" => $this->sanitizeUTF8($user["user_name"]),
                "user_email" => $this->sanitizeUTF8($user["user_email"]),
                "user_img" => $this->sanitizeUTF8($user["user_img"])
              );
          } else {
              $response = ["error" => "Usuario no encontrado"];
          }
  
          $this->sendJsonResponse($response);
          return;
      }

      if (trim($accion) == "get_session_email") {
        session_start();
        if (isset($_SESSION['user_email'])) {
            $this->sendJsonResponse(["user_email" => $_SESSION['user_email']]);
        } else {
            $this->sendJsonResponse(["error" => "No email found in session"]);
        }
        return;
    }

    if (trim($accion) == "update_user") {
      session_start();
      if (isset($_SESSION['user_id'])) {
          $user_id = $_SESSION['user_id'];
          $user_name = isset($_POST["user_name"]) ? $_POST["user_name"] : '';
          $user_email = isset($_POST["user_email"]) ? $_POST["user_email"] : '';
          $user_img = isset($_POST["user_img"]) ? $_POST["user_img"] : '';
          $new_img = isset($_FILES["new_img"]) ? $_FILES["new_img"] : '';

          if ($new_img == null) {
            if (User::updateUser($user_id, $user_name, $user_email, $user_img)) {
                $this->sendJsonResponse([
                    "message" => "Usuario actualizado correctamente",
                    "redirect" => url . "?controller=profile"
                ]);
            } else {
                $this->sendJsonResponse(["error" => "Error al actualizar el usuario"]);
            }
          } else {
            $uploadDir = 'public/img/profile_pictures/';
            $uploadFile = $uploadDir . basename($_FILES['new_img']['name']);
            if (move_uploaded_file($new_img['tmp_name'], $uploadFile)) {
                $new_img = $uploadFile; // Guardar la ruta del archivo
            } else {
                $this->sendJsonResponse(["error" => "Error al mover la imagen"]);
                return;
            }
            if (User::updateUser($user_id, $user_name, $user_email, $new_img)) {
                $this->sendJsonResponse([
                    "message" => "Usuario actualizado correctamente",
                    "redirect" => url . "?controller=profile"
            ]);
            } else {
                $this->sendJsonResponse(["error" => "Error al actualizar el usuario"]);
            }
          }
        }
      } else {
          $this->sendJsonResponse(["error" => "No se ha iniciado sesión"]);
      }
      return;
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