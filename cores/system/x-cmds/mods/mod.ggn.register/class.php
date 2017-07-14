<?php
/*
	Copyright GOBOU Y. Yannick
	
*/

namespace GGN\System\xCMD;

	
global $database, $_Gougnon, $GRegister;




if(!class_exists('GGN_REGISTRY_CMD')){


	/*

		GGN Système Commands

	*/

	class GGN_REGISTRY_CMD extends Attributes implements Format {


		const NAME = 'GGN Register';

		const VERSION = '0.0.160812.0719';




		const ARC_EXT = 'ext/arc';

		const ARC_SLASH = 'slash/arc';


		
		var $args = [];


		/* ARC / DEBUT */

		var $ARC = [


			/* ARC de type : EXT / DEBUT */

			[	

				'TYPE' => 'EXT'

				, 'MANIFEST' => [

					'INFO' => [

						'NAME' => 'Nom de l\'ARC'

						, 'AUTHOR' => 'Nom de l\'auteur'

						, 'AUTHOR_WEBSITE' => 'Site web de l\'auteur'

						, 'AUTHOR_EMAIL' => 'Email de l\'auteur'

					]

					,'CONFIG' => [

						'HEADER' => 'Entête'

						, 'CONTROL-ACCESS' => 'Controle d\'accessibilité'

						, 'CONTROL-ACCESS-EXCLUDES' => 'Exclure au controle d\'accessibilité'

						, 'OPENED_RIGHT' => 'Droit d\'accessibilité'

						, 'ACCESS_OR_RIGHT' => 'Type d\'accessibilité'

						, 'ROOT_SRC' => 'Racine des sources'

						, 'RENDERING_ENGINE' => 'Moteur de rendu'

						, 'EXT' => 'Extension des sources'

					]

				]

			]

			/* ARC de type : EXT / FIN */


			/* ARC de type : SLASH / DEBUT */
			, [

				'TYPE' => 'SLASH'

				, 'MANIFEST' => [

					'INFO' => [

						'NAME' => 'Nom de l\'ARC'

						, 'AUTHOR' => 'Nom de l\'auteur'

						, 'AUTHOR_WEBSITE' => 'Site web de l\'auteur'

						, 'AUTHOR_EMAIL' => 'Email de l\'auteur'

					]

					,'CONFIG' => [

						'HEADER' => 'Entête'

						, 'CONTROL-ACCESS' => 'Controle d\'accessibilité'

						, 'CONTROL-ACCESS-EXCLUDES' => 'Exclure au controle d\'accessibilité'

						, 'OPENED_RIGHT' => 'Droit d\'accessibilité'

						, 'ACCESS_OR_RIGHT' => 'Type d\'accessibilité'

						, 'RENDERING_ENGINE' => 'Moteur de rendu'

					]

				]

			]

			/* ARC de type : SLASH / FIN */

		];

		/* ARC / FIN */





		function __construct(){

			global $GRegister;

			$this->args = func_get_args();

		}




		/* Applicateur de Commande / DEBUT */

			public function Apply($cmd = false){

				$R = [];

				// $C = explode(" ", $cmd);

				$C = Utility::Concatenate($cmd);


				if(isset($C[0])){

					$CCMD = strtolower($C[0]);

					switch ($CCMD) {


						case 'arc:slash':

						case 'arc:ext':


							if($CCMD == 'arc:ext'){

								$_TYPE = \RegisterARC::ARC_TYPE_EXT;

								$_REXT = \RegisterARC::ARC_EXT_RENDERING_EXT;

							}


							if($CCMD == 'arc:slash'){

								$_TYPE = \RegisterARC::ARC_TYPE_SLASH;

								$_REXT = \RegisterARC::ARC_SLASH_PATH_RENDERING_EXT;

							}


							if(isset($_TYPE) && isset($_REXT)){

								
								$Do = isset($C[1]) && is_string($C[1]) ? strtolower($C[1]) : false;


								/* Initialisation d'un arc de type Courant / DEBUT */
								
									if($Do == 'init' || $Do == 'format'){

										if(isset($C[2]) && is_string($C[2]) && !\Gougnon::isEmpty($C[2]) ){

											$RegisterARC = new \RegisterARC();

											$ARC = strtoupper(Utility::StripExQuotes($C[2]));


											$Res = $RegisterARC->Init($ARC, $_TYPE);

											if(isset($Res[0])){ $R[] = '__Graph:Icn:Ok__ ARC initialisé avec succès'; }

											if(isset($Res[1])){ $R[] = '__Graph:Icn:Ok__ Formatage du Manifest'; }

											if(isset($Res[2])){ $R[] = '__Graph:Icn:Ok__ Moteur de Rendu initialisé avec succès'; }

											if(isset($Res[3])){ $R[] = '__Graph:Icn:Ok__ Formatage du Moteur de Rendu'; }

										}

										else{

											$this->Input(['label' => 'Nom de l\'ARC','type' => 'text','placeholder' => 'Exemple : .XHTML']);

										}
										

									}

								/* Création d'un arc de type Courant / FIN */






								/* Ouverture d'un arc de type Courant / DEBUT */

									else if($Do == 'detail'){

										if(isset($C[2]) && is_string($C[2]) && !\Gougnon::isEmpty($C[2]) ){

											$ARC = strtoupper(Utility::StripExQuotes($C[2]));

											$RegisterARC = new \RegisterARC($ARC, $_TYPE);

											$Detail = $RegisterARC->Detail();


											$R[] = '__Graph:Icn:details__ Details de l\'ARC : ' . $ARC . ' /// ';

											foreach ($Detail as $Key => $Det) {


												if($Key == 'manifest'){

													$R[] = '/// Manifest ///////////////';

													foreach ($Det as $Section => $Val) {

														if(is_array($Val)){

															$R[] = '[' . $Section . ']';

															foreach ($Val as $VarName => $v) {

																$R[] = '<div handler-click="Terminal.Cmd" terminal-cmd="' . urlencode($CCMD . ' set "' . $ARC . '" "' . $Section . '" "' . $VarName . '" ') . '">' . ($VarName . ' = ' . $v) . '</div>';

															}

														}
														
													}

												}
												

												if($Key == 'engine'){

													$R[] = '/// Moteur de Rendu ///////////////';

													$R[] = '' . substr($Det, 0, -1 * strlen($_REXT) );

												}

												
											}


										}

										else{

											$this->Input(['label' => 'Nom de l\'ARC','type' => 'text','placeholder' => 'Exemple : .XHTML']);

										}
										
									}

								/* Ouverture d'un arc de type Courant / FIN */







								/* Modification d'un arc de type Courant à partir d'une section / DEBUT */

									else if($Do == 'set'){

										if(isset($C[2]) && is_string($C[2]) && !\Gougnon::isEmpty($C[2]) ){

											$ARC = strtoupper(Utility::StripExQuotes($C[2]));

											$Section = ( isset($C[3]) && is_string($C[3]) && !\Gougnon::isEmpty($C[3]) ) ? $C[3] : false;



											if(is_string($Section)){

												$RegisterARC = new \RegisterARC($ARC, $_TYPE);

												$Section = Utility::StripExQuotes($Section);

												$VarName = ( isset($C[4]) && is_string($C[4]) && !\Gougnon::isEmpty($C[4]) ) ? Utility::StripExQuotes($C[4]) : false;



												if(is_string($VarName)){

													$Value = ( isset($C[5]) && is_string($C[5]) && !\Gougnon::isEmpty($C[5]) ) ? Utility::StripExQuotes($C[5]) : false;

													if(is_string($Value)){

														$Label = strtoupper($Section) . ' -> ' . strtoupper($VarName);


														if($RegisterARC->Set($Section, $VarName, $Value)){

															$R[] = '__Graph:Icn:Ok__ ' . $Label . ' mit à jour';

														}

														else{

															$R[] = '__Graph:Icn:Error__ Echec lors de la mise à jour de ' . $Label;

														}

													}

													else{

														$this->Input(['label' => $VarName,'type' => 'text', 'placeholder' => 'Valeur de la variable']);

													}

													
												}

												else{

													$this->Input(['label' => ('Nom de la variable à modifier'),'type' => 'text', 'placeholder' => 'Nom de la variable']);
													
												}

											}

											else{
												
												$this->Input(['label' => 'Section à mettre à jour','type' => 'text', 'placeholder' => 'Exemple : config']);
												
											}

										}

										else{

											$this->Input(['label' => 'Nom de l\'ARC','type' => 'text','placeholder' => 'Exemple : .XHTML']);

										}
										
									}

								/* Modification d'un arc de type Courant à partir d'une section / FIN */








								/* Suppression d'un ARC / DEBUT */

									else if($Do == 'delete'){

										if(isset($C[2]) && is_string($C[2]) && !\Gougnon::isEmpty($C[2]) ){

											$ARC = strtoupper(Utility::StripExQuotes($C[2]));

											$RegisterARC = new \RegisterARC($ARC, $_TYPE);

											if($RegisterARC->Delete()){

												$R[] = '__Graph:Icn:Ok__ ' . $ARC . ' a été supprimé avec succès';

											}

											else{
												
												$R[] = '__Graph:Icn:Error__ Echec lors de la suppression';

											}

										}

										else{

											$this->Input(['label' => 'Nom de l\'ARC','type' => 'text','placeholder' => 'Exemple : .XHTML']);

										}
										
									}

								/* Suppression d'un ARC / FIN */






								/* Lister tous les ARC de type 'Courant' / DEBUT */

									else{

										$RegisterARC = new \RegisterARC();

										$List = $RegisterARC->GetList($_TYPE);


										$R[] = 'Liste / DEBUT /////////////////////////';

										foreach ($List as $ARC) {

											$R[] = '<div handler-click="Terminal.Cmd" terminal-cmd="' . urlencode($CCMD . ' detail "' . $ARC . '"') . '">' . $ARC . '</div>';
											
										}

										$R[] = 'Liste / FIN /////////////////////////';

									}

								/* Lister tous les ARC de type 'Courant' / FIN */

							}



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








		/* Aide / Debut */

			public function Help($section = false){



			}

		/* Aide / FIN */





	}


}





?>