<?php 

class Signalement extends DbConnect
{
	public function addSignalement($commentId)
	{
    	$comments = $this->_db->prepare('SELECT signalement FROM comments WHERE id = ?');
    	$comments->execute(array($commentId));
    	$signalement = $comments->fetch();
    	$signalement['signalement'] += 1;

    	$add = $this->_db->prepare('UPDATE comments SET signalement = ? WHERE id = ?');
    	$add->execute(array($signalement['signalement'], $commentId));
    	return $add;
	}

	public function listSignalement($first) {
        $req = $this->_db->query('SELECT id, author, comment, comment_date, signalement FROM comments ORDER BY signalement DESC LIMIT ' . $first . ' , 5');
        return $req;
	}

	public function deleteSignalement($commentId) {
    	$add = $this->_db->prepare('UPDATE comments SET signalement = 0 WHERE id = ?');
    	$add->execute(array($commentId));
    	return $add;				
	}
}