<?php
//Singleton
class DbConnect
{
	private $settings = [];
	private static $_db;

	public static function getInstance(){

		if (is_null((self::$_db))){

			$object = new DbConnect();
			self::$_db = $object->getDb();
		}
		return self::$_db;
	}

	private function __construct(){
		$this->settings = require 'config/config.php';
	}

	public function get($key) {

		if(!isset($this->settings[$key])){
			return null;
		}
		return $this->settings[$key];
	}

	private function getDb() {
		$host = $this->get("db_host");
		$name = $this->get("db_name");
		$password = $this->get("db_pass");
		$user = $this->get("db_user");

		return new PDO('mysql:host='. $host .';dbname='. $name .';charset=utf8', ''. $user .'', ''. $password .'');
	}
}