<?php
session_start();

require('NewException.php');
require('controler.php');
$controler = new Controler();

try {
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listPosts') {
            $controler->homePosts();
        }
        elseif ($_GET['action'] == 'comments') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $controler->post();
            }
            else {
                throw new NewException('Erreur : aucun identifiant de billet envoyé');
            }
        }
        elseif ($_GET['action'] == 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                    $controler->addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                }
                else {
                    throw new NewException('Erreur : tous les champs ne sont pas remplis !');
                }
            }
            else {
                throw new NewException('Erreur : aucun identifiant de billet envoyé');
            }
        }
        elseif ($_GET['action'] == 'formConnect') {
            $controler->formConnect();
        }
        elseif ($_GET['action'] == 'connect') {
            if (!empty($_POST['password'])) {
                $controler->connect($_POST['password']);
            }
            else {
                throw new NewException('Erreur : aucun mot de passe donné');
            } 
        }
        elseif ($_GET['action'] == 'admin') {
            $controler->admin();
        }
        elseif ($_GET['action'] == 'deco') {
            $controler->deconnect();
        }
        elseif ($_GET['action'] == 'signaler') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $controler->report($_GET['id']);
            }           
        }
        elseif ($_GET['action'] == 'listReport') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $controler->listReport($_GET['id'], false);
            }
            else {
                $controler->listReport(null, false);
            }
        }
        elseif ($_GET['action'] == 'deleteComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $controler->deleteComment($_GET['id']);
            }            
        }
        elseif ($_GET['action'] == 'deleteReport') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $controler->deleteReport($_GET['id']);
            } 
        }
        elseif ($_GET['action'] == 'listPost') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $controler->listPosts($_GET['id']);
            }
            else {
                $controler->listPosts(null);
            }
        }
    }
    else {
        $controler->homePosts();
    }
}
catch(NewException $e) {
    $errorMessage = $e->getMessage();
    require('view/errorView.php');
}
