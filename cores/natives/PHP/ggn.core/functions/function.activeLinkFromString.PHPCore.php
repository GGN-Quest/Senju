<?php
	
	$in = $args[0];
	$input = explode(' ', $in);
	$output = [];


	foreach ($input as $k => $d) {
		$g = preg_match_all(_GGN::PATTERN_URL, $d);


		if($g==true){
			$prot = explode('://', $d);


			if(isset($prot[1])){
				array_push($output, "<a href=\"".$d."\">".$d."</a>");
			}

			else{
				array_push($output, "<a href=\"http://".$d."\">".$d."</a>");
			}

		}

		else{
			array_push($output, $d);
		}

	}


	return implode(' ', $output);
	
?>