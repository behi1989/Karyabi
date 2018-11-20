<?php
error_reporting(0);

class DB{
	public $connection;
	public $host;
	public $username;
	public $password;
	public $dbname;
	public $dsn;
	
	public function __construct(){
		if ($this->connection == NULL && !is_resource($this->connection)) {
			$this->host	= HOST;
			$this->username = USER;
			$this->password = PASS;
			$this->dbname = NAME;
			$this->dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname . ';';
			//SET OPTION
			$options = array(
				PDO::ATTR_PERSISTENT => true,
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
				PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'utf8\''
			);
			try {
				$this->connection = new PDO($this->dsn, $this->username, $this->password, $options);
			} catch (PDOException $err){
				$this->connection = NULL;
				echo '<pre>';
				print_r($err);
				echo '</pre>';
				die();
			}
		}
	}
	
	public function connect(){
		return($this->connection);
	}
}

?>