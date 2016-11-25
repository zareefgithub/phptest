	<?php require_once __DIR__ .'\includes\autoload.php'; ?>
	<?php session_start(); ?>
	<?php 
		 use Ecom\Products as products;

		 $products = new products();	

		 echo 'Welcome User : '. $username;
