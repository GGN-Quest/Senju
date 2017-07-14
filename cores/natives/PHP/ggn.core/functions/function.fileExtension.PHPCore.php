<?php
	
	$f = basename($args[0]);
	
	// if(is_file($f)){
		$exp = explode('.', $f);
		$string = '.';
		$string .= $exp[ count($exp)-1 ];
		return $string;
		// }
		
	// else{return false;}
	
?>