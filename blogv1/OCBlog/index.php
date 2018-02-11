<?php
session_start();

try {
    require('error/NewException.php');
    function autoloadControler($class){
        if ($class === "ControlerFront" || $class === "ControlerBack"){
            require 'controler/' . $class . '.php';
        }
        else {
            require 'model/' . $class . '.php';
        }
    }
    spl_autoload_register('autoloadControler');


    require('routeur.php');

    if (isset($_GET['action'])) {
        $action = $_GET['action']; 
        if ($routeur['' . $action . ''] == 'ControlerFront') {
            $controler = new ControlerFront();
            $controler->$action();
        }
        elseif ($routeur['' . $action . ''] == 'ControlerBack') {
            $controler = new ControlerBack();
            $controler->$action();
        }
    }
    else {
        $controlerF = new ControlerFront();
        $controlerF->homePosts();
    }
} 
catch(NewException $e) {
    require('view/errorView.php');
} 
