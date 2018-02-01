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

		$comments = $db->prepare('INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())');
    	$affectedLines = $comments->execute(array($postId, $author, $comment));
    	return $affectedLines;
	}

	public function addSignalement($commentId)
	{
    	$db = parent::connect();
    	$comments = $db->prepare('SELECT signalement FROM comments WHERE id = ?');
    	$comments->execute(array($commentId));
    	$signalement = $comments->fetch();
    	$signalement['signalement'] += 1;

    	$add = $db->prepare('UPDATE comments SET signalement = ? WHERE id = ?');
    	$add->execute(array($signalement['signalement'], $commentId));
    	return $add;
	}

	public function listSignalement() {
		$db = parent::connect();
    	$req = $db->query('SELECT id, author, comment, comment_date, signalement FROM comments ORDER BY signalement DESC LIMIT 0, 5');
    	return $req;
	}

	public function deleteComment($id) {
		$db = parent::connect();
		$delete = $db->prepare('DELETE FROM comments WHERE id = ?');
		$delete->execute(array($id));
		return $delete;
	}
}