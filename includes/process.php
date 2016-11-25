<?php require_once __DIR__ .'\autoload.php'; ?>
<?php 
	use Ecom\Database as db;
	use Ecom\User as user;

	$db = new db();

	if(isset($_POST['submit'])){
		
		$name 		= $_POST['name'];
		$email 		= $_POST['email'];
		$password 	= $_POST['password'];
		$phone 		= $_POST['phone'];

		$user 		= new user($name, $email, $password, $phone);
		
		$user->loginUser($name,$email,$password,$phone);
	}	