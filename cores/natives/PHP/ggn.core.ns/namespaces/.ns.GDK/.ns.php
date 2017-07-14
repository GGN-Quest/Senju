<?php

	/**
	 * GGN GDK Invoke
	 *
	 * @version 0.1 
	 * @update 150814.1321
	 * @Require Gougnon Framework
	*/



/*
	Nom de l'espace
*/
namespace GGN\GDK;
	

	

	/* Système */
	new \GGN\Using('System');

	
	/* Environnement des chemins */
	new \GGN\Using('Path');
	
	
	/* Environnement des dossiers */
	new \GGN\Using('Dir');
	

	/* Environnement des fichiers */
	new \GGN\Using('File');




	/* Using */
	if(!class_exists('\GGN\GDK\Using')){

		Class Using{

			public function __construct($ns){ $this->object = clone new \GGN\Using($ns); }

		} 

	}








	if(!class_exists('\GGN\GDK\Invoke')){

		/*
			Invoke
		*/
		Class Invoke{

			const NAME = "GGN Development Kit";

			const VERSION = "0.1";

			const UPDATE = "170621.0838";


			static public function tExit($txt = ""){

				\_GGN::wCnsl("<div style='font-size:32px;'>" . self::NAME . "</div><div style='font-size:17px;'>" . $txt . "<br><i>version : " . self::VERSION . ", mise à jour : " . self::UPDATE . "</i></div>");

			}



		} // Class Invoke


	} // if class_exists 'Invoke'








	if(!class_exists('\GGN\GDK\Factory')){

		/*
			Factory
		*/
		Class Factory extends Invoke{


			/* Fournisseur : Application / DEBUT */

				static public function AppVendor(){

					return [

						'manifest.json' => [

							"Key" => "ggn.app.key"

							, "Name" => "Nom de l'application"

							, "Version" => "0.0 "

							, "UpdateVersion" => "Ymd.His "

							, "Description" => "Description "

							, "About" => "A propos"

							, "Category" => "ggn.app"

							, "Path" => "app://app_path"

							, "URL" => "{%HTTP_HOST%}app_url/"

							, "Res" => "{%HTTP_HOST%}app_res_url/"

							, "Icon" => "{%HTTP_HOST%}app_dir/app.icon.png"

							, "Cover" => "{%HTTP_HOST%}app_dir/app.cover.jpg"

							, "Available" => true

							, "Permission" => false

							, "LiveMode" => true

						]

						, 'assembly.json' => [

							"namespace" => [

								"System"

								, "Plugins"

							]

							, "accessibility" => 2

							, "autonomous" => true

							, "playout" => "senju.app.rk"

							, "handler" => [

								"name" => "dpo"

								, "args" => [

									"theme://ggn.shodai"

									, [

										"style" => "{%SYSTEM_THEME_STYLE%}"

									]

								]
								
							]

							, "session" => [

								"user" => true

								, "app" => false

							]
							
							, "settings" => [

								"context.menu" => true

								, "responsive" => true

								, "fullscreen" => false

							]

							, "popstate" => [

								"boot" => "index"

								, "prefix" => ""

								, "ext" => ".php"

							]

							, "framework" => [

								"js-version" => "nightly.0.1"

								, "css-version" => "senju.nightly.0.1"

							]

							, "packages" => [

								"js" => [

									"ggn.app.service"

									, "ggn.snowdark"

									, "ggn.key.shot"

								]

								, "css" => [

									"ggn.effects"

								]

							]

							, "ressources" => [

								"fonts" => [

									"roboto.thin"

									, "roboto.bold"

									, "roboto.black"

									, "roboto.condensed.regular"

								]

								, "js" => []

							]

							, "head" => [

								"title" => "App Sample"

								, "shortcut" => "{%HTTP_HOST%}favicon.png"

								, "meta" => [

									["charset", "utf-8"]

									, ["http-equiv", "pragma", "cache"]

								]

							]

							, "menu" => []

						]


					];

				}

			/* Fournisseur : Application / FIN */


		} // Class Factory


	} // if class_exists 'Factory'








	if(!class_exists('\GGN\GDK\Vendor')){

		/*
			Vendor
		*/
		Class Vendor extends Invoke{

			const NAME = "GDK Vendor";

			const VERSION = "0.1";

			const UPDATE = "170701.1345";


			/* Variables / DEBUT */

				var $Context = false;

				var $Args = false;

				var $Key = false;

			/* Variables / FIN */






			/* Constructrice / DEBUT */

				public function __construct($Context = false, $Args = null){

					$this->Context = $Context;

					$this->Args = $Args;

				}

			/* Constructrice / FIN */







			/* Initialisation / DEBUT */

				public function Initialize($Key = false){


					if(is_string($Key) && is_string($this->Context)){

						$this->Key = $Key;

						switch ($this->Context) {
							
							case '-app':

								$Path = __CORES_SYSTEM_COM_VENDOR__ . 'app/' . $this->Key . '/';

								if(!is_dir($Path)){\Gougnon::createFolders($Path);}


								$Factory = Factory::AppVendor();

								foreach ($Factory as $FileName => $Content) {
									
									$File = $Path . $FileName;

									\Gougnon::createFile($File, json_encode($Content, \GStorages::JSON_OPT() ) );

								}

								return true;


							break;
							
							default:

								return false;

							break;

						}



					}

					else{

						return false;

					}


				}

			/* Initialisation / FIN */






		} // Class Vendor


	} // if class_exists 'Vendor'









	if(!class_exists('\GGN\GDK\Packages')){

		/*
			Packages
		*/
		Class Packages{

			const NAME = "GDK Packages";

			const VERSION = "0.1";

			const UPDATE = "161109.0822";



			static public function Format($PackName = false, $Type = false){

				global $database;

				$Result = false;





				/* Crée un BOOT.GGN / DEBUT */

					if($PackName == 'boot.ggn'){


						$Type = strtolower((is_string($Type)) ? $Type : '-full');

						$CacheFile = \GGN\Path\Protocol::Value('user://.gdk/output/Boot.GGN', false);


						if(is_file($CacheFile)){
							

							$DistDir = \GGN\Path\Protocol::Value('system://gdk/init/dist/pkg.setup/');

							$LocalDir = '~ggn.setup/';
							
							$SQL = '';



							$Caches = new \ZipArchive;

							$OpenCaches = $Caches->open($CacheFile, \ZipArchive::CREATE);


							if($OpenCaches === true){



								/* Type : "-full" / DEBUT */

									if($Type == '-full'){

										$SQL = $database->Backup('*', GGNDB_TABLE_DATA|GGNDB_TABLE_STRUCTURE );

									}

								/* Type : "-full" / FIN */

								


								/* Type : "-system" / DEBUT */

									if($Type == '-system'){

										$SQL = $database->Backup([

											$database->GetTablesName('NATIVE_USERS')

											, $database->GetTablesName('NATIVE_USERS_IDENTITY')

											, $database->GetTablesName('NATIVE_USERS_IDENTITY_ACTIVE')

										], GGNDB_TABLE_STRUCTURE );

									}

								/* Type : "-system" / FIN */




								$SQL = str_replace('`' . $database->prefix, '`%DBPREFIX%', $SQL);

								\Gougnon::createFile($DistDir . 'db.query.sql', $SQL);


								foreach (explode(' ', 'create.admin.php db.settings.dist manifest.php db.query.sql') as $Dist) {

									$Entry = $LocalDir . $Dist;

									$File = $DistDir . $Dist;

									if(is_file($File)){

										$Caches->addFile($File, $Entry);

									}

								}
									

								$Caches->close();

								$Result = true;


							}


						}

					}

				/* Crée un BOOT.GGN / FIN */


				return $Result;

			}




			static public function Build($PackName = false, $Type = false){

				$Result = false;



				/* Crée un BOOT.GGN / DEBUT */

					if($PackName == 'boot.ggn'){

						$Type = strtolower((is_string($Type)) ? $Type : '-full');

						$CacheFile = \GGN\Path\Protocol::Value('user://.gdk/output/Boot.GGN', false);


						// var_dump($CacheFile);exit;


						if(!is_dir(dirname($CacheFile))){\Gougnon::createFolders(dirname($CacheFile)); }

						// if(!is_file($CacheFile)){\Gougnon::createFile($CacheFile, ''); }

						if(is_file($CacheFile)){\GGN\File\Remove($CacheFile); }




						$Result = [];

						$Caches = new \ZipArchive;

						$OpenCaches = $Caches->open($CacheFile, \ZipArchive::CREATE);



						



						/* Type : "-full" / DEBUT */

							if($Type == '-full'){

								$Files = [__MAIN__];

							}

						/* Type : "-full" / FIN */

						





						/* Type : "-system" / DEBUT */

							if($Type == '-system'){

								$Files = (new \GGN\System\Bases())->Files();

							}

						/* Type : "-system" / FIN */






						if($OpenCaches === true){

							foreach ($Files as $File) {

								$fFile = \GGN\Path\Protocol::Value($File, false);

								$dFile = \GGN\Path\Protocol::Value($File, true);

								$vFile = false;

								$Entry = false;


								if(is_file($fFile)){

									$Entry = substr( $fFile, strlen(__MAIN__) );

									$Caches->addFile($fFile, $Entry);

									// $Result[] = $fFile;

								}

								if(is_dir($dFile)){

									$Scan = \Gougnon::iScanFolder($dFile);

									foreach ($Scan as $key => $sFl) {

										$Entry = substr( $sFl, strlen(__MAIN__) );

										$Caches->addFile($sFl, $Entry);
										
									}

								}

								
							}


							$Caches->close();

							$Result = true;

						}

					}

				/* Crée un BOOT.GGN / FIN*/


				return $Result;

			}



		} // Class Packages


	} // if class_exists 'Packages'



