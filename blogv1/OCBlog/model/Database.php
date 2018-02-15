<?php

class Database {

	protected $_db;

	public function __construct() {
		$instance = DbConnect::getInstance();
		$this->_db = $instance->db;
	}
}