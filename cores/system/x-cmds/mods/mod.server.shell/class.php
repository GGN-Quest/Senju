<?php
/*
	Copyright GOBOU Y. Yannick
	
*/


	
global $database, $_Gougnon, $GRegister;




if(!class_exists('SERVER_EXEC')){


	/*

		Execution des commande du Server

	*/



	class SERVER_EXEC implements GGN\System\xCMD\Format {


		const NAME = 'Server Shell';

		const VERSION = '0.0.160812.1528';


		
		var $args = [];


		function __construct(){

			global $GRegister;

			$this->args = func_get_args();
			
		}




		/* Applicateur de Commande / DEBUT */

			public function Apply($cmd = false){

				$R = [];

				$cmd = ltrim(rtrim($cmd));

				if(is_string($cmd) && !\Gougnon::isEmpty($cmd)){


					ini_set('max_input_time', 300);

					ini_set('max_execution_time', 300);

					ini_set("memory_limit", \_GGN::varn('MEMORY_LIMIT') );


					$Output = [];

					exec($cmd, $Output);

					foreach ($Output as $key => $value) {
						
						$R[] = utf8_decode($value);

					}

					
				}


				return $R;

			}

		/* Applicateur de Commande / FIN */






		/* Aide / Debut */

			public function Help($section = false){



			}


		/* Aide / FIN */





	}


}





?>