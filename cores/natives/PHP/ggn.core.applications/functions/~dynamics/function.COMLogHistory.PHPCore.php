<?php

	$return = false;
	

if(is_object($context) && isset($context->Infos) && is_object($context->Infos)){


	/* Parametre */
	$s = isset($args[0]) ? $args[0]: 0;
	$e = isset($args[1]) ? $args[1]: false;
	$o = isset($args[2]) ? $args[2]: false;




	/* Fichier log de l'application */
	$f = $context->COMLogFile();
	

	if(!is_file($f)){
		$return = [];
	}
		
	else{

		/* Stockage */
		$d = [];
		$r = 0;




		/* Rangement dans un tableau */
		foreach(file($f) as $line) {
		   $d[count($d)] = @json_decode($line, GStorages::JSON_OPT());
		}

		$r = count($d);
		// $r -= 1;

		/* Par ordre Croissant */
		if($o==false){
			
		}

		if($o==true){
			$d = array_reverse($d);
		}



		
		$d0 = [];

		$e= ($e===false) ? $r : $e;

		for ($i=$s; $i < $r; $i++) { 
			$k = count($d0);

			if($i<$e){
				if(isset($d[$i])){
					$d0[$k] = $d[$i];
				}
			}
			else{
				break;
			}

		}

		$d=$d0;


		/* Par ordre Decroissant */
		// if($o==true){

		// 	$d0 = [];

		// 	$e = ($e===false) ? $s : abs($r-$e);

		// 	$c=0;

		// 	for ($i=$r; $i >= $s; $i--) { 
		// 		$k = count($d0);

		// 		if($i>$e){
		// 			if(isset($d[$i])){
		// 				$d0[$k] = $d[$i];
		// 				$c++;
		// 			}
		// 		}
		// 		else{
		// 			break;
		// 		}

		// 	}


		// 	$d=$d0;


		// }


		/* Retour */
		$return = $d;

	}



}



?>