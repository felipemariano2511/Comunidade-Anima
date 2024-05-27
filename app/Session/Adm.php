<?php

namespace App\Session;

class Adm{
    /**
     * @return boolean
     */
    public static function init(){
        session_status() !== PHP_SESSION_ACTIVE ? session_start() : true; 
          
    }
    /**
    * @param string $usuario
    */
    public static function login($usuario){
        self::init() ;

        $_SESSION['login'] = [
            'usuario' => $usuario
        ];
    }
  
    /**
     * @param array
     */
    public static function setDados($usuario, $nome, $email){
        self::init();
        
        $_SESSION['info_adm'] = [
        'usuario' => $usuario,
        'nome' => $nome,
        'email' => $email
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

        return $_SESSION['info_adm'] ?? [''];
    }

    public static function logout(){
        self::init();

        unset($_SESSION['login']);
        //echo '<script>window.location.href ="../../public/PortalAdm/index.php";</script>';
    }
    
}


?>