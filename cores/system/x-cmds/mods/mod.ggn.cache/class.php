<?php
/*
	Copyright GOBOU Y. Yannick
	
*/


	
global $database, $_Gougnon, $GRegister;




if(!class_exists('GGN_SYS_CMD_CACHE')){


	/*

		GGN Système Commands

	*/

	class GGN_SYS_CMD_CACHE extends GGN\System\xCMD\Attributes implements GGN\System\xCMD\Format {


		const NAME = 'GGN Cache';

		const VERSION = '0.0.160812.0719';


		
		var $args = [];


		function __construct(){

			global $GRegister;


			$this->args = func_get_args();



			$this->Dir = __CACHES__;

			$this->DirActif = __CACHES_ACTIVE__;

			$this->DirPassif = __CACHES_PASSIVE__;

			
		}




		/* Applicateur de Commande / DEBUT */

			public function Apply($cmd = false){

				$R = [];


				$C = GGN\System\xCMD\Utility::Concatenate($cmd);




				switch (isset($C[0]) ? strtolower($C[0]) : "") {


					case 'clear':

						$R[] = 'Début du nettoyage';

						$R = \Gougnon::mergeArray($R, $this->Clear($cmd, $this->Dir) );
						
					break;


					case 'clear.active':

						$R[] = 'Début du nettoyage';

						$R = \Gougnon::mergeArray($R, $this->Clear($cmd, $this->DirActif . ((isset($C[1])) ? $C[1] : '')));
						
					break;


					case 'clear.passive':

						$R[] = 'Début du nettoyage';

						$R = \Gougnon::mergeArray($R, $this->Clear($cmd, $this->DirPassif . ((isset($C[1])) ? $C[1] : '') ));
						
					break;

					
					default:

						if($cmd===null){
							
							$R[] = 'Module rattaché à la console';

						}

						else{

							$R[] = '__Graph:Icn:Warning__Commande invalide : <b>' . $cmd . '</b>';

						}

						
					break;

				}

				return $R;

			}

		/* Applicateur de Commande / FIN */




		/* Nettoyage / DEBUT */

			public function Clear($cmd, $dirn = false){

				$R = [];

				$d = [];

					$fd = 0; $fds = 0;

					$dd = 0; $dds = 0;


				$dir = (is_string($dirn) && is_dir($dirn)) ? $dirn : false;

				if(is_string($dir)){

					$R[] = 'Recolte des données...';

					$data = \Gougnon::iScanFolder($dir);

					$len = count($data);

					$R[] = $len . ' donnée' . ($len > 1 ? 's' : '') . ' trouvé' . ($len > 1 ? 's' : '') . '';



					$R[] = '...';




					if($len > 0){



						/* Sequence de suppression */
						
						$R[] = 'Supression des fichiers...';

						foreach ($data as $key => $dat) {



							/* Suppression des fichiers */

							if(is_file($dat)){

								if(\GGN\File\Remove($dat)){

									$R[] = '__Graph:Icn:Ok__ __Graph:Icn:File__ ./' . (substr($dat, strlen($dir) ) );

									$fd++;


									/* Suppression du dossier contenant s'il est vide */

									$drn = dirname($dat);

									$scn = count(\Gougnon::iScanFolder($drn));

									if(is_dir($drn) && $drn != $dir &&  $scn == 0){

										if(rmdir($drn)){

											// $R[] = '__Graph:Icn:Ok__ __Graph:Icn:Folder__ ./' . (substr($drn, strlen($dir)));

											// $dd++;

										}

										// $dds++;

									}


								}
								
								else{$R[] = '__Graph:Icn:Error__ __Graph:Icn:File__ ./' . (substr($dat, strlen($dir)));}

								$fds++;

							}

							

						}



						$R[] = '...';



						/* Diagnostic */
						$R[] = 'Resultat : ';

						// $R[] = 'Resultat : ' . $len . ' tentative' . ($len > 1 ? 's' : '') . ' de traitement  éffectué' . ($len > 1 ? 's' : '') . ' ';

						$R[] = ' - Fichier' . ($fd > 1 ? 's' : '') . ' nettoyé' . ($fd > 1 ? 's' : '') . ' : ' . $fd . ' / ' . $fds;


					}

				}

				else{

					$R[] = '__Graph:Icn:Error__ Dossier introuvable!!';

				}


				return $R;

			}

		/* Nettoyage / FIN */






		/* Aide / Debut */

			public function Help($section = false){



			}


		/* Aide / FIN */





	}


}





?>