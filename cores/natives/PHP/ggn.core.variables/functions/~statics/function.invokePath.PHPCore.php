<?php
	
	$return = false;


	if(isset($args)){

		$path = (isset($args[0]))?$args[0]:self::getVarsPath();

		$path = (is_string($path))?$path:self::getVarsPath();

		$type = (isset($args[1]))?$args[1]:false;

		$nonly = (isset($args[2]))?$args[2]:false;

		$return = GStorages::loadPath($path, $type, $nonly);

	}



?>