<?php 
	$return = FALSE;
	$string = trim(" " . $args[0] . " "); 
	if(in_array(substr($string, -1), array('0', '2', '4', '6', '8')) ):
		$return = TRUE; 
		endif; 
	return $return;

?>