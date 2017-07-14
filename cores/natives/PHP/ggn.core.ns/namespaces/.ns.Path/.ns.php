<?php

	/**
	 * GGN Path Invoke
	 *
	 * @version 0.1 
	 * @update 150814.1321
	 * @Require Gougnon Framework
	*/



/*
	Nom de l'espace
*/
namespace GGN\Path;
	
	





	/* Using */
	
	if(!class_exists('\GGN\Path\Using')){

		Class Using{
		
			public function __construct($ns){ $this->object = clone new \GGN\Using($ns); }
		
		} 

	}









	if(!function_exists('\GGN\Path\Same')){

		/*
			Same
		*/
		
		function Same($Path0, $Path1){

			return str_replace('\\', '/', $Path0) == str_replace('\\', '/', $Path1);

		}



	} // if function_exists 'Same'








	if(!class_exists('\GGN\Path\Invoke')){

		/*
			Invoke
		*/
		Class Invoke{



		} // Class Invoke


	} // if class_exists 'Invoke'








	if(!class_exists('\GGN\Path\Name')){

		/*
			Name
		*/
		Class Name extends Invoke{


			public function __construct($Path = false){

				$this->return = $this->Get($Path);

			}




			/* 
				Retourne le chemin d'un dossier à partir du protocole 
			*/

			static public function Get($Path = false, $Merge = false){

				return Protocol::Value($Path, $Merge);

			}



			/* 
				Retourne le chemin d'un fichier à partir d'un chemin considéré comme base
			*/

			static public function OutBase($Path = false, $Base = false, $Format = true){

				if(is_string($Path)){

					$Base = (!is_string($Base)) ? __MAIN__: $Base;

					$Out = substr($Path, strlen($Base));

					return ($Format === true) ? self::Format($Out) : $Out;

				}

				else{

					return false;

				}

			}



			/* 
				Formater un chemin d'acces
			*/

			static public function Format($Path = false){

				if(is_string($Path)){

					$l = substr(rtrim(ltrim($Path)), -1);

					return $Path . (($l == '/') ? '' : '/');

				}

				else{

					return false;

				}

			}

		} // Class Name


	} // if class_exists 'Name'








	if(!class_exists('\GGN\Path\Protocol')){

		/*
			Protocol
		*/
		Class Protocol extends Invoke{



			const PREFIX = 'protocol.';

			const EXT = '.php';




			public function __construct(){

				

			}



			static public function Dir(){

				return __CORES_SYSTEM__ . 'x-protocols/';

			}



			static public function Get($key = false, $added = true){

				$Get = self::Load($added);

				$OutPut = '';


				foreach ($Get as $K => $P) {

					if(isset($P['get'])){

						if( (new \ReflectionFunction($P['get']))->isClosure() ){

							$Get[$K]['value'] = $P['get']();

						}

						else{

							$Get[$K]['value'] = $P['get'];

						}

					}
					
				}

				return $Get;

			}



			static public function Load($added = true){

					
				$List = [


					'http' => [

						'about' => 'URL du script courant'

						, 'get' => function($args = false){

							return HTTP_HOST;

						}

					]



					, 'doc-root' => [

						'about' => 'le DOCUMENT_ROOT de PHP'

						, 'get' => function($args = false){

							return $_SERVER['DOCUMENT_ROOT'];

						}

					]



					, 'root main' => [

						'about' => 'la racine du script'

						, 'get' => function($args = false){

							return __MAIN__;

						}

					]



					, 'cores' => [

						'about' => 'le dossier noyaux'

						, 'get' => function($args = false){

							return __CORES__;

						}

					]



					, 'cores-php' => [

						'about' => 'le dossier natif des noyaux PHP'

						, 'get' => function($args = false){

							return __CORES_NATIVE_PHP__;

						}

					]



					, 'cores-js' => [

						'about' => 'le dossier natif des noyaux JS'

						, 'get' => function($args = false){

							return __CORES_NATIVE_JS__;

						}

					]



					, 'cores-css' => [

						'about' => 'le dossier natif des noyaux CSS'

						, 'get' => function($args = false){

							return __CORES_NATIVE_CSS__;

						}

					]



					, 'cores-css' => [

						'about' => 'le dossier natif des noyaux CSS'

						, 'get' => function($args = false){

							return __CORES_NATIVE_CSS__;

						}

					]



					, 'app' => [

						'about' => 'le dossier des applications'

						, 'get' => function($args = false){

							return __APPLICATIONS__;

						}

					]



					, 'ggn-system' => [

						'about' => 'le dossier GGN dans le système'

						, 'get' => function($args = false){

							return __CORES_SYSTEM_GGN__;

						}

					]



					, 'api-system' => [

						'about' => 'le dossier GGN des api'

						, 'get' => function($args = false){

							return __CORES_SYSTEM_API__;

						}

					]



					, 'com' => [

						'about' => 'le dossier COM dans le système'

						, 'get' => function($args = false){

							return __CORES_SYSTEM_COM__;

						}

					]



					, 'service' => [

						'about' => 'le dossier des services de communication dans le système'

						, 'get' => function($args = false){

							return __CORES_SYSTEM_COM_SERVICES__;

						}

					]



					, 'tunnel' => [

						'about' => 'le dossier des tunnel de communication dans le système'

						, 'get' => function($args = false){

							return __CORES_SYSTEM_COM_TUNNELS__;

						}

					]



					, 'vendor' => [

						'about' => 'le dossier des fournisseurs de communication dans le système'

						, 'get' => function($args = false){

							return __CORES_SYSTEM_COM_VENDOR__;

						}

					]



					, 'com-log' => [

						'about' => 'le dossier des LOG de communication dans le système'

						, 'get' => function($args = false){

							return __CORES_SYSTEM_COM_LOG__;

						}

					]



					, 'behavior' => [

						'about' => 'le dossier des comportements de communication dans le système'

						, 'get' => function($args = false){

							return __CORES_SYSTEM_COM_BEHAVIORS__;

						}

					]



					, 'system' => [

						'about' => 'le dossier système'

						, 'get' => function($args = false){

							return __CORES_SYSTEM__;

						}

					]




					, 'cmds' => [

						'about' => 'le dossier des commandes système'

						, 'get' => function($args = false){

							return __CORES_SYSTEM_CMDs__;

						}

					]




					, 'driver' => [

						'about' => 'le dossier des drivers système'

						, 'get' => function($args = false){

							return __CORES_SYSTEM_DRIVERS__;

						}

					]




					, 'protocol' => [

						'about' => 'le dossier des protocoles système'

						, 'get' => function($args = false){

							return __CORES_SYSTEM_PROTO__;

						}

					]




					, 'junction' => [

						'about' => 'le dossier des atouts jonctions'

						, 'get' => function($args = false){

							return __CORES_SYSTEM_JUNCTIONS__;

						}

					]




					, 'dpo' => [

						'about' => 'le dossier des atouts DPO'

						, 'get' => function($args = false){

							return __CORES_SYSTEM__ . 'x-dpo/';

						}

					]



					, 'native' => [

						'about' => 'le dossier des données natives dans le dossier noyaux'

						, 'get' => function($args = false){

							return __CORES_NATIVES__;

						}

					]



					, 'plugin' => [

						'about' => 'le dossier des plug-ins'

						, 'get' => function($args = false){

							return __PLUGINS__;

						}

					]



					, 'plugin-php' => [

						'about' => 'le dossier des plug-ins PHP'

						, 'get' => function($args = false){

							return __PLUGINS_PHP__;

						}

					]



					, 'plugin-js' => [

						'about' => 'le dossier des plug-ins JS'

						, 'get' => function($args = false){

							return __PLUGINS_JS__;

						}

					]



					, 'plugin-html' => [

						'about' => 'le dossier des plug-ins HTML'

						, 'get' => function($args = false){

							return __PLUGINS_HTML__;

						}

					]



					, 'plugin-css' => [

						'about' => 'le dossier des plug-ins CSS'

						, 'get' => function($args = false){

							return __PLUGINS_CSS__;

						}

					]



					, 'html' => [

						'about' => 'le dossier des page HTML'

						, 'get' => function($args = false){

							return __HTML__;

						}

					]




					, 'arc-page' => [

						'about' => 'le dossier des page des ARC du registre'

						, 'get' => function($args = false){

							return __ARC_PAGES__;

						}

					]



					, 'users' => [

						'about' => 'le dossier des utilisateurs'

						, 'get' => function($args = false){

							return __USERS__;

						}

					]



					, 'ressource rsrc' => [

						'about' => 'le dossier des ressources'

						, 'get' => function($args = false){

							return __RESSOURCES__;

						}

					]



					, 'font' => [

						'about' => 'le dossier des FONTS'

						, 'get' => function($args = false){

							return __FONTS__;

						}

					]



					, 'lang' => [

						'about' => 'le dossier des langue'

						, 'get' => function($args = false){

							return __LANGS__;

						}

					]



					, 'swf' => [

						'about' => 'le dossier des fichiers swf'

						, 'get' => function($args = false){

							return __SHOCKWAVES_X__;

						}

					]



					, 'image' => [

						'about' => 'le dossier des images'

						, 'get' => function($args = false){

							return __IMAGES__;

						}

					]



					, 'captcha' => [

						'about' => 'le dossier des captchas'

						, 'get' => function($args = false){

							return __CAPTCHA__;

						}

					]



					, 'video' => [

						'about' => 'le dossier des videos'

						, 'get' => function($args = false){

							return __VIDEOS__;

						}

					]



					, 'sample' => [

						'about' => 'le dossier des samples'

						, 'get' => function($args = false){

							return __SAMPLE_FILES__;

						}

					]



					, 'sound' => [

						'about' => 'le dossier des fichiers audio'

						, 'get' => function($args = false){

							return __SOUNDS_FILE__;

						}

					]



					, 'js' => [

						'about' => 'le dossier des fichiers JavaScript'

						, 'get' => function($args = false){

							return __JAVASCRIPTS__;

						}

					]



					, 'css' => [

						'about' => 'le dossier des fichiers CSS'

						, 'get' => function($args = false){

							return __CSS__;

						}

					]



					, 'theme' => [

						'about' => 'le dossier des thèmes'

						, 'get' => function($args = false){

							return __THEMES__;

						}

					]



					, 'cache' => [

						'about' => 'le dossier des caches'

						, 'get' => function($args = false){

							return __CACHES__;

						}

					]



					, 'cache-active' => [

						'about' => 'le dossier des caches actifs'

						, 'get' => function($args = false){

							return __CACHES_ACTIVE__;

						}

					]



					, 'cache-passive' => [

						'about' => 'le dossier des caches passifs'

						, 'get' => function($args = false){

							return __CACHES_PASSIVE__;

						}

					]



					, 'user' => [

						'about' => 'le dossier de l\'utilisateurs courant'

						, 'get' => function($args = []){

							global $GRegister;

							extract($args);

							$merge = isset($merge) ? $merge : false;
							

							if(isset($GRegister->USER) && is_array($GRegister->USER) && is_string($GRegister->USER['USERNAME']) ){

								return \GUSERS::dataDir($GRegister->USER['USERNAME'], $merge);

							}

							else{return false;}

						}

					]



					, 'user-gpk-data' => [

						'about' => 'le dossier des packages GGN de l\'utilisateurs courant'

						, 'get' => function($args = []){

							global $GRegister;

							extract($args);

							$merge = isset($merge) ? $merge : false;


							if(isset($GRegister->USER) && is_array($GRegister->USER) && is_string($GRegister->USER['USERNAME']) ){

								return \GUSERS::dataDir($GRegister->USER['USERNAME']) . '.gpk/';

							}

							else{return false;}

						}

					]



					, 'user-downloads' => [

						'about' => 'le dossier des données téléchargés GGN de l\'utilisateurs courant'

						, 'get' => function($args = []){

							global $GRegister;

							extract($args);

							$merge = isset($merge) ? $merge : false;


							if(isset($GRegister->USER) && is_array($GRegister->USER) && is_string($GRegister->USER['USERNAME']) ){

								return \GUSERS::dataDir($GRegister->USER['USERNAME'], '%DOWNLOAD%');

							}

							else{return false;}

						}

					]



				]; 


				/* Variable de sortie */

					$OutPut = [];


				/* Ajout de variable externe / DEBUT */

					if($added == true){

						$Dir = self::Dir();

						if(!is_dir($Dir)){\Gougnon::createFolders($Dir);}

						$Scan = \Gougnon::scanFolder($Dir);

						if(count($Scan) > 0){

							foreach ($Scan as $file) {

								$f = basename($file);

								$prefix = substr($f, 0, strlen(self::PREFIX));

								$ext = substr($f, -1 * strlen(self::EXT));


								if($prefix == self::PREFIX && $ext == self::EXT && is_file($file)){

									$Out = self::GetAddedProtocol( substr($file, strlen(self::PREFIX), -1 * strlen(self::EXT) ) );

									if(is_array($Out)){

										$OutPut = \Gougnon::mergeArray($OutPut, $Out, true);
										
									}

								}
								
							}

						}

					}

				/* Ajout de variable externe / FIN */

				

				/* Traitement / DEBUT */

					foreach ($List as $key => $value) {

						$names = explode(' ', $key);

						foreach ($names as $name) {

							$OutPut[$name] = $value;
							
						}

						
					}

				/* Traitement / FIN */





				return $OutPut;

			}



			static public function GetAddedProtocol($name = false){

				$Protocol = false;

				if(is_string($name)){

					$file = self::Dir() . self::PREFIX . $name . self::EXT;

					if(is_file($file)){

						include $file;

					}

				}

				return $Protocol;

			}



			static public function Detect($Path = false, $Format = true){

				$Protocols = self::Get();

				$Path = str_replace("\\", "/", $Path);

				$Out = $Path;


				foreach ($Protocols as $Name => $Protocol) {

					$path = str_replace("\\", "/", $Protocol['value']);

					if( substr($Path, 0, strlen($path)) == $path ){

						$Out = $Name . '://';

						$Go = substr($Path, strlen($path));

						$Out .= ($Format === true) ? Name::Format( $Go ) : $Go ;

					}
					
				}


				return $Out;

			}



			static public function Value($Path = false, $Format = true){

				if(is_string($Path)){

					$Protocols = self::Get();

					$Path = str_replace("\\", "/", $Path);

					$Exp = explode('://', $Path);

					$Prot = $Exp[0];


					if(isset($Exp[1])){

						$Pth = $Exp[1];

						$Out = (isset($Protocols[$Prot]) && isset($Protocols[$Prot]['get'])) ? $Protocols[$Prot]['get']() : false;

						return ($Format == true) ? Name::Format($Out . $Pth) : $Out . $Pth;

					}

					else{

						return $Path;

					}


				}

				else{

					return false;

				}

			}




		} // Class Protocol


	} // if class_exists 'Protocol'
















				








?>