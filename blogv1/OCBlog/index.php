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



    $controlerF = new ControlerFront();

    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'homePosts') {
            $controlerF->homePosts();
        }
        elseif ($_GET['action'] == 'getPost') {
            $controlerF->getPost();
        }
        elseif ($_GET['action'] == 'addComment') {
            $controlerF->addComment();
        }

        elseif ($_GET['action'] == 'formConnect') {
            $controlerF->formConnect();
        }
        elseif ($_GET['action'] == 'connect') {
            $controlerF->connect();
        }
        elseif ($_GET['action'] == 'admin') {
            $controlerB = new ControlerBack();
            $controlerB->admin();
        }
        elseif ($_GET['action'] == 'deconnect') {
            $controlerB = new ControlerBack();
            $controlerB->deconnect();
        }

        elseif ($_GET['action'] == 'report') {
            $controlerF->report();              
        }

        elseif ($_GET['action'] == 'listReport') {
            $controlerB = new ControlerBack();
            $controlerB->listReport();
        }
        elseif ($_GET['action'] == 'deleteComment') {
            $controlerB = new ControlerBack();
            $controlerB->deleteComment(); 
        }

        elseif ($_GET['action'] == 'deleteReport') {
            $controlerB = new ControlerBack();
            $controlerB->deleteReport();
        }
        elseif ($_GET['action'] == 'listPost') {
            $controlerF->listPost();
        }
        elseif ($_GET['action'] == 'deletePost') {
            $controlerB = new ControlerBack();
            $controlerB->deletePost();
        }
        elseif ($_GET['action'] == 'addPost') {
            $controlerB = new ControlerBack();
            $controlerB->addPost();
        }
        elseif ($_GET['action'] == 'postWrite'){
            $controlerB = new ControlerBack();
            $controlerB->postWrite();
        }
        elseif ($_GET['action'] == 'updatePost') {
            $controlerB = new ControlerBack();
            $controlerB->updatePost();
        }
        elseif ($_GET['action'] == 'updatedPost') {
            $controlerB = new ControlerBack();
            $controlerB->updatedPost();
        }
    }
    else {
        $controlerF->homePosts();
    }
}
catch(NewException $e) {
    require('view/errorView.php');
}
