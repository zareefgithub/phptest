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
		
		$userDetails = $user->checkDetails();

		//print_r($userDetails);
		if($userDetails[0] == 1){
			// There are no errors in Validation

			$user->loginUser($name,$email,$password,$phone);

		} else {
			print_r($userDetails);
		}
		//$user->loginUser($name,$email,$password,$phone);

	}	