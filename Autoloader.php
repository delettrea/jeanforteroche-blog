<?php
class Autoloader{

    /**
     * Permet de lancer l'autoloader
     */
    static function register(){
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    /**
     * Autoloader
     * @param $class
     */
    static function autoload($class){
        if($class == 'AdminController' || $class ==  'HomeController' || $class ==  'Controller'){
            include 'Controller/'.$class.'.php';
        }
        elseif ($class == 'Article' || $class ==  'Comment' || $class ==  'Data'|| $class ==  'Login' || $class ==  'Sql'|| $class == 'Biography' || $class == 'Contact'){
            include 'Model/'.$class.'.php';
        }
        else {
            include 'Vue/'.$class.'.php';
        }
    }


}
