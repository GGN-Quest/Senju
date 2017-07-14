<?php
	
	$return = false;


	if(isset($args)){

		$data = (isset($args[0]))?$args[0]:false;

		$key = (isset($args[1]))?$args[1]:false;

		$name = (isset($args[2]))?$args[2]:false;
		
		$path = (isset($args[3]))?$args[3]:self::getVarsPath();

		$return = GStorages::update($data, $key, $name, $path);


	}



?>