<?php

class ControlerBack extends Controler
{
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
		$post = $this->_objectPost->lastPost();

		$data = [
			'post' => $post,
			'numberPosts' => $numberPosts
		];
		$this->render('administrationView', $data);
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

		$data = [
    		'comments' => $comments,
    		'numberPages' => $numberPages,
    		'currentPage' => $currentPage
    	];
		$this->render('listCommentsView', $data);
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
		$this->render('addPostView', null);
	}

	public function postWrite(){
		if (empty($_POST['title']) && empty($_POST['addPost'])) {
            throw new NewException('Erreur : tous les champs ne sont pas remplis !');
        }

        $dataDb = [
        	'title' => $_POST['title'],
        	'post' => $_POST['addPost']
        ];
		$new = $this->_objectPost->addPost($dataDb);
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

		if (!($posts->fetch())): throw new NewException("Erreur : Ce post n'existe pas !"); 
    	else : $posts = $this->_objectPost->getPost($_GET['id']);
    	endif;

		$post = $posts->fetch();

		$this->render('updatePostView', $post);
	}

	public function updatedPost(){
		if (!(isset($_GET['id']) && $_GET['id'] > 0)) {
            throw new NewException('Erreur : aucun identifiant de commentaire envoyé');
        }
		if (empty($_POST['title']) && empty($_POST['addPost'])) {
            throw new NewException('Erreur : tous les champs ne sont pas remplis !');
        }

        $dataDb = [
        	'postId' => $_GET['id'],
        	'title' => $_POST['title'],
        	'post' => $_POST['addPost']
        ];
		$update = $this->_objectPost->updatePost($dataDb);
		if (!$update) {
       	 	throw new NewException('La modification n\'as pas eu lieu !');
    	}
    	else {
    	    header('Location: index.php?action=getPost&id=' . $_GET['id']);
    	}		
	}
}

