<?php
/*
	Copyright GOBOU Y. Yannick
	
*/

namespace GGN\System\xCMD;

	
global $database, $_Gougnon, $GRegister;



new \GGN\Using('Apps');

new \GGN\Using('Apps\Service');



if(!class_exists('GGN_APP_CMD')){


	/*

		GGN Apps Commands

	*/

	class GGN_APP_CMD extends Attributes implements Format {


		const NAME = 'GGN Apps';

		const VERSION = '0.0.170122.1930';


		
		var $args = [];


		function __construct(){

			global $GRegister;

			$this->args = func_get_args();

		}




		/* Applicateur de Commande / DEBUT */

			public function Apply($cmd = ""){

				global $GRegister;


				$R = [];

				// $C = explode(" ", $cmd);

				$C = Utility::Concatenate($cmd);


				switch (strtolower($C[0])) {











					case '-service':

						$Do = isset($C[1]) && is_string($C[1]) ? strtolower($C[1]) : false;


						/* Tache : Installation / DEBUT */
						
							if(is_string($Do)){

								if($Do == '-add.token'){

									$Name = isset($C[2]) && is_string($C[2]) ? Utility::StripExQuotes($C[2]) : false;

									$Ukey = isset($C[3]) && is_string($C[3]) ? (($C[3]=='-current') ? $GRegister->USER['UKEY'] : Utility::StripExQuotes($C[3])) : false;

									$AppKey = isset($C[4]) && is_string($C[4]) ? Utility::StripExQuotes($C[4]) : false;

										$AppKey = ($AppKey == 'false') ? false : (($AppKey == 'true') ? true : $AppKey);
										

									$SKey = isset($C[5]) && is_string($C[5]) ? Utility::StripExQuotes($C[5]) : false;

										$SKey = ($SKey == 'false') ? false : (($SKey == 'true') ? true : $SKey);


									$Login = isset($C[6]) && is_string($C[6]) ? (($C[6] == 'true') ? true : false) : false;

									$Expire = isset($C[7]) && is_numeric($C[7]) ? ($C[7]*1) : false;


									if(is_string($Name)){

										$Create = \GGN\Apps\Service\ClientToken::Create(

											$Name

											, $Ukey

											, $AppKey

											, $SKey

											, $Login

											, $Expire

										);


										if($Create){

											$R[] = '__Graph:Icn:Ok__ Jeton d\'accès ajouté avec succès';

											$R[] = 'Clé : [ ' . $Create['Name'] . ' ]';

										}

										else{

											$R[] = '__Graph:Icn:Warning__ Echec de la création du Jeton d\'accès';

										}



									}

									else{

										$R[] = '__Graph:Icn:Error__ Erreur lors de la création du Jeton d\'accès';


									}

									

								}

							}

						/* Tache : Installation / FIN */


						/* Auncune tache precisé / DEBUT */

							else{

								$R[] = 'Aucune tâche indiquée';

							}

						/* Auncune tache precisé / FIN */


						
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