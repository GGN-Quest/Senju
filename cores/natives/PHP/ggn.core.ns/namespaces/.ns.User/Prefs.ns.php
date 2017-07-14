<?php

	/**
	 * GGN User Prefs
	 *
	 * @version 1.2
	 * @update 150910.0900
	 * @Require Gougnon Framework
	*/




/*
	Nom de l'espace
*/
namespace GGN\User\Prefs;
	


	if(!class_exists('\GGN\User\Prefs\Invoke')){
			
		Class Invoke {
				
			const NAME = 'Gougnon User Préférence';
			
			const VERSION = '0.1';
			
			const UPDATE = '170529.1015';



			const _DIRNAME = '.prefs/';

			const _Ext = '.ggn-pref';



			// static public function CookieName($Path = false){

			// 	return \_GGNCrypt::_sha256('ggn.user.Prefs.' . ((is_string($Path)) ? $Path : 'default'), 1);

			// }


			static public function Path($UserName = false){

				global $GRegister;

				$Path = __USERS__;


				if(is_string($UserName)){$Path .= $UserName . '/'; }

				if(!is_string($UserName)){

					if(is_array($GRegister->USER)){$Path .= '$' . $GRegister->USER['USERNAME'] . '/'; }

					else{$Path = false;}

				}

				return ($Path == __USERS__) ? false : $Path;

			}



		} // Class 'Invoke'


	} // If class exists 'Invoke'






	if(!class_exists('\GGN\User\Prefs\Sheet')){
			
		Class Sheet extends Invoke {
				
			const NAME = 'Gougnon User Préférence Feuille';
			
			const VERSION = '0.1';
			
			const UPDATE = '170529.1015';




			static public function Get($Name = false, $UserName = false){

				global $GRegister;


				if(is_string($Name)){

					$Path = self::Path($UserName);

					if(is_string($Path) && is_dir($Path)){

						$Path .= self::_DIRNAME;

						$Path .= $Name . self::_Ext;

						return \GGN\File\Content::JSON($Path);

					}


				}


				return false;

			}





			static public function Set($Name = false, $Value = false, $UserName = false){

				global $GRegister;


				if(is_string($Name)){

					$Path = self::Path($UserName);

					var_dump($Path);

					if(is_string($Path) && is_dir($Path)){

						$Path .= self::_DIRNAME;

						$Path .= $Name . self::_Ext;


						$Data = (is_file($Path)) ? \GGN\File\Content::JSON($Path) : [];


						$nValue = \Gougnon::mergeArray($Data, $Value, true);


						if(!is_dir(dirname($Path))){\Gougnon::createFolders(dirname($Path));}

						$Create = \Gougnon::createFile($Path, json_encode(is_array($nValue) ? $nValue : []));

						return ($Create) ? $nValue : false;

					}


				}

				return false;

			}



		} // Class 'Sheet'


	} // If class exists 'Sheet'




