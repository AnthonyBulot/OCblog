<?php

class ControlerFront
{
	protected $_objectPost;
	protected $_objectComment;
	protected $_objectReport;


	public function __construct()
	{
		$this->_objectPost = New Posts();
		$this->_objectComment = New Comments();
		$this->_objectReport = New Report();
	}

	public function homePosts()
	{
    	$posts = $this->_objectPost->homePost();
    	require('view/homePostView.php');
	}

	public function getPost($postId, $report)
	{
		if (!(isset($_GET['id']) && $_GET['id'] > 0)) {
            throw new NewException('Erreur : aucun identifiant de billet envoyé');
        }
    	$post = $this->_objectPost->getPost($postId);
    	$comments = $this->_objectComment->getComments($postId);

    	require('view/postView.php');
	}

	public function listPosts() {
		if (isset($_GET['id']) && !($_GET['id'] > 0)) {
            throw new NewException('Erreur : aucun identifiant de commentaire envoyé');
        }

		$totalPosts = $this->_objectPost->numberPost();

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

		$posts = $this->_objectPost->listPosts($firstEntry);

		require("view/listPostView.php");
	}


	public function addComment($postId, $author, $comment)
	{
		if (!(isset($_GET['id']) && $_GET['id'] > 0)) {
			throw new NewException('Erreur : aucun identifiant de billet envoyé');
		}
        if (empty($_POST['author']) && empty($_POST['comment'])) {
            throw new NewException('Erreur : tous les champs ne sont pas remplis !');
        }

		$affectedLines = $this->_objectComment->addComment($postId, $author, $comment);
    	if ($affectedLines === false) {
       	 	throw new NewException('Impossible d\'ajouter le commentaire !');
    	}
    	else {
    	    header('Location: index.php?action=comments&id=' . $postId);
    	}
	}

	public function formConnect() {
		require ('view/connectView.php');
	}

	public function report($commentId, $postId){
		if (!(isset($_GET['postId']) && $_GET['postId'] > 0)) {
			throw new NewException('Erreur : aucun identifiant de billet envoyé');
        }
        if (!(isset($_GET['id']) && $_GET['id'] > 0)) {
            throw new NewException('Erreur : aucun identifiant de commentaire envoyé');
        }

		$report = $this->_objectReport->addReport($commentId);
    	if ($report === false) {
       	 	throw new NewException('Echec du signalement !');
    	}
    	else {
    		$this->getPost($postId, true);
    	}
	}

	public function connect($password){
		if (empty($_POST['password'])) {
            throw new NewException('Erreur : aucun mot de passe donné');
        } 

        $objectAdministration = New Administration();

		$dbPassword = $objectAdministration->getPassword();
		if ($dbPassword['password'] == $password) {
			$_SESSION['password'] = true;
    	    header('Location: index.php?action=admin');
		}
		else{
			throw new NewException('Mot de passe Incorect');
		}
	}
}