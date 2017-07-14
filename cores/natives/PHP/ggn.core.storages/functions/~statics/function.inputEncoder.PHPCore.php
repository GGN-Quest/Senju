<?php

	$return = false;

	if(isset($args)){
		$value = (isset($args[0]))?$args[0]:'';
		$return = json_encode($value, self::JSON_OPT());

	}
	
?>