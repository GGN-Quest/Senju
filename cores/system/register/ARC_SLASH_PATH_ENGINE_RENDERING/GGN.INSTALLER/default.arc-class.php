<?php
/*
	Copyright GOBOU Y. Yannick
======================================================
	CLASS GGN_INSTALLER
	PAGE cores/_GGNs/PHP/Register.core.g/ARC_ENGINE_RENDING/GGN.INSTALLER/default.arc-render
======================================================
	
*/

/*
	CLASS 'GGN_INSTALLER'
*/




new \GGN\Using('Plugins');

new \GGN\Plugin\PHP('ggn.pkg.man.0.1');



if(!class_exists('\GGN\File\Path')){

	new \GGN\Using('File');

}




if(!class_exists('ZipArchive')){

	\_GGN::wCnsl('<h1>GGN Installer</h1><br>la classe "ZipArchive" est manquante.');

}





if(!class_exists('GGN_INSTALLER')){


	Class GGN_INSTALLER{




		static public function Initialize($source){

			$Pkg = new GGNPKG([

				'source' => $source

			]);

			return $Pkg->PkgManifest();

		}



		static public function InstallCache($source, $cacheKey = false, $binary = false){


			$Pkg = new GGNPKG([

				'source' => $source

			]);


			$Manifest = $Pkg->PkgManifest();


			if(is_array($Manifest) && is_numeric($cacheKey)){

				if(isset($Manifest['caches'])){

					$caches = $Manifest['caches'];

					if(isset($caches[$cacheKey])){

						$cache = $caches[$cacheKey];

						if($Pkg->Open()){

							return $Pkg->InstallCache($cache, $binary);

						}

						else{return false;}

					}

					else{return false;}

				}

				else{return false;}

			}

			else{return false;}

		}




		static public function GetPrecept($FileName, $Dir = false){

			$Dir = is_string($Dir) ? $Dir : dirname(__FILE__);

			$File = $Dir . '/' . $FileName;

			return (is_file($File)) ? json_decode(file_get_contents($File), GStorages::JSON_OPT()) : false;

		}






	}


}


?>