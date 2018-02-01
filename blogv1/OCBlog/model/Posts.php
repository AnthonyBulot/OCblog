<?php


class Posts extends DbConnect
{
	public function homePost()
	{
   		$db = parent::connect();
    	$req = $db->query('SELECT id, title, content, DATE_FORMAT FROM posts ORDER BY DATE_FORMAT DESC LIMIT 0, 5');
    	return $req;
	}

	public function getPost($postId)
	{
    	$db = parent::connect();
    	$post = $db->prepare('SELECT id, title, content, DATE_FORMAT FROM posts WHERE id = ?');
		$post->execute(array($postId));
    	return $post;
	}

	public function numberPost()
	{
    	$db = parent::connect();
		$data_total= $db->query('SELECT COUNT(*) AS total FROM posts');
		$data = $data_total->fetch();
		$total = $data['total'];
		return $total;
	}

	public function listPosts($first){
		$db = parent::connect();
		$posts= $db->query('SELECT id, title, content, DATE_FORMAT FROM posts ORDER BY DATE_FORMAT DESC LIMIT ' . $first . ', 5');
		return $posts;
	}

}