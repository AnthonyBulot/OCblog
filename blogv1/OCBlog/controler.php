<?php
function __autoload($class_name){
    require('model/' . $class_name . '.php'); 
}

class Controler {
	public function homePosts()
	{
		$objectPost = New Posts();
    	$posts = $objectPost->homePost();
    	require('view/homePostView.php');
	}

	public function post()
	{
		$objectPost = New Posts();
    	$post = $objectPost->getPost($_GET['id']);

    	$objectComment = New Comments();
    	$comments = $objectComment->getComments($_GET['id']);

    	require('view/postView.php');
	}
	public function addComment($commentId, $author, $comment)
	{
		$objectComment = New Comments();
		$affectedLines = $objectComment->addComment($commentId, $author, $comment);
    	if ($affectedLines === false) {
       	 	throw new NewException('Impossible d\'ajouter le commentaire !');
    	}
    	else {
    	    header('Location: index.php?action=comments&id=' . $commentId);
    	}
	}

	public function connect($password){
		$objectAdministration = New Administration();
		$dbPassword = $objectAdministration->getPassword();
		if ($dbPassword['password'] == $password) {
			$_SESSION['password'] = $password;
    	    header('Location: index.php?action=admin');
		}
		else{
			throw new NewException('Mot de passe Incorect');
		}
	}
	public function formConnect() {
		require ('view/connectView.php');
	}
	public function admin(){
		require('view/administrationView.php');
	}
	public function deconnect(){
		session_destroy();
		$this->homePosts();
	}

	public function report($commentId){
		$objectReport = New Report();
		$report = $objectReport->addReport($commentId);
    	if ($report === false) {
       	 	throw new NewException('Echec du signalement !');
    	}
    	else {
    		$this->homePosts();
    	}
	}

	public function listReport($page, $delete){
		$objectReport = new Report();
		$objectComments = new Comments();
		$totalPosts = $objectComments->numberComments();

		$numberPages=ceil($totalPosts/5);

		if(!(is_null($page))) {
			$currentPage=intval($page);
 
     		if($currentPage>$numberPages) // Si la valeur de $pageActuelle (le numéro de la page) est plus grande que $nombreDePages...
     		{
         		$currentPage=$numberPages;
     		}
		}
		else // Sinon
		{
     		$currentPage = 1; // La page actuelle est la n°1    
		}

		$firstEntry=($currentPage - 1) * 5; // On calcul la première entrée à lire

		$comments = $objectReport->listReport($firstEntry);

		require("view/listCommentsView.php");
	}

	public function deleteComment($commentId){
		$objectComment = New Comments();
		$comment = $objectComment->deleteComment($commentId);
		if ($comment === false) {
       	 	throw new NewException('Le commentaire n\'as pas été supprimer !');
    	}
    	else {
    		$this->listReport(1, 1);
    	}
	}

	public function deleteReport($id) {
		$objectReport = new Report();
		$report = $objectReport->deleteReport($id);
		if ($report === false) {
       	 	throw new NewException('Les signalements n\'ont pas été supprimer !');
    	}
    	else {
    		$this->listReport(1, 2);
    	}
	}

	public function listPosts($page) {
		$objetPost = new Posts();
		$totalPosts = $objetPost->numberPost();

		$numberPages=ceil($totalPosts/5);

		if(!(is_null($page))) {
			$currentPage=intval($page);
 
     		if($currentPage>$numberPages) // Si la valeur de $pageActuelle (le numéro de la page) est plus grande que $nombreDePages...
     		{
         		$currentPage=$numberPages;
     		}
		}
		else // Sinon
		{
     		$currentPage = 1; // La page actuelle est la n°1    
		}

		$firstEntry=($currentPage - 1) * 5; // On calcul la première entrée à lire

		$posts = $objetPost->listPosts($firstEntry);

		require("view/listPostView.php");
	}
}

