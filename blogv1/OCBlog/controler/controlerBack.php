<?php

class ControlerBack {
	protected $_objectPost;
	protected $_objectComment;
	protected $_objectReport;

	public function __construct()
	{
		if (!(isset($_SESSION['password'])))
		{
			throw new NewException('Vous n\'avez pas accès à cette page');
		}
		$this->_objectPost = New Posts();
		$this->_objectComment = New Comments();
		$this->_objectReport = New Report();
	}

	public function admin(){
		$numberPosts = $this->_objectPost->numberPost();
		$data = $this->_objectPost->lastPost();

		require('view/administrationView.php');
	}

	public function deconnect(){
		session_destroy();
		header('Location: index.php');
	}

	public function listReport($page, $delete){
		if (!($_GET['id'] > 0)) {
			throw new NewException('Billet Incorrect');
		}

		$totalPosts = $this->_objectComment->numberComments();

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

		$comments = $this->_objectReport->listReport($firstEntry);

		require("view/listCommentsView.php");
	}

	public function deleteComment($commentId){
		if (!(isset($_GET['id']) && $_GET['id'] > 0)) {
            throw new NewException('Erreur : aucun identifiant de commentaire envoyé');
        }

		$comment = $this->_objectComment->deleteComment($commentId);
		if (!$comment) {
       	 	throw new NewException('Le commentaire n\'as pas été supprimer !');
    	}
    	else {
    		$this->listReport(1, 1);
    	}
	}

	public function deleteReport($id) {
		if (!(isset($_GET['id']) && $_GET['id'] > 0)) {
            throw new NewException('Erreur : aucun identifiant de commentaire envoyé');
        }

		$report = $this->_objectReport->deleteReport($id);
		if (!$report) {
       	 	throw new NewException('Les signalements n\'ont pas été supprimer !');
    	}
    	else {
    		$this->listReport(1, 2);
    	}
	}

	public function deletePost($postId) {
		if (!(isset($_GET['id']) && $_GET['id'] > 0)) {
            throw new NewException('Erreur : aucun identifiant de commentaire envoyé');
        }

		$delete = $this->_objectPost->deletePost($postId);
		if (!$delete) {
       	 	throw new NewException('Le billet n\'a pas été supprimé !');
    	}
    	else {
			header('Location: index.php');
    	}
	}

	public function addPost(){
		require ('view/addPostView.php');
	}

	public function postWrite($titre, $post){
		$new = $this->_objectPost->addPost($titre, $post);
		if (!$new) {
       	 	throw new NewException('Le billet n\'a pas été ajouté !');
    	}
    	else {
    		header('Location: index.php');
    	}
	}

	public function updatePost($postId){
		if (!(isset($_GET['id']) && $_GET['id'] > 0)) {
            throw new NewException('Erreur : aucun identifiant de commentaire envoyé');
        }

		$posts = $this->_objectPost->getPost($postId);
		$post = $posts->fetch();
		require('view/updatePostView.php');		
	}

	public function updatedPost($postId, $title, $content){
		if (!(isset($_GET['id']) && $_GET['id'] > 0)) {
            throw new NewException('Erreur : aucun identifiant de commentaire envoyé');
        }

		$update = $this->_objectPost->updatePost($postId, $title, $content);
		if (!$update) {
       	 	throw new NewException('La modification n\'as pas eu lieu !');
    	}
    	else {
    		$controlerF = new ControlerFront();
    		$controlerF->getPost($postId, false);
    	}		
	}
}

