<?php
require('model/DbConnect.php');
require('model/Posts.php');
require('model/Comments.php');
require('model/Report.php');

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
    	$post = $this->_objectPost->getPost($postId);
    	$comments = $this->_objectComment->getComments($postId);

    	require('view/postView.php');
	}

	public function listPosts($page) {
		$totalPosts = $this->_objectPost->numberPost();

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

		$posts = $this->_objectPost->listPosts($firstEntry);

		require("view/listPostView.php");
	}


	public function addComment($commentId, $author, $comment)
	{
		$affectedLines = $this->_objectComment->addComment($commentId, $author, $comment);
    	if ($affectedLines === false) {
       	 	throw new NewException('Impossible d\'ajouter le commentaire !');
    	}
    	else {
    	    header('Location: index.php?action=comments&id=' . $commentId);
    	}
	}

	public function formConnect() {
		require ('view/connectView.php');
	}

	public function report($commentId, $postId){
		$report = $this->_objectReport->addReport($commentId);
    	if ($report === false) {
       	 	throw new NewException('Echec du signalement !');
    	}
    	else {
    		$this->getPost($postId, true);
    	}
	}
}