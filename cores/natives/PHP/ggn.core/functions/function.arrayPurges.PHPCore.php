<?php 

	
	$r=[];

	$array = $args[0];

	$empty = (isset($args[1])) ? $args[1] : false;

	$new = [];

	foreach ($array as $key => $value) {

		if($empty === true && empty($value)){continue;}

		if(!in_array($value, $new)){

			array_push($new, $value);

		}
		
	}
		
	return $new;

?>