<?php
	
	$return = false;


	if(isset($args)){

		$order = (isset($args[0]))?$args[0]:false;
		$name = (isset($args[1]))?$args[1]:false;
		$path = (isset($args[2]))?$args[2]:self::getVarsPath();

		$return = GStorages::delete($order, $name, $path);

	}



?>