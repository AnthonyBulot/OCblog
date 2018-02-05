<?php
function __autoload($class_name){
    require('model/' . $class_name . '.php'); 
}

class ControlerBack {
	protected $_objectPost;
	protected $_objectComment;
	protected $_objectReport;
	protected $_objectAdministration;

	public function __construct()
	{
		$this->_objectPost = New Posts();
		$this->_objectComment = New Comments();
		$this->_objectReport = New Report();
		$this->_objectAdministration = New Administration();
	}

	public function connect($password){
		$dbPassword = $this->_objectAdministration->getPassword();
		if ($dbPassword['password'] == $password) {
			$_SESSION['password'] = $password;
    	    header('Location: index.php?action=admin');
		}
		else{
			throw new NewException('Mot de passe Incorect');
		}
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
		$comment = $this->_objectComment->deleteComment($commentId);
		if ($comment === false) {
       	 	throw new NewException('Le commentaire n\'as pas été supprimer !');
    	}
    	else {
    		$this->listReport(1, 1);
    	}
	}

	public function deleteReport($id) {
		$report = $this->_objectReport->deleteReport($id);
		if ($report === false) {
       	 	throw new NewException('Les signalements n\'ont pas été supprimer !');
    	}
    	else {
    		$this->listReport(1, 2);
    	}
	}

	public function deletePost($postId) {
		$delete = $this->_objectPost->deletePost($postId);
		if ($delete === false) {
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
		if ($new === false) {
       	 	throw new NewException('Le billet n\'a pas été ajouté !');
    	}
    	else {
    		header('Location: index.php');
    	}
	}

	public function updatePost($postId){
		$posts = $this->_objectPost->getPost($postId);
		$post = $posts->fetch();
		require('view/updatePostView.php');		
	}

	public function updatedPost($postId, $title, $content){
		$update = $this->_objectPost->updatePost($postId, $title, $content);
		if ($update === false) {
       	 	throw new NewException('La modification n\'as pas eu lieu !');
    	}
    	else {
    		$controlerF = new ControlerFront();
    		$controlerF->getPost($postId, false);
    	}		
	}
}

