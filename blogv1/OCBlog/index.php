<?php
session_start();

try {
    require('error/NewException.php');
    require('controler/controlerFront.php');
    require('controler/controlerBack.php');
    $controlerF = new ControlerFront();
    $controlerB = new ControlerBack();


    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listPosts') {
            $controlerF->homePosts();
        }
        elseif ($_GET['action'] == 'comments') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $controlerF->getPost($_GET['id'], false);
            }
            else {
                throw new NewException('Erreur : aucun identifiant de billet envoyé');
            }
        }
        elseif ($_GET['action'] == 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                    $controlerF->addComment($_GET['id'], $_POST['author'], $_POST['comment']);
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
            $controlerF->formConnect();
        }
        elseif ($_GET['action'] == 'connect') {
            if (!empty($_POST['password'])) {
                $controlerB->connect($_POST['password']);
            }
            else {
                throw new NewException('Erreur : aucun mot de passe donné');
            } 
        }
        elseif ($_GET['action'] == 'admin') {
            $controlerB->admin();
        }
        elseif ($_GET['action'] == 'deco') {
            $controlerB->deconnect();
        }
        elseif ($_GET['action'] == 'report') {
            if (isset($_GET['postId']) && $_GET['postId'] > 0) {
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    $controlerF->report($_GET['id'], $_GET['postId']);
                }
                else {
                    throw new NewException('Erreur : aucun identifiant de commentaire envoyé');
                }
            } 
            else {
                throw new NewException('Erreur : aucun identifiant de billet envoyé');
            }              
        }
        elseif ($_GET['action'] == 'listReport') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $controlerB->listReport($_GET['id'], false);
            }
            else {
                $controlerB->listReport(null, false);
            }
        }
        elseif ($_GET['action'] == 'deleteComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $controlerB->deleteComment($_GET['id']);
            }
            else {
                throw new NewException('Erreur : aucun identifiant de commentaire envoyé');
            }

        }
        elseif ($_GET['action'] == 'deleteReport') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $controlerB->deleteReport($_GET['id']);
            }
            else {
                throw new NewException('Erreur : aucun identifiant de commentaire envoyé');
            }

        }
        elseif ($_GET['action'] == 'listPost') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $controlerF->listPosts($_GET['id']);
            }
            else {
                $controlerF->listPosts(null);
            }
        }
        elseif ($_GET['action'] == 'deletePost') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $controlerB->deletePost($_GET['id']);
            }
            else {
                throw new NewException('Erreur : aucun identifiant de billet envoyé');
            }
        }
        elseif ($_GET['action'] == 'addPost') {
            $controlerB->addPost();
        }
        elseif ($_GET['action'] == 'postWrite'){
            $controlerB->postWrite($_POST['title'], $_POST['addPost']);
        }
        elseif ($_GET['action'] == 'modification') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $controlerB->updatePost($_GET['id']);
            }
            else {
                throw new NewException('Erreur : aucun identifiant de billet envoyé');
            }
        }
        elseif ($_GET['action'] == 'updatedPost') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $controlerB->updatedPost($_GET['id'], $_POST['title'], $_POST['addPost']);
            }
            else {
                throw new NewException('Erreur : aucun identifiant de billet envoyé');
            }
        }
    }
    else {
        $controlerF->homePosts();
    }
}
catch(NewException $e) {
    require('view/errorView.php');
}
