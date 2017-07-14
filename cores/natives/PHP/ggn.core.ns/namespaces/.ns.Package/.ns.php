<?php

	/**
	 * GGN Package Invoke
	 *
	 * @version 0.1 
	 * @update 150814.1321
	 * @Require Gougnon Framework
	*/



/*
	Nom de l'espace
*/
namespace GGN\Package;
	
	
	
	new \GGN\Using('Path');

	new \GGN\Using('File');

	new \GGN\Using('Dir');






	if(!class_exists('\GGN\Package\Invoke')){

		/*
			Invoke
		*/
		Class Invoke{


			CONST NAME = 'Gougnon Package';
			
			CONST VERSION = '0.1';
			
			CONST REEL_VERSION = '0.1.170115.0750';




			/* Extension */

				CONST Ext = '.gpk';

				CONST CaExt = '.gpk-cache';



			var $Return = false;


			/* liste des types de packages / DEBUT */

			var $_PKG_TYPES = [

				'root' => [

					'about' => 'Racine'

					, 'assoc-paths' => ''

				]


				, 'cores-php' => [

					'about' => 'Noyau PHP'

					, 'assoc-paths' => ''

				]


				, 'cores-js' => [

					'about' => 'Noyau JS'

					, 'assoc-paths' => ''

				]


				, 'cores-css' => [

					'about' => 'Noyau CSS'

					, 'assoc-paths' => ''

				]


				, 'rsrc' => [

					'about' => 'ressource'

					, 'assoc-paths' => ''

				]

					, 'lang' => [

						'about' => 'langue'

						, 'assoc-paths' => ''

					]


					, 'swf' => [

						'about' => 'flash shockwaves'

						, 'assoc-paths' => ''

					]


					, 'image' => [

						'about' => 'Image'

						, 'assoc-paths' => ''

					]


					, 'video' => [

						'about' => 'vidéo'

						, 'assoc-paths' => ''

					]


					, 'sample' => [

						'about' => 'sample'

						, 'assoc-paths' => ''

					]


					, 'sound' => [

						'about' => 'sound'

						, 'assoc-paths' => ''

					]


					, 'js' => [

						'about' => 'javascript'

						, 'assoc-paths' => ''

					]


					, 'css' => [

						'about' => 'CSS'

						, 'assoc-paths' => ''

					]


					, 'theme' => [

						'about' => 'thème'

						, 'assoc-paths' => 'image://;lang://;swf://;video://;sound://;js://;css://'

					]


				, 'app' => [

					'about' => 'Application'

					, 'assoc-paths' => 'theme://;image://;lang://;swf://;video://;sound://;js://;css://'

				]


				, 'users' => [

					'about' => 'Utilisateurs (donnée)'

					, 'assoc-paths' => ''

				]


				, 'system' => [

					'about' => 'Système'

					, 'assoc-paths' => ''

				]


				, 'native' => [

					'about' => 'natif'

					, 'assoc-paths' => ''

				]


				, 'plugin' => [

					'about' => 'plug-in'

					, 'assoc-paths' => ''

				]


					, 'plugin-php' => [

						'about' => 'Plug-in PHP'

						, 'assoc-paths' => ''

					]


					, 'plugin-html' => [

						'about' => 'Plug-in HTML'

						, 'assoc-paths' => ''

					]


					, 'plugin-js' => [

						'about' => 'Plug-in JS'

						, 'assoc-paths' => ''

					]

					, 'plugin-css' => [

						'about' => 'Plug-in CSS'

						, 'assoc-paths' => ''

					]



				, 'license' => [

					'about' => 'License'

					, 'assoc-paths' => ''

				]


				, 'cache' => [

					'about' => 'Cache'

					, 'assoc-paths' => ''

				]

					, 'cache-active' => [

						'about' => 'Cache Actif'

						, 'assoc-paths' => ''

					]

					, 'cache-passive' => [

						'about' => 'Cache Passif'

						, 'assoc-paths' => ''

					]


			]; 

			/* liste des types de packages / FIN */





		/* Type de package / DEBUT */

			public function _Type($k = false){

				return (isset($this->_PKG_TYPES[$k]) ? $this->_PKG_TYPES[$k] : false);

			}

		/* Type de package / FIN */





		/* Chemin associé à un type de package / DEBUT */

			public function GetAssocPaths($type = false){

				if(is_string($type)){

					$type = strtolower($type);

					$Types = $this->_Type($type);


					if(is_array($Types)){

						return isset($Types['assoc-paths']) ? $Types['assoc-paths'] : false;

					}

					else{

						return false;

					}

				}

				else{

					return false;

				}

			}

		/* Chemin associé à un type de package / FIN */






		/* Dossiers / DEBUT */

			static public function OutPutDir(){

				$Dir = \GGN\Dir\Path::Name('user-gpk-data://');

				if(!is_dir($Dir)){\Gougnon::createFolders($Dir);}

				return $Dir;

			}

		/* Dossiers / FIN */





		} // Class Invoke


	} // if class_exists 'Invoke'







	if(!class_exists('\GGN\Package\Creator')){

		/*
			Creator
		*/

		Class Creator extends Invoke{



			var $Manifest = false;

			var $name = false;

			var $sources = false;

			var $easePaths = false;

			var $version = false;

			var $type = 'root';

			var $tables = false;


			var $OutFile = false;



			public function __construct($args = []){

				if(is_array($args)){

					foreach ($args as $key => $value) {

						$this->{$key} = $value;

					}

				}

			}




			/* Dossiers / DEBUT */

				static public function CacheDir(){

					$Dir = __CACHES__ . '~ggn.packages.creator.caches/';

					if(!is_dir($Dir)){\Gougnon::createFolders($Dir);}

					return $Dir;

				}


			/* Dossiers / FIN */






			/* Fichiers et Dossiers à prendre en compte / DEBUT */

				public function GetEntries($AssocPaths = false){

					if(
					
						is_string($this->easePaths)

						&& is_array($AssocPaths)

					){


						$Files = [];


						/* Les fichiers Sources / DEBUT */

							if( is_string($this->sources) && !\Gougnon::isEmpty($this->sources) ){


								$Files = \Gougnon::mergeArray($Files, explode(';', $this->sources) );

								foreach ($Files as $Key => $File) {

									$FF = \GGN\Path\Protocol::Value($File, true);

									$FF0 = \GGN\Path\Protocol::Value($File, false);


									if(file_exists($FF)){
										
										$Files[$Key] = $FF;
										
									}

									else{

										if(file_exists($FF0)){
											
											$Files[$Key] = $FF0;
											
										}

										else{

											unset($Files[$Key]);

										}
									}
									
								}

							}

						/* Les fichiers Sources / FIN */



						/* Chemins Associés / DEBUT */
						
							foreach ($AssocPaths as $a_key => $a_path) {

								$Path = \GGN\Path\Protocol::Value($a_path);

								if(is_string($this->easePaths) && is_dir($Path) && !\Gougnon::isEmpty($this->easePaths) ){

									$exp = explode(';', $this->easePaths);

									foreach ($exp as $esp) {

										if(file_exists($Path . $esp)){

											$Files[] = $Path;
											
										}
										
									}

								}

								else{

									if(is_file($Path)){

										$Files[] = $Path;								

										// var_dump($Path);

									}

								}

								
							}

						/* Chemins Associés / DEBUT */


						// var_dump($AssocPaths);
						// var_dump($Files); exit;

						return $Files;

					}

					else{

						return false;

					}

				}

			/* Fichiers et Dossiers à prendre en compte / FIN */








			/* Obtention des tables SQL / DEBUT */

				public function GetSQLTables($tables = false){

					global $database;


					if(is_string($tables)){

						$Get = explode(';', $tables);

						$Save = [];


						/* Obtentions des tables / DEBUT */

							foreach ($Get as $Table) {

								foreach($database->GetTableName($Table) as $Tbl){

									$Save[] = $Tbl;

								}
								
							}

						/* Obtentions des tables / FIN */


						/* Requetes SQL des tables selectionnés / DEBUT */

							if(!empty($Save)){

								return $database->Backup($Save, GGNDB_TABLE_STRUCTURE|GGNDB_TABLE_DATA);

							}

						/* Requetes SQL des tables selectionnés / FIN */
						

						/* Aucune donnée retournée / DEBUT */

							else{return false; }

						/* Aucune donnée retournée / FIN */



					}

					return false;

				}

			/* Obtention des tables SQL / FIN */








			/* Intialisation / DEBUT */

				public function Initialize($UpdateTime = false){


					if(

						is_string($this->name) 

						&& is_string($this->type)  

					){


						/* Version du Package */

							$this->upversion = date('ymd.Hi');

							$this->version = ( ( (is_string($this->version) && !\Gougnon::isEmpty($this->version) ) || is_numeric($this->version) ) ? $this->version : '' );



						/* Suppression du packages précédent / DEBUT */

							$OutPutDir = self::OutPutDir();

							$PKGOut = $OutPutDir . $this->name . ((!\Gougnon::isEmpty($this->version)) ? '.' . $this->version : '' ) . '.' . $this->upversion . self::Ext;

							if(is_file($PKGOut)){\GGN\File\Remove($PKGOut); }

						/* Suppression du packages précédent / FIN */



						/* Fichier ou dossier sensible aux dossiers sources */

							$this->easePaths = (isset($this->easePaths)) ? $this->easePaths : false;


						/* Type de package */

							$this->type = (is_string($this->type) && $this->type != 'patch') ? $this->type : 'root';


						/* Dossier Zero */

							$this->Dir = \GGN\Path\Protocol::Value( $this->type . '://');


						/* Obtention des tables */

							$SQLTablesQueries = $this->GetSQLTables($this->tables);



						/* Dossier ou fichier associés aux type de package */

							$AssocPaths = [ $this->type . '://']; 


							$HasAssocPath = $this->GetAssocPaths($this->type);


							if(is_string($HasAssocPath) && !\Gougnon::isEmpty($HasAssocPath) ){

								$AssocPaths = \Gougnon::mergeArray($AssocPaths, explode(';', $HasAssocPath) );

							}


						/* Fichiers et dossier du package / DEBUT */

							$Entries = $this->GetEntries($AssocPaths);

						/* Fichiers et dossier du package / FIN */




						/* Mise en cache / DEBUT */

							if(is_array($Entries) && !empty($Entries)){


								/* Manifest */

									$this->Manifest = [

										'name' => $this->name

										, 'sources' => $this->sources

										, 'easePaths' => $this->easePaths

										, 'version' => $this->version

										, 'update-version' => $this->upversion

										, 'type' => $this->type

										, 'tables' => $this->tables

										, 'time' => time()

										, 'caches' => []

									];


								$CacheFilesDir = self::CacheDir()  . $this->name . '/';

								if(!is_dir($CacheFilesDir)){ \Gougnon::createFolders($CacheFilesDir);}


									// var_dump($Entries ); echo '<br>';


								foreach ($Entries as $CaCount => $Entry) {


									$Caches = new \ZipArchive;

									$CacheFile = $CacheFilesDir . $CaCount . self::CaExt;

										if(is_file($CacheFile)){\GGN\File\Remove($CacheFile); }

									$OpenCaches = $Caches->open($CacheFile, \ZipArchive::CREATE);


									if($OpenCaches === true){

										$Log = [];


										if(is_file($Entry)){

											$stat = stat($Entry);

											if(is_numeric($UpdateTime)){
										
												$lastm = $stat['mtime'];
												
												if($UpdateTime >= $lastm){$expected = false; continue; }

											}

											$CaFileName = \GGN\Path\Protocol::Detect($Entry, false);

											$CacheName = \_GGNCrypt::_sha1($Entry);

											$Caches->addFile($Entry, $CacheName);

											$Log[$CacheName] = [$CaFileName, $stat];

										}

										if(is_dir($Entry) && !\Gougnon::isEmpty($Entry) ){

											$Scan = \Gougnon::iScanFolder($Entry);

											foreach ($Scan as $File) {


												/* Dossier à Exclu / DEBUT */

													if(

														str_replace('\\', '/', substr($File, 0, strlen(__CACHES__))) == str_replace('\\', '/', __CACHES__)

														|| str_replace('\\', '/', substr($File, 0, strlen(__USERS__))) == str_replace('\\', '/', __USERS__)

													){

														continue;

													}

												/* Dossier à Exclu / FIN */


												
												$stat = stat($File);

												if(is_numeric($UpdateTime)){
											
													$lastm = $stat['mtime'];
													
													if($UpdateTime >= $lastm){$expected = false; continue; }

												}

												$CaFileName = \GGN\Path\Protocol::Detect($File, false);

												$CacheName = \_GGNCrypt::_sha1($File);

												$Caches->addFile($File, $CacheName);

												$Log[$CacheName] = [$CaFileName, $stat];

											}

										}


										$this->Manifest['caches'][$CaCount] = $Log;

										$Caches->close();

									}

								}




								/* Creations des tables / DEBUT */

									if(is_string($SQLTablesQueries)){

										$CreateDBTables = \Gougnon::createFile($CacheFilesDir . '.sqlqueries', $SQLTablesQueries);

									}

								/* Creations des tables / FIN */







								/* Creation du Manifest du Cache / DEBUT */

									$CreateCacheManifest = \Gougnon::createFile($CacheFilesDir . '.manifest', json_encode($this->Manifest, \GStorages::JSON_OPT()) );


									if($CreateCacheManifest){


										if(!is_dir($OutPutDir)){ \Gougnon::createFolders($OutPutDir);}


										/* Empaquetage final / DEBUT */

											$Pkg = new \ZipArchive;


											$OpenPkg = $Pkg->open($PKGOut, \ZipArchive::CREATE);


											if($OpenPkg === true){

												$CacheFiles = \Gougnon::scanFolder($CacheFilesDir);

												if(!empty($CacheFiles)){

													foreach ($CacheFiles as $CaFile) {

														$FileName = \GGN\Path\Name::OutBase($CaFile, $CacheFilesDir, false);

														$Pkg->addFile($CaFile, $FileName);

													}

												}


												$Pkg->close();


												/* Suppression du cache / DEBUT */

													foreach ($CacheFiles as $CaF) {

														if(is_file($CaF)){\GGN\File\Remove($CaF); }
														
													}

													rmdir($CacheFilesDir);

												/* Suppression du cache / FIN */
												


												/* Fin de l'opération*/

												$this->OutFile = $PKGOut;

												return true;

											}


											if($OpenPkg !== true){

												return false;

											}


										/* Empaquetage final / FIN */


										return false;

									}



									/* En cas d'Echec / DEBUT */
									
										if(!$CreateCacheManifest){

											return false;

										}

									/* En cas d'Echec / FIN */


								/* Creation du Manifest du Cache / FIN */



							}

							/* En cas d'Echec / DEBUT */

								if(!is_array($Entries) || empty($Entries)){

									return false;

								}

							/* En cas d'Echec / FIN */

						/* Mise en cache / FIN */

							

						return true;


					}


					else{

						return false;

					}


				}

			/* Intialisation / FIN */



		} // Class Creator


	} // if class_exists 'Creator'











	if(!class_exists('\GGN\Package\Installer')){

		/*
			Installer
		*/

		Class Installer extends Invoke{

			var $CacheData = [];

			var $source = false;



			public function __construct($source = false, $downloadThis = false){

				if(is_string($source)){

					$this->source = $source;

					$this->downloadThis = $downloadThis;

				}

			}




			/* Dossiers / DEBUT */

				static public function CacheDir(){

					$Dir = __CACHES__ . '~ggn.packages.installer.caches/';

					if(!is_dir($Dir)){\Gougnon::createFolders($Dir);}

					return $Dir;

				}


			/* Dossiers / FIN */





			/* Obtention du manifest / DEBUT */

				public function GetManifest(){

					if(isset($this->source) && is_string($this->source) && is_file($this->source)){

						$Pkg = new \ZipArchive;

						$OpenPkg = $Pkg->open($this->source);


						if($OpenPkg === true){

							$Content = false;

							try{

								$Content = json_decode($Pkg->getFromName('.manifest'), \GStorages::JSON_OPT());

							}

							catch(Exception $e){}


							$Pkg->close();


							$this->Manifest = $Content;

							return $Content;


						}

						else{

							return false;

						}

					}

					else{

						return false;

					}

				}

			/* Obtention du manifest / FIN */





			/* Initialisation dans le fournisseur / DEBUT */

				public function InitVendor(){

					if( 

						isset($this->Manifest) 

						&& is_array($this->Manifest) 

						&& isset($this->Manifest['name']) 

							&& is_string($this->Manifest['name']) 

						&& isset($this->Manifest['type']) 

							&& is_string($this->Manifest['type']) 

					){

						new \GGN\Using('COM\Vendor');


						$Dir = $this->Manifest['type'] . '/' . $this->Manifest['name'] . '/';


						$Error = false;


						/* Manifest du Package / DEBUT */

							$this->Manifest['itime'] = time();

							if(!\GGN\COM\Vendor\Sheet::Create( $Dir . 'pkg.manifest', $this->Manifest )){$Error = true;}

						/* Manifest du Package / FIN */



						/* Liste des fichiers à desinstaller / DEBUT */

							if(!\GGN\COM\Vendor\Sheet::Create( $Dir . 'pkg.uninstall', [] )){$Error = true;}

						/* Liste des fichiers à desinstaller / FIN */



						return !$Error;

					}

					else{

						return false;

					}

				}

			/* Initialisation dans le fournisseur / FIN */





			/* Installer les requetes SQL / DEBUT */

				public function installSQLQueries(){

					global $database;

					if( isset($this->source) && is_string($this->source) && isset($this->Manifest) && is_array($this->Manifest) && isset($this->Manifest['name']) ){

						$File = self::CacheDir() . $this->Manifest['name'] . '/.sqlqueries';

						if(is_file($File)){

							$Queries = explode(";\n", file_get_contents($File));

							if(!empty($Queries)){

								foreach ($Queries as $key => $Querie) {
									
									$database->Query($Querie);

								}

							}

							return $Queries;

						}

						return true;

					}

					else{return false; }

				}

			/* Installer les requetes SQL / FIN */





			/* Nettoyage des fichiers temporaire / DEBUT */

				public function Clean(){

					if( isset($this->source) && is_string($this->source) && isset($this->Manifest) && is_array($this->Manifest) && isset($this->Manifest['name']) ){

						$this->OCacheDir = self::CacheDir() . $this->Manifest['name'];

						\GGN\File\Remove( $this->source );

						\GGN\Dir\Remove( $this->OCacheDir );

						return true;

					}

					else{return false; }

				}

			/* Nettoyage des fichiers temporaire / FIN */





			/* Initialisation des caches / DEBUT */

				public function InitCaches(){

					if(isset($this->source) && is_string($this->source) && is_file($this->source) && is_array($this->Manifest) && isset($this->Manifest['name']) ){

						$Pkg = new \ZipArchive;

						$OpenPkg = $Pkg->open($this->source);


						if($OpenPkg === true){

							$this->OCacheDir = self::CacheDir() . $this->Manifest['name'];

							$Extractor = $Pkg->extractTo( $this->OCacheDir );

							$Pkg->close();

							return $Extractor;

						}

						else{

							return false;

						}

					}

					else{

						return false;

					}

				}

			/* Initialisation des caches / FIN */





			/* Installation du cache depuis le Package / DEBUT */

				public function Extract($CacheKey){

					if(isset($this->source) && is_string($this->source) && is_file($this->source)){

						$Manifest = $this->GetManifest();


						if(is_array($Manifest) && is_numeric($CacheKey)){

							if(isset($Manifest['caches'])){

								$caches = $Manifest['caches'];

								if(isset($caches[$CacheKey])){

									new \GGN\Using('COM\Vendor');


									$Cache = $caches[$CacheKey];

									$this->OCacheDir = \GGN\Path\Name::Format(self::CacheDir() . $Manifest['name']);

									$this->VendorDir = $this->Manifest['type'] . '/' . $this->Manifest['name'] . '/';


									$UnInstall = \GGN\COM\Vendor\Sheet::Load($this->VendorDir . 'pkg.uninstall' );

										$UnInstall = (is_array($UnInstall)) ? $UnInstall : [];


									foreach ($Cache as $Entry => $Records) {

										$OutPut = (isset($Records[0])) ? \GGN\Path\Protocol::Value($Records[0], false) : false;

										$Stat = (isset($Records[1])) ? $Records[1] : false;

										$CacheFile = $this->OCacheDir . '' . $CacheKey . self::CaExt;


										if(is_file($CacheFile) && is_string($OutPut) && is_array($Stat)){


											$this->CacheData[] = utf8_encode(\GGN\File\Content::Get($CacheFile));

											$Pkg = new \ZipArchive;

											$OpenPkg = $Pkg->open($CacheFile);


											if($OpenPkg === true){

												try{

													$Dir = dirname($OutPut);

													$Data = $Pkg->getFromName($Entry);

													if(!is_dir($Dir)){\Gougnon::createFolders($Dir);}

													\Gougnon::createFile($OutPut, $Data);

													$UnInstall[] = $Records[0];

													$Pkg->close();

												}

												catch(Exception $e){}

											}


										}

									}



									/* Liste des fichiers à desinstaller / DEBUT */

										if(\GGN\COM\Vendor\Sheet::Create( $this->VendorDir . 'pkg.uninstall', $UnInstall )){}

									/* Liste des fichiers à desinstaller / FIN */



									return true;

								}

								else{return false;}

							}

							else{return false;}

						}

						else{return false;}

					}

					else{

						return false;

					}

				}

			/* Installation du cache depuis le Package / FIN */





		} // Class Installer


	} // if class_exists 'Installer'










	if(!class_exists('\GGN\Package\UnInstaller')){

		/*
			UnInstaller
		*/

		Class UnInstaller extends Invoke{


			var $name = false;

			var $type = false;

			var $Response = null;



			public function __construct($name = false, $type = false){

				if(is_string($name) && is_string($type)){

					$this->name = $name;

					$this->type = (!is_string($type) || (is_string($type) && $type == 'patch')) ? 'root' : $type;

				}

			}




			public function Initialize(){


				if(is_string($this->name) && is_string($this->type)){

					new \GGN\Using('COM\Vendor');

					$Manifest = \GGN\COM\Vendor\Sheet::Load($this->type . '/' . $this->name . '/pkg.uninstall');


					$this->type = ($this->type == 'patch') ? 'root' : $this->type;

					
					if(is_array($Manifest)){

						$length = count($Manifest);

						$del = 0;


						foreach ($Manifest as $FileName) {

							$Dir = \GGN\Path\Protocol::Value($FileName, true);

							$File = \GGN\Path\Protocol::Value($FileName, false);


							if(file_exists($Dir)){

								if(\GGN\Dir\Remove($Dir)){$del++;}

							}

							else{

								if(file_exists($File)){

									if(\GGN\File\Remove($File)){$del++;}

								}

							}

					
						}

						\GGN\Dir\Remove( dirname( \GGN\COM\Vendor\Sheet::Path($this->type . '/' . $this->name . '/pkg.uninstall') ) );


						$this->Response = true;

						return true;

					}

					else{$this->Response = false; return false;}

				}

				else{$this->Response = 'uninstall.failed'; return false;}

			}



		} // Class UnInstaller


	} // if class_exists 'UnInstaller'














				








?>