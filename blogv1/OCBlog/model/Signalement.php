<?php 

class Signalement extends DbConnect
{
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

	public function deleteSignalement($commentId) {
    	$db = parent::connect();
    	$comments = $db->prepare('SELECT signalement FROM comments WHERE id = ?');
    	$comments->execute(array($commentId));
    	$signalement = $comments->fetch();
    	$signalement['signalement'] = 0;

    	$add = $db->prepare('UPDATE comments SET signalement = ? WHERE id = ?');
    	$add->execute(array($signalement['signalement'], $commentId));
    	return $add;				
	}
}