<?php


class Posts extends Database
{
	public function homePost()
	{
    	$req = $this->_db->query('SELECT id, title, content, DATE_FORMAT(datefr, \'%d/%m/%Y à %H:%i:%s\') AS date_fr FROM posts ORDER BY datefr DESC LIMIT 0, 5');
    	return $req;
	}

	public function getPost($postId)
	{
    	$post = $this->_db->prepare('SELECT id, title, content, DATE_FORMAT(datefr, \'%d/%m/%Y à %H:%i:%s\') AS date_fr FROM posts WHERE id = ?');
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
		$posts= $this->_db->prepare('SELECT id, title, content, DATE_FORMAT(datefr, \'%d/%m/%Y à %H:%i:%s\') AS date_fr FROM posts ORDER BY datefr DESC LIMIT :first, 5');
		$posts->bindParam(':first', $first, PDO::PARAM_INT);
        $posts->execute();
		return $posts;
	}

	public function lastPost(){
		$posts= $this->_db->query('SELECT id, title, content, DATE_FORMAT(datefr, \'%d/%m/%Y à %H:%i:%s\') AS date_fr FROM posts ORDER BY datefr DESC LIMIT 0, 1');
		return $posts->fetch();
	}

	public function deletePost($postId) {
		$delete = $this->_db->prepare('DELETE FROM posts WHERE id = ?');
		$delete->execute(array($postId));
		return $delete;
	}

	public function addPost($data) {
		$req = $this->_db->prepare('INSERT INTO posts(title, content, datefr) VALUES( :title, :post , NOW())');
		$new = $req->execute(array(
			'title' => $data['title'],
			'post' => $data['post'],
			));
		return $new;
	} 

	public function updatePost($data) {
		$add = $this->_db->prepare('UPDATE posts SET title = ?, content = ? WHERE id = ?');
    	$add->execute(array($data['title'], $data['post'], $data['postId']));
    	return $add;
	}

	public function search($search) {
		$req = $this->_db->prepare('SELECT id, title, content, DATE_FORMAT(datefr, \'%d/%m/%Y à %H:%i:%s\') AS date_fr FROM posts 
								  WHERE title LIKE :title OR content LIKE :content ORDER BY datefr DESC');
		$req->execute(array(
			'title' => $search,
			'content' => $search,
		));
		return $req;
	}
}