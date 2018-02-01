<?php


class Posts extends DbConnect
{
	public function homePost()
	{
   		$db = parent::connect();
    	$req = $db->query('SELECT id, title, content, DATE_FORMAT FROM posts ORDER BY DATE_FORMAT DESC LIMIT 0, 5');
    	return $req;
	}

	function getPost($postId)
	{
    	$db = parent::connect();
    	$post = $db->prepare('SELECT id, title, content, DATE_FORMAT FROM posts WHERE id = ?');
		$post->execute(array($postId));
    	return $post;
	}

}