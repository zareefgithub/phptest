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

	public function checkDetails()
	{
		$errors = array();

		if(empty($this->username) || empty($this->email) || empty($this->password) || empty($this->phone)){
			$errors[] = 'Please fill in some details';
		} else {

			$serializeData = $this->serializeData();
			if($serializeData[0] == 1)
			{
				$errors[] = 1;
			} else {
				foreach ($serializeData as $key => $value) {
					$errors[] = $value;
				}
			}
		}

		return $errors;
	}

	private function serializeData()
	{
		$errors = array();

		if(!empty(trim($this->username)) && !empty(trim($this->email)) && !empty(trim($this->password)) && !empty(trim($this->phone)))
		{
			if(!filter_var($this->email, FILTER_VALIDATE_EMAIL))
			{
				$errors[] = 'Please enter a valid Email Address!';
			}

			if(strlen($this->username) > 40) 
			{
				$errors[] = 'Name too long!';
			}

			if(!ctype_digit($this->phone))
			{
				$errors[] = 'Please enter a valid Phone!';
			}

			if(strlen($this->password) > 40)
			{
				$errors[] = 'Password Too Long!';
			}

			if(empty($errors))
			{
				$errors[] = 1;
			} 
		}

		return $errors;
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
}