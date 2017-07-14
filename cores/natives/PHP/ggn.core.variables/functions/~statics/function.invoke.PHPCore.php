<?php
	
	$return = false;


	if(isset($args)){
		$name = (isset($args[0]))?$args[0]:false;
		$path = (isset($args[1]))?$args[1]:self::getVarsPath();


		$data = GStorages::load($name, $path);

		if(is_array($data)){
			$return = $data;
		}

	}



?>