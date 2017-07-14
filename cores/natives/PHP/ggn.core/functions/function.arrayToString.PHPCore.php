<?php 
/*
	<phpcore name="arrayToString">
		liste le contenu d'un tableau PHP
	</phpcore>
*/
	
	$r='';
	$array = $args[0];
	$input = (isset($args[1]))?$args[1]:'';
	$output = (isset($args[2]))?$args[2]:'';
	
	foreach($array as $name => $value){
		$r .= $input . $array[$name] . $output;
	}
		
	return $r;

?>