<?php
/**
 * MySQLi database; only one connection is allowed. 
 */
class Database {
	
	
  public $MYSQL_HOST;
  public $MYSQL_LOGIN;
  public $MYSQL_PASS;
  public $MYSQL_DB;
  public $dbtype;
  public $result;
  private $_connection;

  // Store the single instance.
  private static $_instance;
  
  /**
   * Get an instance of the Database.
   * @return Database 
   */
  public static function getInstance($host, $username, $password, $database, $dbtype) {
    if (!self::$_instance) {
    	self::$_instance = new self($host, $username, $password, $database, $dbtype);
    }
    return self::$_instance;
  }
  
  /**
   * Constructor.
   */
  public function __construct($host, $username, $password,  $database, $dbtype = "mysqli") {

  	$this->MYSQL_HOST = $host;
  	$this->MYSQL_LOGIN = $username;
  	$this->MYSQL_PASS = $password;
  	$this->MYSQL_DB = $database;
  	$this->dbtype = $dbtype;
  	
  	if (strtolower(trim($dbtype)) == "mysqli")
  	{	
	    $this->_connection = new mysqli($host, $username, $password, $database);
	    if (mysqli_connect_error()) {
	      trigger_error('Failed to connect to MySQL: ' . mysqli_connect_error(), E_USER_ERROR);
	    }
  	}
  	else {
  		$this->_connection= mysql_connect($host, $username, $password);
  		mysql_select_db($database, $this->_connection);
  		if (mysql_error()) {
  			//	trigger_error('Failed to connect to MySQL: ' . mysqli_connect_error(), E_USER_ERROR);
  			trigger_error('Failed to connect to MySQL: ' . mysql_error(), E_USER_ERROR);
  		}
  	}
  }
  
  /**
   * Empty clone magic method to prevent duplication. 
   */
  private function __clone() {}
  
  /**
   * Get the mysqli connection. 
   */
  public function getConnection() {
    return $this->_connection;
  }
  
  public function runQuery($sql){
  	if ($this->dbtype == "mysqli")
  	{
  		$result = mysqli_query($this->_connection, $sql);
  		
  	}
  	else {
  		$result = mysql_query($sql);
  	}
  	return $result;		
  			
  }
  
  
  public function runFetchAssoc($sql)
  {
  	
  	if ($this->dbtype == "mysqli")
  	{
  		$result = mysqli_fetch_assoc($sql);
  		
  	}
  	else {
  		$result = mysql_fetch_assoc($sql);
  	}
  	return $result;
  	
  }
  
}