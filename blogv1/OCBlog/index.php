<?php
session_start();

try {
    require('routeur.php');
    require('error/NewException.php');
    function autoloader($class){
        if (preg_match('#^Controler#' , $class)){
            require 'controler/' . $class . '.php';
        }
        else {
            require 'model/' . $class . '.php';
        }
    }
    spl_autoload_register('autoloader');

    foreach ($routeur as $key => $value) {
        if (preg_match($key, $_SERVER['REQUEST_URI'])){
            $rout = explode('@', $value);
            $controler = new $rout[0]();
            $method = $rout[1];
            $controler->$method();
        }
    }
    if(!(isset($controler))){
      throw new NewException("Cette page n'existe pas !", 404);   
    }

} 
catch(NewException $e) {
    ob_start();
        require('view/errorView.php');
    $content = ob_get_clean();
    require('view/template.php');
} 
