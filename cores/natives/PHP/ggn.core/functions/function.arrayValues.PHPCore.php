<?php 

	
	$r=[];

	$array = $args[0];

	$start = null;

	$stop = null;

	$rec = null;


	/* Depart */
	if(isset($args[1]) && isset($array[$args[1]]) ){
		
		$start = $array[$args[1]];
		
	}
	

	/* Arrivé */
	if(isset($args[2]) && isset($array[$args[2]])){
		
		$stop = $array[$args[2]];
		
	}

	
	foreach($array as $name => $value){


		if(is_string($start) || is_string($stop)){


			if($rec===null && $start == $value){

				$rec = true;

			}


			if($rec===true && $stop == $value){

				$rec = false;

			}


			if($rec === true){

				array_push($r, $value);
				
			}

		}


		else{

			// array_push($r, $value);

		}


	}
		
	return $r;

?>