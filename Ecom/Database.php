<?php 
	namespace Ecom;
	include 'db.php';

	class Database
	{
		
		private $connection;
		
		public function __construct(){
				$this->openConnection();
		}	
		public function openConnection(){
			$this->connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME) or die(mysqli_error($this->connection));
			if (!$this->connection) {
			die("Failed to connect to MySQL:");
			}
		}
		public function closeConnection(){
			if(isset($this->connection)){
				mysqli_close($this->connection);
				unset($this->connection);	
			}	
		}
		public function query($sql){
			$result = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));
			$this->confirm_query($result);
			return $result;
		}

		public function fetchAssoc($resultSet){
			return mysqli_fetch_assoc($resultSet);
		}
		
		public function numRows($resultSet){
			return mysqli_num_rows($resultSet);	
		}

		public function fetchRows($resultSet){
			return mysqli_fetch_row($resultSet);	
		}
		
		public function affectedRows($resultSet){
			return mysqli_affected_rows($this->connection);	
		}
		public function escapeString($string){
			return mysqli_escape_string($this->connection, $string);
		}
		
		private function confirm_query($resultSet){
			if(!$resultSet){
				die('There was some error performing query ' .mysqli_error($this->connection));	
			}
		}

		public function fetchId()
		{
			return mysqli_insert_id($this->connection);
		}
	}
	
	
?>
