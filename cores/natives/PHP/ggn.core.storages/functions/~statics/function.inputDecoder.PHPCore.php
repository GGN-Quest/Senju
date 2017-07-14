<?php

	$return = false;

	if(isset($args)){
		$value = (isset($args[0]))?$args[0]:'{}';
		$value = (is_string($value))?$value:'{}';
		$value = (Gougnon::isEmpty($value))?'{}':$value;

		$return = json_decode($value, self::JSON_OPT());

	}
	
?>