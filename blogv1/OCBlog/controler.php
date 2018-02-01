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

	public function post()
	{
		$objetPost = New Posts();
    	$post = $objetPost->getPost($_GET['id']);

    	$objetComment = New Comments();
    	$comments = $objetComment->getComments($_GET['id']);

    	require('view/postView.php');
	}
	public function addComment($id, $author, $comment)
	{
		$objetComment = New Comments();
		$affectedLines = $objetComment->addComment($id, $author, $comment);
    	if ($affectedLines === false) {
       	 	throw new NewException('Impossible d\'ajouter le commentaire !');
    	}
    	else {
    	    header('Location: index.php?action=comments&id=' . $id);
    	}
	}

	public function connect($password){
		$objAdministration = New Administration();
		$dbPassword = $objAdministration->getPassword();
		if ($dbPassword['password'] == $password) {
    	    header('Location: index.php?action=admin&password=' . $password);
		}
		else{
			throw new NewException('Mot de passe Incorect');
		}
	}
	public function admin(){
		require('view/administrationView.php');
	}
	public function deconnect(){
		session_destroy();
		$this->listPosts();
	}

	public function signaler($idComment){
		$objetComment = New Signalement();
		$signalement = $objetComment->addSignalement($idComment);
    	if ($signalement === false) {
       	 	throw new NewException('Echec du signalement !');
    	}
    	else {
    		$this->listPosts();
    	}
	}

	public function listSignalement($delete){
		$objetComment = New Signalement();
		$list = $objetComment->listSignalement();
		require ('view/listComments.php');
	}

	public function deleteComment($id){
		$objetComment = New Comments();
		$comment = $objetComment->deleteComment($id);
		if ($comment === false) {
       	 	throw new NewException('Le commentaire n\'as pas été supprimer !');
    	}
    	else {
    		$this->listSignalement(1);
    	}
	}

	public function deleteSignalement($id) {
		$objetsign = new Signalement();
		$sign = $objetsign->deleteSignalement($id);
		if ($sign === false) {
       	 	throw new NewException('Les signalements n\'ont pas été supprimer !');
    	}
    	else {
    		$this->listSignalement(2);
    	}
	}
}

