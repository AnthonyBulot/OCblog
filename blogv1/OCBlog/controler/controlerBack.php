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
			throw new NewException('Vous n\'avez pas accès à cette page', 401);
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
		header('Location: /OCBlog/blog');
	}

	public function listReport(){
		if (isset($_GET['id']) && !($_GET['id'] > 0)) {
            throw new NewException('Aucun identifiant de commentaire envoyé', 400);
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
            throw new NewException('Aucun identifiant de commentaire envoyé', 400);
        }

		$comment = $this->_objectComment->deleteComment($_GET['id']);
		if (!$comment) {
       	 	throw new NewException('Le commentaire n\'as pas été supprimer !', 409);
    	}
    	else {
    		header('Location: /OCBlog/blog/liste-signalement/delete-1');
    	}
	}

	public function deleteReport() {
		if (!(isset($_GET['id']) && $_GET['id'] > 0)) {
            throw new NewException('Aucun identifiant de commentaire envoyé', 400);
        }

		$report = $this->_objectReport->deleteReport($_GET['id']);
		if (!$report) {
       	 	throw new NewException('Les signalements n\'ont pas été supprimer !', 409);
    	}
    	else {
    		header('Location: /OCBlog/blog/liste-signalement/delete-2');
    	}
	}

	public function deletePost() {
		if (!(isset($_GET['id']) && $_GET['id'] > 0)) {
            throw new NewException('Aucun identifiant de commentaire envoyé', 400);
        }

		$delete = $this->_objectPost->deletePost($_GET['id']);
		if (!$delete) {
       	 	throw new NewException('Le billet n\'a pas été supprimé !', 409);
    	}
    	else {
			header('Location: /OCBlog/blog');
    	}
	}

	public function addPost(){
		$this->render('addPostView');
	}

	public function postWrite(){
		if (empty($_POST['title']) && empty($_POST['addPost'])) {
            throw new NewException('Tous les champs ne sont pas remplis !', 400);
        }

        $dataDb = [
        	'title' => $_POST['title'],
        	'post' => $_POST['addPost']
        ];
		$new = $this->_objectPost->addPost($dataDb);
		if (!$new) {
       	 	throw new NewException('Le billet n\'a pas été ajouté !', 409);
    	}
    	else {
    		header('Location: /OCBlog/blog');
    	}
	}

	public function updatePost(){
		if (!(isset($_GET['id']) && $_GET['id'] > 0)) {
            throw new NewException('Aucun identifiant de commentaire envoyé', 400);
        }

		$posts = $this->_objectPost->getPost($_GET['id']);

		if (!($posts->fetch())): throw new NewException("Ce post n'existe pas !", 404); 
    	else : $posts = $this->_objectPost->getPost($_GET['id']);
    	endif;

		$post = $posts->fetch();
		$data = [
    		'post' => $post
    	];
		$this->render('updatePostView', $data);
	}

	public function updatedPost(){
		if (!(isset($_GET['id']) && $_GET['id'] > 0)) {
            throw new NewException('Aucun identifiant de commentaire envoyé', 400);
        }
		if (empty($_POST['title']) && empty($_POST['addPost'])) {
            throw new NewException('Tous les champs ne sont pas remplis !', 400);
        }

        $dataDb = [
        	'postId' => $_GET['id'],
        	'title' => $_POST['title'],
        	'post' => $_POST['addPost']
        ];
		$update = $this->_objectPost->updatePost($dataDb);
		if (!$update) {
       	 	throw new NewException('La modification n\'as pas eu lieu !', 409);
    	}
    	else {
    	    header('Location: /OCBlog/blog/article-' . $_GET['id']);
    	}		
	}
}

