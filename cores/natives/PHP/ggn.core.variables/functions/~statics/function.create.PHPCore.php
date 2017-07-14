<?php
	
	$return = false;


	if(isset($args)&&class_exists('GStorages')){
		
		$name = (isset($args[0]))?$args[0]:false;
		
		$data = (isset($args[1]))?$args[1]:'';
		
		$column = (isset($args[2]))?$args[2]:false;

			$column = (is_array($column)) ? $column : self::getVarsColumn();
		
		$path = (isset($args[3]))?$args[3]:self::getVarsPath();
		

		if(GStorages::create($name, $path, $column)){
		
			$return = GStorages::insert($data, $name, $path);

			/* Laligne de callback pour reinitialisation / DEBUT */

				GStorages::insert($data, $name, $path);

			/* Laligne de callback pour reinitialisation / FIN */

		
		}

	}



?>