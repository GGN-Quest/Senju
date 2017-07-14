<?php
	
	$str = trim(" " . $args[0] . " ");
	$ne = $args[1] - strlen($str);
	$ze = '';
	
	for($x=1; $x<=$ne; $x++){
		$ze = $ze . '0';
		}
	
	return $ze.$str; 

?>