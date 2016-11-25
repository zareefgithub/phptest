<?php

namespace Ecom;
use Ecom\Database as db;

class Products {

	public function __construct()
	{	
		$this->db = new db();
	}

	public function getAllProducts(){
		$errors = array();
		$product  = array();

		$query 	= $this->db->query('SELECT * FROM products');
		while($result = $this->db->fetchAssoc($query)){
			 $products = $result['p_name'] . '<br>';
		}
	}

}