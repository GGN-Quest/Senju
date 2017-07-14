<?php
/*
	Copyright GOBOU Y. Yannick
	
*/

namespace GGN\System\xCMD;

	
global $database, $_Gougnon, $GRegister;




if(!class_exists('GGN_GPK_CMD')){


	/*

		GGN Wizard Commands

	*/

	class GGN_GPK_CMD extends Attributes implements Format {


		const NAME = 'GGN Package';

		const VERSION = '0.0.170122.1930';


		
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











					case 'set':

						$Do = isset($C[1]) && is_string($C[1]) ? strtolower($C[1]) : false;


						/* Tache : Installation / DEBUT */
						
							if(is_string($Do)){


								$AppKey = isset($C[2]) && is_string($C[2]) ? Utility::StripExQuotes($C[2]) : false;



								if($Do == 'upgrade'){

									/* Opération / DEBUT */

										if(is_string($AppKey)){

											$AppType = isset($C[3]) && is_string($C[3]) ? Utility::StripExQuotes($C[3]) : false;

											if(is_string($AppType)){

												$AppVersion = isset($C[4]) && is_string($C[4]) ? Utility::StripExQuotes($C[4]) : 'latest';

												$Server = isset($C[5]) && is_string($C[5]) ? Utility::StripExQuotes($C[5]) : false;
												

												$this

													->OccupiesTheInstance()

														->FollowUpStart()

															->Cmd('set uninstall "' . $AppKey . '" "' . $AppType . '"')

															->Cmd('get install "$0" "' . $AppVersion . '" "' . $Server . '"')

															// ->Cmd('get install "' . $AppKey . '" "' . $AppVersion . '" "' . $Server . '"')

														->FollowUpStop()

													->Cmd('instance:free')

												;

											}

											else{

												$this->Input([

													'label' => 'Type du Package'

													,'type' => 'text'

													,'placeholder' => ''

												]);

											}

										}

										else{

											$this->Input([

												'label' => 'Nom du Package'

												,'type' => 'text'

												,'placeholder' => ''

											]);

										}

									/* Opération / FIN */
									
								}



								else if($Do == 'uninstall'){

									/* Opération / DEBUT */

										if(is_string($AppKey)){

											$AppType = isset($C[3]) && is_string($C[3]) ? Utility::StripExQuotes($C[3]) : false;

											if(is_string($AppType)){

												$this

													->OccupiesTheInstance()

													->Sequence([

														'type' => 'uninstall/gpk'

														, 'name' => $AppKey

														, 'appType' => $AppType

													])
													
												;

											}

											else{

												$this->Input([

													'label' => 'Type du Package'

													,'type' => 'text'

													,'placeholder' => ''

												]);

											}

										}

										else{

											$this->Input([

												'label' => 'Nom du Package'

												,'type' => 'text'

												,'placeholder' => ''

											]);

										}

									/* Opération / FIN */
									
								}




								else{

									$R[] = 'Aucune tâche';

								}
									

							}

						/* Tache : Installation / FIN */


						/* Auncune tache precisé / DEBUT */

							else{

								$R[] = 'Aucune tâche indiquée';

							}

						/* Auncune tache precisé / FIN */


						
					break;











					case 'check':

						$Do = isset($C[1]) && is_string($C[1]) ? strtolower($C[1]) : false;


						/* Tache : Installation / DEBUT */
						
							if(is_string($Do)){


								$AppKey = isset($C[2]) && is_string($C[2]) ? Utility::StripExQuotes($C[2]) : false;



								if($Do == 'update'){

									/* Opération / DEBUT */

										if(is_string($AppKey)){

											$AppType = isset($C[3]) && is_string($C[3]) ? Utility::StripExQuotes($C[3]) : false;

											if(is_string($AppType)){

												$this

													// ->OccupiesTheInstance()


													// 	->FollowUpStart()

													// 		// ->Sequence([

													// 		// 	'type' => 'check.update/gpk'

													// 		// 	, 'name' => $AppKey

													// 		// 	, 'appType' => $AppType

													// 		// ])

													// 	// ->Cmd('interface:close')

													// 	// ->Cmd('interface:open')

													// 	->FollowUpStop()
															

													// ->Cmd('instance:free')
												;

											}

											else{

												$this->Input([

													'label' => 'Type du Package'

													,'type' => 'text'

													,'placeholder' => ''

												]);

											}

										}

										else{

											$this->Input([

												'label' => 'Nom du Package'

												,'type' => 'text'

												,'placeholder' => ''

											]);

										}

									/* Opération / FIN */
									
								}




								else{

									$R[] = 'Aucune tâche';

								}
									

							}

						/* Tache : Installation / FIN */


						/* Auncune tache precisé / DEBUT */

							else{

								$R[] = 'Aucune tâche indiquée';

							}

						/* Auncune tache precisé / FIN */


						
					break;












					case 'get':

						$Do = isset($C[1]) && is_string($C[1]) ? strtolower($C[1]) : false;


						/* Tache : Installation / DEBUT */
						
							if(is_string($Do)){


								$AppKey = isset($C[2]) && is_string($C[2]) ? Utility::StripExQuotes($C[2]) : false;

								$AppVersion = isset($C[3]) && is_string($C[3]) ? Utility::StripExQuotes($C[3]) : 'latest';

								$Server = isset($C[4]) && is_string($C[4]) ? Utility::StripExQuotes($C[4]) : false;


								if($Do == 'install' || $Do == 'download'){

									/* Clé du Package / DEBUT */

										if(is_string($AppKey)){

											$this

												->OccupiesTheInstance()

												->Sequence([

													'type' => 'download:install/gpk'

													, 'key' => $AppKey

													, 'version' => $AppVersion

													, 'server' => $Server

													, 'downloadOnly' => ($Do == 'download') ? true : false

												])
												
											;

										}

										else{

											$this->Input([

												'label' => 'Nom du Package'

												,'type' => 'text'

												,'placeholder' => ''

											]);

										}

									/* Clé du Package / FIN */
									
								}

								else{

									$R[] = 'Aucune tâche';

								}
									

							}

						/* Tache : Installation / FIN */


						/* Auncune tache precisé / DEBUT */

							else{

								$R[] = 'Aucune tâche indiquée';

							}

						/* Auncune tache precisé / FIN */


						
					break;



















					case 'create':
						
						$Do = isset($C[1]) && is_string($C[1]) ? strtolower($C[1]) : false;

						$name = isset($C[2]) && is_string($C[2]) ? strtolower($C[2]) : false;

						$type = isset($C[3]) && is_string($C[3]) ? strtolower($C[3]) : false;

						$paths = isset($C[4]) && is_string($C[4]) ? strtolower($C[4]) : "";

						$sources = isset($C[5]) && is_string($C[5]) ? strtolower($C[5]) : "";

						$tables = isset($C[6]) && is_string($C[6]) ? strtolower($C[6]) : false;

						$version = isset($C[7]) && is_string($C[7]) ? strtolower($C[7]) : '';

						$date = isset($C[8]) && is_string($C[8]) ? strtolower($C[8]) : false;


						/* Créer un nouveau package ou une mise a jour / DEBUT */

							if(

								is_string($Do)

								&& is_string($name)

								&& is_string($type)

								&& is_string($paths)

							){

								$Do = ($Do == 'new') ? 'create' : $Do;

								$this

									->OccupiesTheInstance()

									->Sequence([

										'type' => 'create/gpk'

										, 'Do' => $Do

										, 'name' => Utility::StripExQuotes($name)

										, 'ptype' => Utility::StripExQuotes($type)

										, 'paths' => Utility::StripExQuotes($paths)

										, 'sources' => Utility::StripExQuotes($sources)

										, 'version' => Utility::StripExQuotes($version)

										, 'tables' => Utility::StripExQuotes($tables)

										, 'date' => Utility::StripExQuotes($date)

									])
									
								;

							}

						/* Créer un nouveau package ou une mise a jour / FIN */



						/* Auncune tache precisé / DEBUT */

							else{

								$R[] = 'Paramètres manquants. Essayez cette syntaxe ("create ou update..." "nom" "type" "chemins" "sources" "date(Année-Mois-Jour.Heure:Minute:Seconde)")';

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