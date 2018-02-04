<?php 

class Report extends DbConnect
{
	public function addReport($commentId)
	{
    	$comments = $this->_db->prepare('SELECT report FROM comments WHERE id = ?');
    	$comments->execute(array($commentId));
    	$report = $comments->fetch();
    	$report['report'] += 1;

    	$add = $this->_db->prepare('UPDATE comments SET report = ? WHERE id = ?');
    	$add->execute(array($report['report'], $commentId));
    	return $add;
	}

	public function listReport($first) {
        $req = $this->_db->query('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %H:%i:%s\') AS comment_datefr, report FROM comments ORDER BY report DESC LIMIT ' . $first . ' , 5');
        return $req;
	}

	public function deleteReport($commentId) {
    	$add = $this->_db->prepare('UPDATE comments SET report = 0 WHERE id = ?');
    	$add->execute(array($commentId));
    	return $add;				
	}
}