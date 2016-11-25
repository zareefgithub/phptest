<?php

namespace Ecom;
use Ecom\Database as db;

class User {

	public $username;
	public $email;
	public $password;
	public $phone;


	public function __construct($username, $email, $password, $phone)
	{	
		$this->username = $username;
		$this->email 	= $email;
		$this->password = $password;
		$this->phone	= $phone;
		$this->db = new db();
	}

	private function checkDetails(){
		$errors = array();
		if(empty($this->username) && empty($this->email) && empty($this->password) && empty($this->phone)){
			$errors[] = 'Please fill in some details';
			return $errors;
		}
	}

	public function checkUsername($username)
	{
		$error = array();
		if(!empty(trim($username)) == true)
		{

			$query = $this->db->query('SELECT count(*) FROM user WHERE `name` = "'.$username.'" ');
			print_r($query);
			if(!$this->db->affectedRows($query) > 0){
				$this->setErrors('Username not Found!');
				echo 'asd';
			} else {
				echo 'asda';
			}
		} else {
			echo "Username is empty!";
		}
	}

	public function checkPassword()
	{
		if(!empty(trim($this->password)) == true)
		{
			echo '<br> Password is '. $this->password;
		}
	}

	public function loginUser($username, $email, $password, $phone)
	{
		if(!empty(trim($username)) == true && !empty(trim($email)) && !empty(trim($password)) && !empty(trim($phone)))
		{
			// Perform SQL query and log user in
			$username 	= $this->db->escapeString($username);
			$email 		= $this->db->escapeString($email);
			$password 	= $this->db->escapeString($password);
			$phone 		= $this->db->escapeString($phone);

			$query = $this->db->query('INSERT into `user` (`name`, `email`, `password`, `phone`) VALUES ("'. $username .'", "'. $email.'", "'.																								$password.'", "'.$phone.'")');
			if($this->db->affectedRows($query)){
				session_start();
				$_SESSION['id'] = $this->db->fetchId();
				header("Location: /phptest/products.php");
			} else{
			
			}

		}
	}

	public function setErrors($errors)
	{
		if(!empty($errors) == true)
		{
			die($errors);
		}
	}
}