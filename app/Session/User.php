<?php

namespace App\Session;

class User{
    /**
     * @return boolean
     */
    public static function init(){
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
    public static function setDados($id, $ra, $email, $nome, $imagem_perfil){
        self::init();
        
        $_SESSION['info_user'] = [
        'id' => $id,
        'ra' => $ra,
        'email' => $email,
        'nome' => $nome,
        'imagem_perfil' => $imagem_perfil
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
        //echo '<script>window.location.href ="../../public/index.php";</script>';
    }
    
}


?>