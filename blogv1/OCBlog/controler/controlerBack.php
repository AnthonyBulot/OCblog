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

	public function listReport(){
		if (isset($_GET['id']) && !($_GET['id'] > 0)) {
            throw new NewException('Erreur : aucun identifiant de commentaire envoyé');
        }

		$totalPosts = $this->_objectComment->numberComments();

		$numberPages=ceil($totalPosts/5);

		if(isset($_GET['id'])) {
			$currentPage=intval($_GET['id']);
 
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

	public function deleteComment(){
		if (!(isset($_GET['id']) && $_GET['id'] > 0)) {
            throw new NewException('Erreur : aucun identifiant de commentaire envoyé');
        }

		$comment = $this->_objectComment->deleteComment($_GET['id']);
		if (!$comment) {
       	 	throw new NewException('Le commentaire n\'as pas été supprimer !');
    	}
    	else {
    		header('Location: index.php?action=listReport&id=1&delete=1');
    	}
	}

	public function deleteReport() {
		if (!(isset($_GET['id']) && $_GET['id'] > 0)) {
            throw new NewException('Erreur : aucun identifiant de commentaire envoyé');
        }

		$report = $this->_objectReport->deleteReport($_GET['id']);
		if (!$report) {
       	 	throw new NewException('Les signalements n\'ont pas été supprimer !');
    	}
    	else {
    		header('Location: index.php?action=listReport&id=1&delete=2');
    	}
	}

	public function deletePost() {
		if (!(isset($_GET['id']) && $_GET['id'] > 0)) {
            throw new NewException('Erreur : aucun identifiant de commentaire envoyé');
        }

		$delete = $this->_objectPost->deletePost($_GET['id']);
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

	public function postWrite(){
		if (empty($_POST['title']) && empty($_POST['addPost'])) {
            throw new NewException('Erreur : tous les champs ne sont pas remplis !');
        }


		$new = $this->_objectPost->addPost($_POST['title'], $_POST['addPost']);
		if (!$new) {
       	 	throw new NewException('Le billet n\'a pas été ajouté !');
    	}
    	else {
    		header('Location: index.php');
    	}
	}

	public function updatePost(){
		if (!(isset($_GET['id']) && $_GET['id'] > 0)) {
            throw new NewException('Erreur : aucun identifiant de commentaire envoyé');
        }

		$posts = $this->_objectPost->getPost($_GET['id']);
		$post = $posts->fetch();
		require('view/updatePostView.php');		
	}

	public function updatedPost(){
		if (!(isset($_GET['id']) && $_GET['id'] > 0)) {
            throw new NewException('Erreur : aucun identifiant de commentaire envoyé');
        }
		if (empty($_POST['title']) && empty($_POST['addPost'])) {
            throw new NewException('Erreur : tous les champs ne sont pas remplis !');
        }

		$update = $this->_objectPost->updatePost($_GET['id'], $_POST['title'], $_POST['addPost']);
		if (!$update) {
       	 	throw new NewException('La modification n\'as pas eu lieu !');
    	}
    	else {
    	    header('Location: index.php?action=getPost&id=' . $_GET['id']);
    	}		
	}
}

