<?php


class Comments extends Database
{
	
	public function getComments($postId)
	{
    	$comments = $this->_db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %H:%i:%s\') AS comment_datefr FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
    	$comments->execute(array($postId));
    	return $comments;
	}

	public function addComment($data)
	{	
		$comments = $this->_db->prepare('INSERT INTO comments(post_id, author, comment, comment_date, report) VALUES(?, ?, ?, NOW(), 0)');
    	$affectedLines = $comments->execute(array($data['postId'], $data['author'], $data['comment']));
    	return $affectedLines;
	}

	public function deleteComment($id) {
		$delete = $this->_db->prepare('DELETE FROM comments WHERE id = ?');
		$delete->execute(array($id));
		return $delete;
	}

	public function numberComments()
	{
		$data_total= $this->_db->query('SELECT COUNT(*) AS total FROM comments');
		$data = $data_total->fetch();
		$total = $data['total'];
		return $total;
	}

}