<?php
require_once 'config/db.php';

class User {
    protected $user_id;
    protected $user_name;
    protected $user_email;
    protected $user_password;
    protected $user_img;

    public function __construct(){
        
    }

    public static function getUserByEmail($email) {
        $conn = db::connect();
        $sql = "SELECT * FROM users WHERE user_email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$result) {
            error_log("No se encontró usuario con email: " . $email);
        }
        return $result;

    }

    public static function verifyPassword($email, $password) {
        $user = self::getUserByEmail($email);
        if ($user && password_verify($password, $user['user_password'])) {
            return $user['user_id']; // Retorna el ID del usuario si las credenciales son correctas
        }
        return false;
    }

    public static function registerUser($user_name, $email, $password) {
        $conn = db::connect();
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (user_name, user_email, user_password) VALUES (:user_name, :email, :password)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_name', $user_name, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public static function updateUser($user_id, $user_name, $user_email, $user_img) {
        $conn = db::connect();
        $sql = "UPDATE users SET user_name = :user_name, user_email = :user_email, user_img = :user_img WHERE user_id = :user_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_name', $user_name, PDO::PARAM_STR);
        $stmt->bindParam(':user_email', $user_email, PDO::PARAM_STR);
        $stmt->bindParam(':user_img', $user_img, PDO::PARAM_STR);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        return $stmt->execute();
    } 

    /**
     * Get the value of user_id
     */ 
    public function getUser_ID() 
    {
      return $this->user_id;
    }


    /**
     * Set the value of user_id
     *
     * @return  self
     */ 
   public function setUser_ID($user_id) 
   {   
    $this->user_id = $user_id;

    return $this;
   }

   /**
     * Get the value of user_name
     */ 
    public function getUser_Name() 
    {
      return $this->user_name;
    }


    /**
     * Set the value of user_name
     *
     * @return  self
     */ 
   public function setUser_Name($user_name) 
   {   
    $this->user_name = $user_name;

    return $this;
   }

   /**
     * Get the value of user_email
     */ 
    public function getUser_Email() 
    {
      return $this->user_email;
    }


    /**
     * Set the value of user_email
     *
     * @return  self
     */ 
   public function setUser_Email($user_email) 
   {   
    $this->user_email = $user_email;

    return $this;
   }

   /**
     * Get the value of user_password
     */ 
    public function getUser_Password() 
    {
      return $this->user_password;
    }


    /**
     * Set the value of user_password
     *
     * @return  self
     */ 
   public function setUser_Password($user_password) 
   {   
    $this->user_password = $user_password;

    return $this;
   }

    /**
      * Get the value of user_img
      */ 
      public function getUser_Img() 
      {
        return $this->user_img;
      }
  
  
      /**
      * Set the value of user_img
      *
      * @return  self
      */
      public function setUser_Img($user_img) 
      {
        $this->user_img = $user_img;
  
        return $this;
      }
}
?>