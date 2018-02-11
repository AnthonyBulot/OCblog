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
        if ($_GET['action'] == 'listPosts') {
            $controlerF->homePosts();
        }
        elseif ($_GET['action'] == 'comments') {
            $controlerF->getPost($_GET['id'], false);
        }
        elseif ($_GET['action'] == 'addComment') {
            $controlerF->addComment($_GET['id'], $_POST['author'], $_POST['comment']);
        }
        elseif ($_GET['action'] == 'formConnect') {
            $controlerF->formConnect();
        }
        elseif ($_GET['action'] == 'connect') {
            $controlerF->connect($_POST['password']);
        }
        elseif ($_GET['action'] == 'admin') {
            $controlerB = new ControlerBack();
            $controlerB->admin();
        }
        elseif ($_GET['action'] == 'deco') {
            $controlerB = new ControlerBack();
            $controlerB->deconnect();
        }
        elseif ($_GET['action'] == 'report') {
            $controlerF->report($_GET['id'], $_GET['postId']);              
        }
        elseif ($_GET['action'] == 'listReport') {
            $controlerB = new ControlerBack();
            $controlerB->listReport($_GET['id'], false);
        }
        elseif ($_GET['action'] == 'deleteComment') {
            $controlerB = new ControlerBack();
            $controlerB->deleteComment($_GET['id']); 
        }
        elseif ($_GET['action'] == 'deleteReport') {
            $controlerB = new ControlerBack();
            $controlerB->deleteReport($_GET['id']);
        }
        elseif ($_GET['action'] == 'listPost') {
            $controlerF->listPosts();
        }
        elseif ($_GET['action'] == 'deletePost') {
            $controlerB = new ControlerBack();
            $controlerB->deletePost($_GET['id']);
        }
        elseif ($_GET['action'] == 'addPost') {
            $controlerB = new ControlerBack();
            $controlerB->addPost();
        }
        elseif ($_GET['action'] == 'postWrite'){
            $controlerB = new ControlerBack();
            $controlerB->postWrite($_POST['title'], $_POST['addPost']);
        }
        elseif ($_GET['action'] == 'modification') {
            $controlerB = new ControlerBack();
            $controlerB->updatePost($_GET['id']);
        }
        elseif ($_GET['action'] == 'updatedPost') {
            $controlerB = new ControlerBack();
            $controlerB->updatedPost($_GET['id'], $_POST['title'], $_POST['addPost']);
        }
    }
    else {
        $controlerF->homePosts();
    }
}
catch(NewException $e) {
    require('view/errorView.php');
}
