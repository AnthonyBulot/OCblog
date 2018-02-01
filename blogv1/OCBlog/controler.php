<?php
function __autoload($class_name){
    require('model/' . $class_name . '.php'); 
}

class Controler {
	public function listPosts()
	{
		$objetPost = New Posts();
    	$posts = $objetPost->homePost();
    	require('view/homePostView.php');
	}

	function post()
	{
		$objetPost = New Posts();
    	$post = $objetPost->getPost($_GET['id']);

    	$objetComment = New Comments();
    	$comments = $objetComment->getComments($_GET['id']);

    	require('view/postView.php');
	}
	function addComment($id, $author, $comment)
	{
		$objetComment = New Comments();
		$affectedLines = $objetComment->addComment($id, $author, $comment);
		var_dump($affectedLines);
    	if ($affectedLines === false) {
       	 	die('Impossible d\'ajouter le commentaire !');
    	}
    	else {
    	    header('Location: index.php?action=comments&id=' . $id);
    	}
	}
}

