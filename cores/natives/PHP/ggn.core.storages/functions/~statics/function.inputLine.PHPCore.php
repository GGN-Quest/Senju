<?php

	$return = false;

	if(isset($args)){
		$value = (isset($args[0]))?$args[0]:'';
		$column = (isset($args[1]))?((is_array($args[1]))?$args[1]:false):false;



		if(is_array($column) && is_array($value)){
			$output = "";
			$count = 0;

			if(count($value)>0){
				// $output .= "\n";
				foreach ($column as $tblk => $tbln) {
					$output .= '$' . self::DVAR . '["data"]["'.$tbln.'"][]=\''.self::inputEncoder($value[$count]).'\';';
					$count++;
				}
			}

			$return = $output;
		}
		else{
			$return = '$' . self::DVAR . '["data"][]=\''.self::inputEncoder($value).'\';';
		}



	}

?>