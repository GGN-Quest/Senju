<?php

	$return = false;
	
	if(isset($args[0])){

		$appKey = $args[0];

		$exec = self::IN_COM_DIR($appKey) . 'exec.php';

		if(is_file($exec)){
			
			$return = $exec;

		}




	}



?>