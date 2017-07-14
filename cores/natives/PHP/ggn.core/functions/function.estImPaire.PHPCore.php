<?php 
	$return = FALSE;
	$string = trim(" " . $args[0] . " ");
	if(!in_array(substr($string, -1), array('1', '3', '5', '7', '9')) ):
		$return = TRUE; 
		endif;
	return $return;

?>