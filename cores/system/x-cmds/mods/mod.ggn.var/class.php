<?php
/*
	Copyright GOBOU Y. Yannick
	
*/

namespace GGN\System\xCMD;

	
global $database, $_Gougnon, $GRegister;

// $qsqxs


if(!class_exists('GGN_JUTSU_VAR_CMD')){


	/*

		GGN Wizard Commands

	*/

	class GGN_JUTSU_VAR_CMD extends Attributes implements Format {


		const NAME = 'GGN Jutsu Variable';

		const VERSION = '0.0.170701.1902';


		
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



				if(isset($C[0])){

					switch (strtolower($C[0])) {



						case 'reset':

							$R = \Gougnon::mergeArray($R, $this->ReSet($C));
							
						break;



						case 'remount':

							$R = \Gougnon::mergeArray($R, $this->ReMount($C));
							
						break;



						case 'set':

							$R = \Gougnon::mergeArray($R, $this->Set($C));
							
						break;




						case 'get':

							$R = \Gougnon::mergeArray($R, $this->Get($C));
							
						break;




						case 'create':

							$R = \Gougnon::mergeArray($R, $this->Create($C));
							
						break;



						
						default:

							$R[] = self::ApplyDefaultReturn($cmd);

							
						break;

					}



				}

				else{

					$R[] = self::ApplyDefaultReturn($cmd);

				}
				

				return $R;

			}

		/* Applicateur de Commande / FIN */











		/* Créer une nouvelle variable / Debut */

			public function Create($C){

				$R = [];

				$Name = isset($C[1]) && is_string($C[1]) ? ($C[1]) : false;

				/* Tache : Creation / DEBUT */

					if(is_string($Name)){

						if(isset($C[2]) && is_string($C[2]) ) {


							$Value = addslashes(Utility::StripExQuotes($C[2]));

							$Comment = (isset($C[3]) && is_string($C[3])) ? addslashes(Utility::StripExQuotes($C[3])) : '';


							$Get = \GVariables::invoke($Name, GSTORAGE_VARIABLE_INVOKE_NATIVES);

							if(is_array($Get)){

								$R[] = 'Cette variable exist déjà';

							}

							else{

								$Create = \GVariables::create($Name, \GVariables::Put($Value, $Comment), false, GSTORAGE_VARIABLE_INVOKE_NATIVES);

								if($Create){

									$R[] = '__Graph:Icn:Ok__ ' . $Name . ' a été créée avec succès';

								}

								else{

									$R[] = '__Graph:Icn:Error__ Echec lors de la création';

								}

							}


						}

						else{

							$this->Input([

								'label' => 'Veuillez indiquer la valeur de la nouvelle variable'

								,'type' => 'text'

								,'placeholder' => 'Valeur de la variable'

							]);	


						}


					}

				/* Tache : Creation / FIN */


				/* Auncune tache precisé / DEBUT */

					else{

						$R[] = 'Aucune variable indiquée';

					}

				/* Auncune tache precisé / FIN */



				return $R;

			}

		/* Créer une nouvelle variable / FIN */











		/* Obtenir une variable / Debut */

			public function Get($C){

				$R = [];


				$Name = isset($C[1]) && is_string($C[1]) ? ($C[1]) : false;


				/* Tache : Recherche / DEBUT */
				
					if(is_string($Name)){

						$Name = Utility::StripExQuotes($Name);

						if($Name != '::all' && $Name != '*'){

							$FamilyMode = substr_count($Name, '*') > 0;



							if($FamilyMode){

								$Pos = strpos($Name, "*");

								$Lim = strlen($Name) - 1;

								
								$Get = \GVariables::invokePath(GSTORAGE_VARIABLE_INVOKE_NATIVES, true, true);

								$Length = count($Get);


								if($Length > 0 ){

									if(isset($C[2]) && is_string($C[2])){


										/* Début de l'opération : Liste des variables / DEBUT */

											foreach ($Get as $PathName => $BaseName) {

												$SetCmd = false;


												/* Pour les Prefixes / DEBUT */
													
													if($Pos == $Lim){

														$_Start = substr($Name, 0, $Lim);

														$Start = substr($BaseName, 0, $Lim);

														if($Start == $_Start){

															$R[] = '<div handler-click="Terminal.Cmd" terminal-cmd="' . urlencode('set "' . $PathName . '"') . '"><b>' . $PathName . '</b> : ' . \_GGN::varn($PathName) . '</div>';

														}

													}

												/* Pour les Prefixes / FIN */


												/* Pour les Suffixes / DEBUT */

													if($Pos == 0){

														$_END = substr($Name, -1 * $Lim);

														$END = substr($BaseName, -1 * $Lim);

														if($END == $_END){

															$R[] = '<div handler-click="Terminal.Cmd" terminal-cmd="' . urlencode('set "' . $PathName . '"') . '"><b>' . $PathName . '</b> : ' . \_GGN::varn($PathName) . '</div>';

														}

													}

												/* Pour les Suffixes / FIN */

												
											}


										/* Début de l'opération : Liste des variables / FIN */

									}

									else{

										$this->Input([

											'label' => 'Veuillez indiquer le nom de la variable'

											,'type' => 'text'

											,'placeholder' => 'Nom de la variable'

										]);	


									}

								}

								else{

									$R[] = 'Aucune variable trouvée';

								}


							}

							else{

							
								$Get = \GVariables::invoke($Name, GSTORAGE_VARIABLE_INVOKE_NATIVES);

								if(is_array($Get)){

									$R[] = '<div handler-click="Terminal.Cmd" terminal-cmd="' . urlencode('set "' . $Name . '"') . '"><b>' . $Name . '</b> : ' . \_GGN::varn($Name) . '</div>';

								}
								
								else{

									$R[] = '__Graph:Icn:Error__ Variable introuvable';

								}

							}

						}


						else{


							if($Name == '::all' || $Name == '*'){

								$Get = \GVariables::invokePath(GSTORAGE_VARIABLE_INVOKE_NATIVES, true, true);

								$Length = count($Get);

								if($Length > 0){

									foreach ($Get as $PathName => $BaseName) {

										$R[] = '<div handler-click="Terminal.Cmd" terminal-cmd="' . urlencode('set "' . $PathName . '"') . '"><b>' . $PathName . '</b> : ' . \_GGN::varn($PathName) . '</div>';

									}

								}

								else{

									$R[] = 'Aucune variable installé';
									
								}


							}


							else{

								$R[] = '__Graph:Icn:Error__ Commande invalide';

							}


						}



					}

				/* Tache : Recherche / FIN */


				/* Auncune tache precisé / DEBUT */

					else{

						$R[] = 'Aucune variable indiquée';

					}

				/* Auncune tache precisé / FIN */


				return $R;

			}

		/* Obtenir une variable / FIN */











		/* Editer une variable / Debut */

			public function Set($C){

				$R = [];


				$Name = isset($C[1]) && is_string($C[1]) ? ($C[1]) : false;


				/* Traitement / DEBUT */
				
					if(is_string($Name)){


						$Name = Utility::StripExQuotes($Name);


						$FamilyMode = substr_count($Name, '*') > 0;


						if($FamilyMode){

							$Pos = strpos($Name, "*");

							$Lim = strlen($Name) - 1;

							
							$Get = \GVariables::invokePath(GSTORAGE_VARIABLE_INVOKE_NATIVES, true, true);

							$Length = count($Get);


							if($Length > 0 ){

								if(isset($C[2]) && is_string($C[2])){


									$NewValue = addslashes(Utility::StripExQuotes($C[2]));


									/* Début de l'opération : on occupe la console / DEBUT */

										$this->OccupiesTheInstance();

										$this->Cmd('console:write///|>');

										foreach ($Get as $PathName => $BaseName) {

											$SetCmd = false;


											/* Pour les Prefixes / DEBUT */
												
												if($Pos == $Lim){

													$_Start = substr($Name, 0, $Lim);

													$Start = substr($BaseName, 0, $Lim);

													if($Start == $_Start){

														$SetCmd = 'set "' . $PathName . '" "' . ($NewValue) . '"';

													}

												}

											/* Pour les Prefixes / FIN */


											/* Pour les Suffixes / DEBUT */

												if($Pos == 0){

													$_END = substr($Name, -1 * $Lim);

													$END = substr($BaseName, -1 * $Lim);

													if($END == $_END){

														$SetCmd = 'set "' . $PathName . '" "' . ($NewValue) . '"';

													}

												}

											/* Pour les Suffixes / FIN */


											/* Application de la commande / DEBUT */

												if(is_string($SetCmd)){

													
													$this->Cmd($SetCmd);


												}

											/* Application de la commande / FIN */



											
										}

										$this->Cmd('console:write///>|');

										$this->Cmd('instance:free');


									/* Début de l'opération : on occupe la console / FIN */

								}

								else{

									$this->Input([

										'label' => 'Veuillez indiquer une value'

										,'type' => 'text'

										,'placeholder' => 'Entrez la nouvelle valeur de la variable'

									]);	


								}

							}

							else{

								$R[] = 'Aucune variable trouvée';

							}


						}

						else{

							$Get = \GVariables::invoke($Name, GSTORAGE_VARIABLE_INVOKE_NATIVES);

							if(is_array($Get)){

								$Value = \_GGN::varn($Name);


								if(isset($C[2]) && is_string($C[2]) ){

									$NewValue = Utility::StripExQuotes($C[2]);


									$NewValue = ($NewValue == '::FASLE') ? false : $NewValue;

									$NewValue = ($NewValue == '::TRUE') ? true : $NewValue;

									$NewValue = (is_numeric($NewValue)) ? $NewValue * 1 : $NewValue;



									$Set = \GVariables::update([$NewValue], 0, $Name, GSTORAGE_VARIABLE_INVOKE_NATIVES);

									if($Set){

										$R[] = '__Graph:Icn:Ok__ <b>' . $Name . '</b> -> <b>' . $NewValue . '</b> mit à jour avec succès';
										
									}

									else{
										
										$R[] = '__Graph:Icn:Error__ Echec de l\'opération';										

									}
									

								}

								else{

									// $R[] = '__Graph:Icn:Error__ ';

									$this->Input([

										'label' => 'Veuillez indiquer une value'

										,'type' => 'text'

										,'placeholder' => 'Entrez une valeur'

									]);										

								}


							}

							else{

								$R[] = '__Graph:Icn:Error__ ' . $Name . ' introuvable';

							}

						}



					}

				/* Traitement / FIN */


				/* Auncune tache precisé / DEBUT */

					else{

						$R[] = 'Aucune variable indiquée';

					}

				/* Auncune tache precisé / FIN */


				return $R;

			}

		/* Editer une variable / FIN */











		/* Reinitialiser variable / Debut */

			public function ReSet($C){

				$R = [];


				$Name = isset($C[1]) && is_string($C[1]) ? ($C[1]) : false;


				/* Traitement / DEBUT */
				
					if(is_string($Name)){


						$Name = Utility::StripExQuotes($Name);


						$FamilyMode = substr_count($Name, '*') > 0;


						if($FamilyMode){

							$Pos = strpos($Name, "*");

							$Lim = strlen($Name) - 1;

							
							$Get = \GVariables::invokePath(GSTORAGE_VARIABLE_INVOKE_NATIVES, true, true);

							$Length = count($Get);


							if($Length > 0 ){


								/* Début de l'opération : on occupe la console / DEBUT */

									$this->OccupiesTheInstance();

									$this->Cmd('console:write///|>');

									foreach ($Get as $PathName => $BaseName) {

										$SetCmd = false;


										/* N'importe / DEBUT */

											if($Name == "*"){


												$SetCmd = 'reset "' . $PathName . '" ';

											}

										/* N'importe / FIN*/


										/* Family Pure / DEBUT */
											
											if($Name != "*"){

												/* Pour les Prefixes / DEBUT */
													
													if($Pos == $Lim){

														$_Start = substr($Name, 0, $Lim);

														$Start = substr($BaseName, 0, $Lim);

														if($Start == $_Start){

															$SetCmd = 'reset "' . $PathName . '" ';

														}

													}

												/* Pour les Prefixes / FIN */


												/* Pour les Suffixes / DEBUT */

													if($Pos == 0){

														$_END = substr($Name, -1 * $Lim);

														$END = substr($BaseName, -1 * $Lim);

														if($END == $_END){

															$SetCmd = 'reset "' . $PathName . '" ';

														}

													}

												/* Pour les Suffixes / FIN */



											}

										/* Family Pure / FIN */

										/* Application de la commande / DEBUT */

											if(is_string($SetCmd)){

												
												$this->Cmd($SetCmd);


											}

										/* Application de la commande / FIN */

									}

									$this->Cmd('console:write///>|');

									$this->Cmd('instance:free');

								/* Début de l'opération : on occupe la console / FIN */



							}

							else{

								$R[] = 'Aucune variable trouvée';

							}


						}

						else{

							$Get = \GVariables::invoke($Name, GSTORAGE_VARIABLE_INVOKE_NATIVES);

							if(is_array($Get)){


								if(isset($Get['data'][1]) && is_array($Get['data'][1])){

									$Data = $Get['data'][1];

									$Set = \GVariables::create($Name

										, [

											(isset($Data[0])) ? $Data[0] : null

											, (isset($Data[1]) && is_string($Data[1]) ) ? $Data[1] : false

											, (isset($Data[2]) && is_numeric($Data[2]) ) ? $Data[2] : time()

											, (isset($Data[3]) && is_numeric($Data[3]) ) ? $Data[3] : 1

										]

										, false

										, GSTORAGE_VARIABLE_INVOKE_NATIVES

									);

									if($Set){

										$R[] = '__Graph:Icn:Ok__ <b>' . $Name . '</b> -> <b>' . $Data[0] . '</b> réinitialiser avec succès';
										
									}

									else{
										
										$R[] = '__Graph:Icn:Error__ Echec de l\'opération';										

									}
									
								}

								else{

									$R[] = '__Graph:Icn:Error__ ' . $Name . ' non remontée';

								}


							}

							else{

								$R[] = '__Graph:Icn:Error__ ' . $Name . ' introuvable';

							}

						}



					}

				/* Traitement / FIN */


				/* Auncune tache precisé / DEBUT */

					else{

						$R[] = 'Aucune variable indiquée';

					}

				/* Auncune tache precisé / FIN */


				return $R;

			}

		/* Reinitialiser variable / FIN */











		/* Remonter une variable / Debut */

			public function ReMount($C){

				$R = [];


				$Name = isset($C[1]) && is_string($C[1]) ? ($C[1]) : false;


				/* Traitement / DEBUT */
				
					if(is_string($Name)){


						$Name = Utility::StripExQuotes($Name);


						$FamilyMode = substr_count($Name, '*') > 0;


						if($FamilyMode){

							$Pos = strpos($Name, "*");

							$Lim = strlen($Name) - 1;

							
							$Get = \GVariables::invokePath(GSTORAGE_VARIABLE_INVOKE_NATIVES, true, true);

							$Length = count($Get);


							if($Length > 0 ){


								/* Début de l'opération : on occupe la console / DEBUT */

									$this->OccupiesTheInstance();


									$this->Cmd('console:write///|>');

									foreach ($Get as $PathName => $BaseName) {

										$SetCmd = false;


										/* N'importe / DEBUT */

											if($Name == "*"){

												$SetCmd = 'remount "' . $PathName . '" ';

											}

										/* N'importe / FIN*/


										/* Family Pure / DEBUT */
											
											if($Name != "*"){

												/* Pour les Prefixes / DEBUT */
													
													if($Pos == $Lim){

														$_Start = substr($Name, 0, $Lim);

														$Start = substr($BaseName, 0, $Lim);

														if($Start == $_Start){

															$SetCmd = 'remount "' . $PathName . '" ';

														}

													}

												/* Pour les Prefixes / FIN */


												/* Pour les Suffixes / DEBUT */

													if($Pos == 0){

														$_END = substr($Name, -1 * $Lim);

														$END = substr($BaseName, -1 * $Lim);

														if($END == $_END){

															$SetCmd = 'remount "' . $PathName . '" ';

														}

													}

												/* Pour les Suffixes / FIN */



											}

										/* Family Pure / FIN */

										/* Application de la commande / DEBUT */

											if(is_string($SetCmd)){

												
												$this->Cmd($SetCmd);


											}

										/* Application de la commande / FIN */

										
									}


									$this->Cmd('console:write///>|');

									$this->Cmd('instance:free');



								/* Début de l'opération : on occupe la console / FIN */


							}

							else{

								$R[] = 'Aucune variable trouvée';

							}


						}

						else{

							$Get = \GVariables::invoke($Name, GSTORAGE_VARIABLE_INVOKE_NATIVES);

							if(is_array($Get)){


								if(isset($Get['data'][0])){

									$Data = $Get['data'][0];

									$NewVal = (isset($Data[0])) ? $Data[0] : null;

									$Set = \GVariables::create($Name

										, [

											$NewVal

											, (isset($Data[1]) && is_string($Data[1]) ) ? $Data[1] : false

											, false

											, false

										]

										, false

										, GSTORAGE_VARIABLE_INVOKE_NATIVES

									);

									if($Set){

										$R[] = '__Graph:Icn:Ok__ <b>' . $Name . '</b> -> <b>' . $NewVal . '</b> remonté avec succès';
										
									}

									else{
										
										$R[] = '__Graph:Icn:Error__ Echec de l\'opération';										

									}

								}
							
								else{
									
									$R[] = '__Graph:Icn:Error__ : ' . $Name . ' est vide';										

								}
								



							}

							else{

								$R[] = '__Graph:Icn:Error__ ' . $Name . ' introuvable';

							}

						}



					}

				/* Traitement / FIN */


				/* Auncune tache precisé / DEBUT */

					else{

						$R[] = 'Aucune variable indiquée';

					}

				/* Auncune tache precisé / FIN */


				return $R;

			}

		/* Remonter une variable / FIN */











		/* Aide / Debut */

			public function Help($section = false){



			}

		/* Aide / FIN */





	}


}





?>