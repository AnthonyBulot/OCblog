<?php


class Administration extends DbConnect{

	public function getPassword()
	{
    	$password = $this->_db->query('SELECT password FROM administration LIMIT 0, 1');
    	$pass = $password->fetch();
    	return $pass;		
	}

}