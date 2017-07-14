<?php

	/**
	 * GGN Numeric Invoke
	 *
	 * @version 0.1 
	 * @update 150814.1321
	 * @Require Gougnon Framework
	*/



/*
	Nom de l'espace
*/
namespace GGN\Numeric;
	
	





	/* Using */
	if(!class_exists('\GGN\Numeric\Using')){
		Class Using{
			public function __construct($ns){ $this->object = clone new \GGN\Using($ns); }
		} 
	}








	if(!class_exists('\GGN\Numeric\Invoke')){

		/*
			Invoke
		*/
		Class Invoke{



		} // Class Invoke


	} // if class_exists 'Invoke'













	if(!class_exists('\GGN\Numeric\Unit')){

		/*
			Unit
		*/
		Class Unit extends Invoke{

			Const PAL = 1024;

			public function __construct($Size, $round = 0){

				$sz=$Size;
			
				$c=0;
			
				$v=true;
			
				$rest=0;
			
				$a='';


				while($sz>self::PAL){

					$sz=$sz/self::PAL;

					$rest=fmod($sz,self::PAL);

					$c++;

				}


				$u = self::GetUnitName($c);

				$this->Unity = $u;

				$this->Value = (($c>0)? round($rest, $round) : $sz);

				$this->Label = $this->Value . ' ' . $u;


			}


			public static function GetUnitName($c){

				switch ($c) {

					case 1: $u='K'; break;

					case 2: $u='M'; break;

					case 3: $u='G'; break;

					case 4: $u='T'; break;

					case 5: $u='P'; break;
					
					default: $u=''; break;

				}

				return $u;
			}


		} // Class Unit


	} // if class_exists 'Unit'









				








?>