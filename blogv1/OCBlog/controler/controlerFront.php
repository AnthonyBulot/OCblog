<?php

class ControlerFront extends Controler
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
    	$data = [
    		'posts' => $posts
    	];
    	$this->render('homePostView', $data);
	}

	public function getPost()
	{
		if (!(isset($_GET['id']) && $_GET['id'] > 0)) {
            throw new NewException('Erreur : aucun identifiant de billet envoyé');
        }
        if (isset($_GET['report'])){
        	$report = true;
        }
        else
        {
        	$report = null;
        }

    	$post = $this->_objectPost->getPost($_GET['id']);

    	if (!($post->fetch())): throw new NewException("Erreur : Ce post n'existe pas !"); 
    	else : $post = $this->_objectPost->getPost($_GET['id']);
    	endif;

    	$comments = $this->_objectComment->getComments($_GET['id']);
    		
    	$data = [
    		'post' => $post,
    		'comments' => $comments,
    		'report' => $report
    	];
    	$this->render('postView', $data);
	}

	public function listPost() {
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

		$data = [
    		'posts' => $posts,
    		'numberPages' => $numberPages,
    		'currentPage' => $currentPage
    	];
		$this->render('listPostView', $data);
	}


	public function addComment()
	{
		if (!(isset($_GET['id']) && $_GET['id'] > 0)) {
			throw new NewException('Erreur : aucun identifiant de billet envoyé');
		}
        if (empty($_POST['author']) && empty($_POST['comment'])) {
            throw new NewException('Erreur : tous les champs ne sont pas remplis !');
        }

        $dataDb = [
        	'postId' => $_GET['id'],
        	'author' => $_POST['author'],
        	'comment' => $_POST['comment']
        ];

		$affectedLines = $this->_objectComment->addComment($dataDb);
    	if ($affectedLines === false) {
       	 	throw new NewException('Impossible d\'ajouter le commentaire !');
    	}
    	else {
    	    header('Location: index.php?action=getPost&id=' . $_GET['id']);
    	}
	}

	public function formConnect() {
		$this->render('connectView', null);
	}

	public function report(){
		if (!(isset($_GET['postId']) && $_GET['postId'] > 0)) {
			throw new NewException('Erreur : aucun identifiant de billet envoyé');
        }
        if (!(isset($_GET['id']) && $_GET['id'] > 0)) {
            throw new NewException('Erreur : aucun identifiant de commentaire envoyé');
        }

		$report = $this->_objectReport->addReport($_GET['id']);
    	if ($report === false) {
       	 	throw new NewException('Echec du signalement !');
    	}
    	else {
    		header('Location: index.php?action=getPost&id=' . $_GET['postId'] . '&report=true');
    	}
	}

	public function connect(){
		if (empty($_POST['password'])) {
            throw new NewException('Erreur : aucun mot de passe donné');
        } 

        $objectAdministration = New Administration();

		$dbPassword = $objectAdministration->getPassword();
		if ($dbPassword['password'] == $_POST['password']) {
			$_SESSION['password'] = true;
    	    header('Location: index.php?action=admin');
		}
		else{
			throw new NewException('Mot de passe Incorect');
		}
	}
}