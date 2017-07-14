<?php
	
	$o = $args[0];
	$e = $args[1];
	$mode = (isset($args[2]))?$args[2]: false;
	
	if($mode===true){

		foreach($e as $k => $v){ 

			if(is_array($o)){

				$o[$k] = $v; 
				
			}

			if(is_object($o)){

				$o->{$k} = $v; 
				
			}

		}

	}

	else{

		foreach($e as $k => $v){ 

			if(is_array($o)){

				array_push($o, $v); 

			}
				

		}

	}
	
	return $o;
	
?>