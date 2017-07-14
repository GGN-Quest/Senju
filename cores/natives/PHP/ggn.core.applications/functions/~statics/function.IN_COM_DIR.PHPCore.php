<?php

	$return = false;
	
	if(isset($args[0])){

		$appKey = $args[0];

		$dir = __CORES_SYSTEM_COM_VENDOR__ . 'apps/' . $appKey . '/';

		if(is_dir($dir)){
			
			$return = $dir;

		}




	}



?>