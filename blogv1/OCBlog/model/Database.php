<?php

class Database {

	protected $_db;

	public function __construct() {
		$this->_db = DbConnect::getInstance();
	}
}