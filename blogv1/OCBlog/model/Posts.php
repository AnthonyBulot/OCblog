<?php


class Posts extends DbConnect
{
	public function homePost()
	{
    	$req = $this->_db->query('SELECT id, title, content, DATE_FORMAT FROM posts ORDER BY DATE_FORMAT DESC LIMIT 0, 5');
    	return $req;
	}

	public function getPost($postId)
	{
    	$post = $this->_db->prepare('SELECT id, title, content, DATE_FORMAT FROM posts WHERE id = ?');
		$post->execute(array($postId));
    	return $post;
	}

	public function numberPost()
	{
		$data_total= $this->_db->query('SELECT COUNT(*) AS total FROM posts');
		$data = $data_total->fetch();
		$total = $data['total'];
		return $total;
	}

	public function listPosts($first){
		$posts= $this->_db->query('SELECT id, title, content, DATE_FORMAT FROM posts ORDER BY DATE_FORMAT DESC LIMIT ' . $first . ', 5');
		return $posts;
	}

}