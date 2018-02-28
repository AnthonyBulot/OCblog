<?php
namespace Blog\controler;


class ControlerFront extends Controler
{
    protected $_objectPost;
    protected $_objectComment;
    protected $_objectReport;
    protected $_objectAdministration;


    public function __construct($model)
    {
        $this->_objectPost = $model['Posts'];
        $this->_objectComment = $model['Comments'];
        $this->_objectReport = $model['Report'];
        $this->_objectAdministration = $model['Administration']; 
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
		if (!(isset($_GET['postId']) && $_GET['postId'] > 0)) {
            throw new NewException('Aucun identifiant de billet envoyé', 400);
        }
        
        if (isset($_GET['signalement'])){
        	$report = true;
        }
        else
        {
        	$report = null;
        }
    	$post = $this->_objectPost->getPost($_GET['postId']);

    	if (!($post->fetch())): throw new NewException("Ce post n'existe pas !", 404); 
    	else : $post = $this->_objectPost->getPost($_GET['postId']);
    	endif;

        $totalcomment = $this->_objectComment->numberCommentsPost($_GET['postId']);

        $numberPages=ceil($totalcomment/5);

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

        $data = [
            'id' => $_GET['postId'],
            'first' => $firstEntry, 
        ];
    	$comments = $this->_objectComment->getComments($data);
    		
    	$data = [
    		'post' => $post,
    		'comments' => $comments,
    		'report' => $report,
            'numberPages' => $numberPages,
            'currentPage' => $currentPage
    	];
    	$this->render('postView', $data);
	}

	public function listPost() {
		if (isset($_GET['id']) && !($_GET['id'] > 0)) {
            throw new NewException('Aucun identifiant de commentaire envoyé', 400);
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
			throw new NewException('Aucun identifiant de billet envoyé', 400);
		}
        if (empty($_POST['author']) && empty($_POST['comment'])) {
            throw new NewException('Tous les champs ne sont pas remplis !', 400);
        }

        $dataDb = [
        	'postId' => $_GET['id'],
        	'author' => $_POST['author'],
        	'comment' => $_POST['comment']
        ];

		$affectedLines = $this->_objectComment->addComment($dataDb);
    	if ($affectedLines === false) {
       	 	throw new NewException('Impossible d\'ajouter le commentaire !', 409);
    	}
    	else {
    	    header('Location: /blog/article-' . $_GET['id']);
    	}
	}

	public function formConnect() {
		$this->render('connectView');
	}

	public function report(){
		if (!(isset($_GET['postId']) && $_GET['postId'] > 0)) {
			throw new NewException('Aucun identifiant de billet envoyé', 400);
        }
        if (!(isset($_GET['id']) && $_GET['id'] > 0)) {
            throw new NewException('Aucun identifiant de commentaire envoyé', 400);
        }

		$report = $this->_objectReport->addReport($_GET['id']);
    	if ($report === false) {
       	 	throw new NewException('Echec du signalement !');
    	}
    	else {
    		header('Location: /blog/article-' . $_GET['postId'] . '/signalement');
    	}
	}

	public function connect(){
		if (empty($_POST['password'])) {
            throw new NewException('Aucun mot de passe donné', 400);
        } 
		$dbPassword = $this->_objectAdministration->getPassword();

	    if (password_verify($_POST['password'], $dbPassword['password'])) {
			$_SESSION['password'] = true;
    		header('Location: /blog/administration');
		}
		else{
			throw new NewException('Mot de passe Incorect', 400);
		} 
	}

    public function search(){
        if (empty($_POST['search'])) {
            throw new NewException('Aucun champs renseigné', 400);
        }

        $search = '%' . $_POST['search'] . '%';

        $data = $this->_objectPost->search($search);  

        if (!($data->fetch()))
        {
            $data = [
                'search' => $_POST['search'],
            ];
            $this->render('falseSearchView', $data);
        }
        else
        {
            $data = $this->_objectPost->search($search);
            $dataDb = [
                'search' => $data,
            ];
            $this->render('searchView', $dataDb);
        }
    }
}