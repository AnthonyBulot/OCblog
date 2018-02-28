<?php
session_start();

try {
    require('error/NewException.php');
    require('routeur.php');
    require('autoloader/Autoloader.php');
    \Blog\Autoloader::register();

    foreach ($routeur as $key => $value) {
        if (preg_match($key, $_SERVER['REQUEST_URI'])){
            $model = require('model/model.php');
            $rout = explode('@', $value);
            $class = '\Blog\controler\\' . $rout[0];
            $controler = new $class($model);
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
