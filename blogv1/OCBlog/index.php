<?php
session_start();
//explode
try {
    require('routeur.php');
    require('error/NewException.php');
    function autoloader($class){
        if (preg_match ('#^Controler#' , $class)){
            require 'controler/' . $class . '.php';
        }
        else {
            require 'model/' . $class . '.php';
        }
    }
    spl_autoload_register('autoloader');

    if (isset($_GET['action'])) {
        $action = $_GET['action'];
        if (!(array_key_exists($action, $routeur))) {
            throw new NewException("Cette page n'existe pas !", 404);  
        }
        else  {
            $rout = explode('@', $routeur['' . $action . '']);
            $controler = new $rout[0]();
            $controler->$rout[1]();
        }
    }
    else {
        $controlerF = new ControlerFront();
        $controlerF->homePosts();
    }
} 
catch(NewException $e) {
    ob_start();
        require('view/errorView.php');
    $content = ob_get_clean();
    require('view/template.php');
} 
