<?php


	spl_autoload_register(function($class){
		$filename = include dirname(__DIR__) . "\\" .$class. ".php";
	});