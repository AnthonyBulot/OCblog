<?php
session_start();

try {
    require('routeur.php');
    require('error/NewException.php');
    function autoloader($class){
        if ($class === "ControlerFront" || $class === "ControlerBack" || $class === 'Controler'){
            require 'controler/' . $class . '.php';
        }
        else {
            require 'model/' . $class . '.php';
        }
    }
    spl_autoload_register('autoloader');

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
