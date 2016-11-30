	<?php require_once __DIR__ .'\includes\autoload.php'; ?>
	<?php session_start(); ?>
	<?php 
		 use Ecom\Products as products;
		 use Ecom\User as user;

		 $products = new products();
		 $user 	   = new user('','','','');	

		 $name 	   =  $user->getNameById($_SESSION['id']);

		 echo 'Welcome User : ' . $name . '<br>';

		 $name 	   = $user->username($name);

		 echo 'Name from Class ' . $name;

