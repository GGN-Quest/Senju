<?php 
	
	$apis = $args;
	$ext = '.joins';
	$dir = __CORES_SYSTEM_JOINS__;
	$f = (isset($args[0]))?$args[0]:false;
	$c = (isset($args[1]))?$args[1]:false;


	if(is_string($f)&&is_string($c)){

		$file = $dir . $f . $ext;

		var_dump($file);

		if(!is_dir(dirname($file))){
			Gougnon::createFolders(dirname($file));
		}

		if(Gougnon::createFile($file, $c)){
			return true;
		}

	}

	return false;

?>