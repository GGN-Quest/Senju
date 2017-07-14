<?php

	/**
	 * GGN Caches Invoke
	 *
	 * @version 0.1 
	 * @update 161228.0744
	 * @Require Gougnon Framework
	*/



/*
	Nom de l'espace
*/
namespace GGN\Caches;
	
	





	/* Using */
	if(!class_exists('\GGN\Caches\Using')){
		Class Using{
			public function __construct($ns){ $this->object = clone new \GGN\Using($ns); }
		} 
	}








	if(!class_exists('\GGN\Caches\Invoke')){

		/*
			Invoke
		*/
		Class Invoke{


			/*
				Version
			*/
			const VERSION = '0.1';

			const UPDATE = '161228.0744';


			/*
				Extension du fichiers cache
			*/
			const EXT = '.ggn-cache';



			/*
				Nom du cache
			*/
			var $Name;


			/*
				Chemin du fichier sur le serveur 
					ou 
				Contenu à metre en cache
			*/
			var $Data;


			/*
				Atouts
			*/
			var $Assets;


			/*
				Fichier Cache
			*/
			var $Cache;



			/*
				'HASH' des fichiers
			*/
			var $__HASH = ['File'=>[], 'Hash'=>[]];



			/*
				Si le "hash" a changé
			*/
			var $HashChanged = false;



			/*
				Utilisation du cache en général (TRUE : Oui, FALSE : Non)
			*/
			var $UseCaches = true;




			// public function __construct($dir = '' ,$path = false, $name = false, $update = false)

			public function __construct(array $settings = []){

				extract($settings);

				global $GRegister;



				$Assets = new \_GGNCustomObject();

				foreach ($settings as $var => $value) {

					$Assets->{ucfirst($var)} = $value;
					
				}


				$Assets->Dynamic = (isset($Assets->Dynamic)? $Assets->Dynamic: false);


				// $Assets->Type = $type;

				// $Assets->Dir = $dir;

				$Assets->Name .= (is_string(__HTTP_REFERER__) ? ':' . (__HTTP_REFERER__) . ':' : "");

				$Assets->Name .= (is_array($GRegister->USER) ? $GRegister->USER['UKEY'] : "");

				// $Assets->Data = $path;

				// $Assets->Update = $update;

				// $Assets->Hash = $this->GetHash($Assets->Data, $Assets->Type);



				$this->Name = '$' 
					
					. \_GGNCrypt::_sha256($Assets->Name, 1) 
					
					. (is_string($Assets->Update)? ';update=' . $Assets->Update: '')

					. (($Assets->Dynamic===true) ? ';OS=' . trim(PHP_OS) : '')

					. (($Assets->Dynamic===true) ? ';browser=' . CLIENT_BROWSER : '')

					. (($Assets->Dynamic===true) ? ';ajax=' . ((\GGN\DPO\UsesAjax()) ? '1' : '0') : '')

					. (($Assets->Dynamic===true) ? ';ip=' . __IP__ : '')
					
					. ';ship' 
					
					. self::EXT

				;


				$this->Assets = $Assets;

			}




			public function GetHash($f = false, $type = '-text'){


				$d = ($type=='-file') ? (is_file($f) ? file_get_contents($f) : '') : $f;

				$h = \_GGNCrypt::_sha256($d, 1);


				return $h;

			}






			public function Create($data = false){

				$f = $this->Cache;

				$data = (is_string($data)) ? $data : $this->Assets->Data;

				$d = dirname($f);

				if($this->UseCaches == true){
					

					if(!is_dir($d)){

						\Gougnon::createFolders($d);

					}


					$to = new \_GGNCustomObject();

					$to->Hash = implode('|', $this->__HASH['Hash']);
					
					$to->Files = implode('|', $this->__HASH['File']);
					
					$to->Data = $data;


					if($this->Assets->Type == '-file'){

						$to->Data = file_get_contents(str_replace("\n", "<ggn-cache:br>", $data));

					}


					return \Gougnon::createFile($f, json_encode($to, \GStorages::JSON_OPT()) ); 

				}

				else{

					return true;

				}

			}







			public function Load(){

				$f = $this->Cache;

				$data = false;

				if(is_file($f)){

					$this->Data = json_decode(file_get_contents($f), \GStorages::JSON_OPT());

					$data = isset($this->Data['Data']) ? str_replace("<ggn-cache:br>", "\n", $this->Data['Data']) : false;

				}

				return $data;

			}






		} // Class Invoke


	} // if class_exists 'Invoke'









	if(!class_exists('\GGN\Caches\Tmp')){

		/*
			Tmp
		*/
		Class Tmp extends Invoke{

			Const Path = 'cache://';


			static public function Data($path = false, $exec = false, $ins = false){

				if(is_string($path)){

					$file = \Gougnon::getPathFromProtocol( self::Path . 'tmp.browser=' . CLIENT_BROWSER . ';ip=' . __IP__ . ';channel=' . \_GGNCrypt::_sha256($path, 1) . self::EXT);


					if(is_callable($exec)){

						$exec($file);

					}


					$is = is_file($file);


					if($is===true){

						$r = file_get_contents($file);

						\GGN\File\Remove($file);

					}

					if($is===false){


						if($ins===true){

							$r = $file;

							\Gougnon::createFile($file);

						}

						else{

							$r = null;

						}

					}

					return $r;

				}


				return false;

			}



		} // Class Tmp


	} // if class_exists 'Tmp'









	if(!class_exists('\GGN\Caches\Passive')){

		/*
			Passive
		*/
		Class Passive extends Invoke{

			Const Path = 'cache-passive://';


			public function addHash($file = false){

				if(is_string($file) ){

					array_push($this->__HASH['File'], $file);

					array_push($this->__HASH['Hash'], $this->GetHash($file, '-file') );
				}

				return $this;

			}




			public function GetCacheFile(){

				return \Gougnon::getPathFromProtocol(self::Path . $this->Assets->Dir . '/' . $this->Name);

			}




			public function Memorize(){

				$this->Cache = $this->GetCacheFile();

				$D = $this->Load();

				if(
					is_array($this->Data)

					&& isset($this->Data['Files']) && is_string($this->Data['Hash']) 

					&& isset($this->Data['Hash']) && is_string($this->Data['Hash']) 

					&& isset($this->Data['Data']) && is_string($this->Data['Data']) 

				){

					$files = explode('|', $this->Data['Files']);
					
					$hash = explode('|', $this->Data['Hash']);

					$reset = false;


					foreach ($files as $k => $file) {

						if(isset($hash[$k]) ){

							if($hash[$k] != $this->GetHash($file, '-file') || !is_file($file) ){

								$reset = true; break;

							}

						}
						
					}

					return ($reset === true) ? false : str_replace("<ggn-cache:br>", "\n", $this->Data['Data']) ;

				}


				return false;

			}




			public function Hash(){


				$this->Cache = $this->GetCacheFile();

				$this->Load();

				// $this->HashCache = $this->GetHash($this->Cache, '-file');

				$this->CacheExists = is_file($this->Cache);

				$files = explode('|', $this->Data['Files']);
				
				$hash = explode('|', $this->Data['Hash']);

				

				

				if($this->UseCaches == true){


					if(is_array($files) && is_array($hash) ){


						$_files = $this->__HASH['File'];

						$_hash = $this->__HASH['Hash'];



						$nfiles = count($files);

						$nhash = count($hash);



						$_nfiles = count($_files);

						$_nhash = count($_hash);




						if(($nfiles==$nhash) && ($_nfiles==$_nhash) && ($nfiles==$_nfiles)){


							foreach ($files as $k => $file) {
								
								if(($file == $_files[$k]) && ($hash[$k] == $_hash[$k]) ){  /* Verification des fichiers : && is_file($file) && is_file($_files[$k]) */

								}

								else{

									$this->HashChanged = true;

									break;

								}

							}

						}

						/* Hash a changé */
						else{

							$this->HashChanged = true;

						}

					}



					else{

						/* Aucun fichier temporaire */
						if($this->CacheExists===false){

							$this->HashChanged = true;

						}

					}


				}

				else{

					$this->HashChanged = true;

				}

				return $this->HashChanged;

			}



		} // Class Passive


	} // if class_exists 'Passive'





				






