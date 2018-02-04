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

	public function lastPost(){
		$posts= $this->_db->query('SELECT id, title, content, DATE_FORMAT FROM posts ORDER BY DATE_FORMAT DESC LIMIT 0, 1');
		return $posts->fetch();
	}

	public function deletePost($postId) {
		$delete = $this->_db->prepare('DELETE FROM posts WHERE id = ?');
		$delete->execute(array($postId));
		return $delete;
	}

	public function addPost($title, $post) {
		$req = $this->_db->prepare('INSERT INTO posts(title, content, DATE_FORMAT) VALUES( :title, :post , NOW())');
		$new = $req->execute(array(
			'title' => $title,
			'post' => $post,
			));
		return $new;
	} 

	public function updatePost($postId, $title, $content) {
		$add = $this->_db->prepare('UPDATE posts SET title = ?, content = ? WHERE id = ?');
    	$add->execute(array($title, $content, $postId));
    	return $add;
	}
}