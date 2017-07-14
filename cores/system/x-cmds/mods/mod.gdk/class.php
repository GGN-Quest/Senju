<?php
/*
	Copyright GOBOU Y. Yannick
	
*/

namespace GGN\System\xCMD;

	
global $database, $_Gougnon, $GRegister;



new \GGN\Using('GDK');



if(!class_exists('GGN_APP_CMD')){


	/*

		GGN GDK Commands

	*/

	class GDK_CMD extends Attributes implements Format {


		const NAME = 'GGN Development Kit (Lite)';

		const VERSION = '0.0.170701.1341';


		
		var $args = [];


		function __construct(){

			global $GRegister;

			$this->args = func_get_args();

		}




		/* Applicateur de Commande / DEBUT */

			public function Apply($cmd = ""){

				global $GRegister;


				$R = [];

				$C = Utility::Concatenate($cmd);

				$C0 = (isset($C[0])) ? $C[0] : false;


				switch (strtolower($C0)) {



					case '-format':

						$Do = isset($C[1]) && is_string($C[1]) ? strtolower($C[1]) : false;


						/* Tache : Installation / DEBUT */
						
							if(is_string($Do)){


								/* Formater le Boot.GGN / DEBUT */

									if($Do == '-boot.ggn'){

										$Type = isset($C[2]) && is_string($C[2]) ? Utility::StripExQuotes($C[2]) : '-full';

										$Create = \GGN\GDK\Packages::Format('boot.ggn', $Type);


										$R[] = 'Chargement des distributeurs...';

										if($Create === TRUE){

											$R[] = 'Distributeurs ajoutés';

											$R[] = '__Graph:Icn:Ok__ Formatage du Package effectué avec succès';

										}

										else{

											$R[] = '__Graph:Icn:Error__ Erreur lors du formatage du package';


										}

										

									}

								/* Formater le Boot.GGN / FIN */



								/* Sinon / DEBUT */

									else{

										$R[] = '__Graph:Icn:Warning__ Aucune tâche indiquée';

									}

								/* Sinon / FIN */


							}

						/* Tache : Installation / FIN */


						/* Auncune tache precisé / DEBUT */

							else{

								$R[] = 'Aucune tâche indiquée';

							}

						/* Auncune tache precisé / FIN */


						
					break;













					
					case '-create':

						$Do = isset($C[1]) && is_string($C[1]) ? strtolower($C[1]) : false;


						/* Tache : Installation / DEBUT */
						
							if(is_string($Do)){





								/* Créer un Boot.GGN / DEBUT */

									if($Do == '-boot.ggn'){

										$Type = isset($C[2]) && is_string($C[2]) ? Utility::StripExQuotes($C[2]) : '-full';

										$Create = \GGN\GDK\Packages::Build('boot.ggn', $Type);


										$R[] = 'Début du traitement ...';

										if($Create === TRUE){

											$R[] = 'Empaquetage...';

											$R[] = '__Graph:Icn:Ok__ Package crée avec succès!';


											$this

												->OccupiesTheInstance()

													->FollowUpStart()

														->Cmd('gdk -format -boot.ggn ' . $Type)

													->FollowUpStop()

												->Cmd('instance:free')

											;



										}

										else{

											$R[] = '__Graph:Icn:Error__ Erreur lors de la création du package';

										}

									}

								/* Créer un Boot.GGN / FIN */





								/* Créer un fournisseur d'application / DEBUT */

									else if($Do == '-app:vendor'){

										$Name = isset($C[2]) && is_string($C[2]) ? Utility::StripExQuotes($C[2]) : false;

										$Create = new \GGN\GDK\Vendor('-app');


										$R[] = 'Début...';

										$R[] = 'Recheche des distributeurs dans le magazin...';

										if($Create->Initialize($Name) === TRUE){

											$R[] = 'Donnée disponible...';

											$R[] = 'Création du manifest et des fichiers d\'initialisation...';

											$R[] = '__Graph:Icn:Ok__ Fournisseur initialisé crée avec succès';

										}

										else{

											$R[] = '__Graph:Icn:Error__ Erreur lors de la création du package';

										}

									}

								/* Créer un fournisseur d'application / FIN */






								/* Sinon / DEBUT */

									else{

										$R[] = '__Graph:Icn:Warning__ Aucune tâche indiquée';

									}

								/* Sinon / FIN */



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