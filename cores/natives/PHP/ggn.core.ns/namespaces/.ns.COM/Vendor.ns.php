<?php

	/**
	 * GGN COM Invoke
	 *
	 * @version 0.1 
	 * @update 170122.1612
	 * @Require Gougnon Framework
	*/



/*
	Nom de l'espace
*/
namespace GGN\COM\Vendor;
	
	

	
	new \GGN\Using('File');





	if(!class_exists('\GGN\COM\Vendor\Invoke')){

		/*
			Invoke
		*/
		Class Invoke{

			CONST Path = 'vendor://';



		} // Class Invoke


	} // if class_exists 'Invoke'








	if(!class_exists('\GGN\COM\Vendor\Sheet')){

		/*
			Sheet
		*/
		Class Sheet extends Invoke{



			static public function Create($Path = false, $Content = []){

				if(is_string($Path) && (is_array($Content) || is_object($Content)) ){


					$File = \GGN\Path\Name::Format( \GGN\Path\Protocol::Value(self::Path) ) . $Path . '.json';

					$Dir = dirname($File);

					if(!is_dir($Dir)){\Gougnon::createFolders($Dir);}


					return (\Gougnon::createFile($File, json_encode($Content, \GStorages::JSON_OPT() ) ) ) ? true: false;

				}

			}



			static public function Path($Path = fals){

				if(is_string($Path) ){

					return \GGN\Path\Name::Format( \GGN\Path\Protocol::Value(self::Path) ) . $Path . '.json';

				}

			}



			static public function Load($Path = fals){

				if(is_string($Path) ){

					$File = \GGN\Path\Name::Format( \GGN\Path\Protocol::Value(self::Path) ) . $Path . '.json';

					if(is_file($File)){

						try{

							return json_decode( \GGN\File\Content::Get($File) , \GStorages::JSON_OPT() );
							
						}

						catch(Exception $e){

						}


						return false;

					}
					
					else{

						return false;

					}


				}

			}





		} // Class Sheet


	} // if class_exists 'Sheet'
















				








?>