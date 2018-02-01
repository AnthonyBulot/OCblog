<?php

class Administration extends DbConnect{

	public function getPassword()
	{
    	$db = parent::connect();
    	$password = $db->query('SELECT password FROM administration LIMIT 0, 1');
    	$pass = $password->fetch();
    	return $pass;		
	}

}