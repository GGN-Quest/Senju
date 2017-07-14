<?php

	/**
	 * GGN String Invoke
	 *
	 * @version 0.1 
	 * @update 150814.1321
	 * @Require Gougnon Framework
	*/



/*
	Nom de l'espace
*/
namespace GGN\String;
	
	





	/* Using */
	if(!class_exists('\GGN\String\Using')){
		Class Using{
			public function __construct($ns){ $this->object = clone new \GGN\Using($ns); }
		} 
	}








	if(!class_exists('\GGN\String\Invoke')){

		/*
			Invoke
		*/
		Class Invoke{



		} // Class Invoke


	} // if class_exists 'Invoke'













	if(!class_exists('\GGN\String\Interval')){

		/*
			addInterval
		*/
		Class Interval extends Invoke{


			var $Return = false;
			

			public function __construct($string, $add = '', $interval = 1, $reverse = false){

				$rstring = ($reverse === true) ? strrev($string) : $string;

				$input = str_split($rstring);

				$output = [];

				$interval = abs(($interval == 0) ? 1 : $interval);

				$count = $interval;

				$interval++;


				foreach ($input as $k => $value) {

					if($count == $k){

						array_push($output, $add);

						$count += $interval;

					}

					array_push($output, $value);

				}


				$this->Return = implode('', ($reverse === true) ? array_reverse($output) : $output);

			}



		} // Class addInterval


	} // if class_exists 'addInterval'









				








?>