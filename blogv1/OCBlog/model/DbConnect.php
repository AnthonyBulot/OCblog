<?php

class DbConnect
{
	protected $_db;

	public function __construct() {
        $this->_db = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');
	}
}