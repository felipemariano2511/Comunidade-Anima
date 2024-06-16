<?php

namespace App\Session;

class User{
    /**
     * @return boolean
     */
    private static function init(){
        session_status() !== PHP_SESSION_ACTIVE ? session_start() : true; 
          
    }
    /**
    * @param string $email
    */
    public static function login($email){
        self::init() ;

        $_SESSION['login'] = [
            'email' => $email
        ];
    }
  
    /**
     * @param array
     */
    public static function setDados($first_name, $id, $email, $nome, $nivel){
        self::init();
        
        $_SESSION['info_user'] = [
        'firstName' => $first_name,
        'id' => $id,
        'email' => $email,
        'nome' => $nome,
        'nivel' => $nivel
        ];
    }
    /**
     * @return boolean
     */
    public static function isLogged(){
        self::init();

        return isset($_SESSION['login']);
    }

    /**
     * @return array
     */
    public static function getInfo(){
        self::init();

        return $_SESSION['info_user'] ?? [''];
    }

    public static function logout(){
        self::init();

        unset($_SESSION['login']);
        unset($_SESSION['info_user']);   
        echo '<script>alert("Desconectado!"),window.location.href ="../../public/index.php";</script>';
    }
    
}
?>