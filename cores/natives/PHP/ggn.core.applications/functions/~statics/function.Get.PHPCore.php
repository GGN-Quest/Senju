<?php

	$return = false;
	
	if(isset($args[0])){

		$appKey = $args[0];

		$manifest = self::IN_COM_DIR($appKey) . '.manifest';


		if(is_file($manifest)){
			
			$return = json_decode(file_get_contents($manifest));

		}




	}



?>