<?php
//Singleton
class DbConnect
{
	private $settings = [];
	public $db;
	private static $_instance;

	public static function getInstance(){

		if (is_null((self::$_instance))){

			self::$_instance = new DbConnect();
		}
		return self::$_instance;
	}

	private function __construct(){
		$this->settings = require 'config/config.php';
		$this->db = $this->getDb();
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