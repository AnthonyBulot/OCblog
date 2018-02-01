<?php

class DbConnect
{

	public static function connect() {
        $db = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');
        return $db;
	}
}