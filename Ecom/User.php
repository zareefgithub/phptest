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

			$serializeData 	= $this->serializeData();
			$checkEmail 	= $this->checkEmail();
		
			if($checkEmail[0] != 1)
			{
				$errors[] = $checkEmail[0];
			} else {
				if(!$serializeData[0] == 1)
				{
					$errors[] = 1;
				} else {
					foreach ($serializeData as $key => $value) {
						$errors[] = $value;
					}
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

	private function checkEmail()
	{
		$errors = array();

		if(!empty(trim($this->email)) == true)
		{

			$query = $this->db->query('SELECT * FROM user WHERE `email` = "'.$this->email.'" ');
	
			if($this->db->affectedRows($query) >= 1){
				$errors[] = 'That email is already taken!';
			} else {
				$errors[] = 1;
			}
		}

		return $errors;
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
	public function getNameById($id)
	{
		$errors = array();

		if(!empty(trim($id))) 
		{
			$id 	= $this->db->escapeString($id);
			$query 	= $this->db->query('SELECT `name` FROM `user` WHERE `user_id` = '.$id.'');
			$result = $this->db->fetchAssoc($query);
			
			return $result['name'];
		}	

		return $errors;
	}
}