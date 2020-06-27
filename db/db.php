<?php


require_once dirname(__FILE__).'/MysqliDb.php';



/*https://github.com/ThingEngineer/PHP-MySQLi-Database-Class*/

class Db{


	static $host = "localhost";
	static $username = "sifoo";
	static $password = "2byEqNgMUjKrrh9nDyGBYx";
	static $dbname = "broadcaster";


	static function instance($new = null){

	    if ($new){
	        return new MysqliDb (self::$host, self::$username, self::$password, self::$dbname);
        }
		return MysqliDb::getInstance() ?: new MysqliDb (self::$host, self::$username, self::$password, self::$dbname);
	}


}





