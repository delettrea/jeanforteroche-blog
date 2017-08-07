<?php
/**
 * Un exemple de classe d'autoload
 */
class Autoloader{

    static function register(){
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    static function autoload($class){
        if($class == 'AdminController' || $class ==  'HomeController' || $class ==  'Controller'){
            include 'Controller/'.$class.'.php';
        }
        elseif ($class == 'Article' || $class ==  'Comment' || $class ==  'Data'|| $class ==  'Login' || $class ==  'Sql'|| $class == 'Biography'){
            include 'Model/'.$class.'.php';
        }
        else {
            include 'Vue/'.$class.'.php';
        }
    }


}
