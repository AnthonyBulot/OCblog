<?php
require('controler.php');
$controler = new Controler();

if (isset($_GET['action'])) {
    if ($_GET['action'] == 'listPosts') {
        $controler->listPosts();
    }
    elseif ($_GET['action'] == 'comments') {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $controler->post();
        }
        else {
            echo 'Erreur : aucun identifiant de billet envoyé';
        }
    }
    elseif ($_GET['action'] == 'addComment') {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                $controler->addComment($_GET['id'], $_POST['author'], $_POST['comment']);
            }
            else {
                echo 'Erreur : tous les champs ne sont pas remplis !';
            }
        }
        else {
            echo 'Erreur : aucun identifiant de billet envoyé';
        }
    }

}
else {
    $controler->listPosts();
}