<?php 
	
	$str = $args[0];

	$len = isset($args[1]) ? $args[1] : 1;
	
	$out = '';

	$ex = explode(',', implode(',', explode('\'', implode(',', explode(' ', $str) ) ) ) );


	foreach ($ex as $key => $value) {

		if($key < $len){

			$out .= substr($value, 0, 1);

		}
		
	}


	return $out;


?>