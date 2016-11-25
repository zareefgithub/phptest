	<?php require_once __DIR__ .'\includes\autoload.php'; ?>
	<?php session_start(); ?>
	<?php 
		 use Ecom\Products as products;

		 $products = new products();	


		 $products->getAllProducts();
