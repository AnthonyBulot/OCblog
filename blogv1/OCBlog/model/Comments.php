<?php

class Comments extends DbConnect
{
	
	public function getComments($postId)
	{
    	$db = parent::connect();
    	$comments = $db->prepare('SELECT id, author, comment, comment_date FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
    	$comments->execute(array($postId));
    	return $comments;
	}

	public function addComment($postId, $author, $comment)
	{	
		$db = parent::connect();

		$comments = $db->prepare('INSERT INTO comments(id, post_id, author, comment, comment_date, signalement) VALUES(" ", ?, ?, ?, NOW(), 0)';
    	$affectedLines = $comments->execute(array($postId, $author, $comment));
    	return $affectedLines;
	}

	public function deleteComment($id) {
		$db = parent::connect();
		$delete = $db->prepare('DELETE FROM comments WHERE id = ?');
		$delete->execute(array($id));
		return $delete;
	}
}