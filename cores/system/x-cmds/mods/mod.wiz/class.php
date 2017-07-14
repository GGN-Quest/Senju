<?php
/*
	Copyright GOBOU Y. Yannick
	
*/

namespace GGN\System\xCMD;

	
global $database, $_Gougnon, $GRegister;




if(!class_exists('GGN_WIZARD_CMD')){


	/*

		GGN Wizard Commands

	*/

	class GGN_WIZARD_CMD extends Attributes implements Format {


		const NAME = 'GGN Wizard';

		const VERSION = '0.0.160902.1805';


		
		var $args = [];


		function __construct(){

			global $GRegister;

			$this->args = func_get_args();

		}




		/* Applicateur de Commande / DEBUT */

			public function Apply($cmd = ""){

				$R = [];

				// $C = explode(" ", $cmd);

				$C = Utility::Concatenate($cmd);


				switch (strtolower($C[0])) {











					case 'update':

						$Do = isset($C[1]) && is_string($C[1]) ? strtolower($C[1]) : false;


						if($Do == 'check'){

							$R[] = 'Verifier mise à jour...';

						}


						else if($Do == 'get'){

							$R[] = 'Obtenir une mise à jour...';

						}


						else if($Do == 'install'){

							$R[] = 'Installer une mise à jour...';

						}

						else{

							$R[] = 'Aucune tâche indiquée';

						}

						
					break;












					
					default:

						$R[] = self::ApplyDefaultReturn($cmd);

						
					break;

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