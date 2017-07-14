<?php

	/**
	 * GGN File Invoke
	 *
	 * @version 0.1 
	 * @update 150814.1321
	 * @Require Gougnon Framework
	*/



/*
	Nom de l'espace
*/
namespace GGN\File;
	
	





	/* Using */
	if(!class_exists('\GGN\File\Using')){

		Class Using{

			public function __construct($ns){ $this->object = clone new \GGN\Using($ns); }

		} 

	}



	if(!class_exists('\GGN\Path\Invoke')){

		new \GGN\Using('Path');

	}






	if(!class_exists('\GGN\File\Invoke')){

		/*
			Invoke
		*/
		Class Invoke{

			CONST NAME = 'GGN File';

			CONST VERSION = '170424.1342';


		} // Class Invoke


	} // if class_exists 'Invoke'









	if(!class_exists('\GGN\File\Create')){

		/*
			Create
		*/
		Class Create extends Invoke{

			public function __construct($file = false, $content = false){

				$dir = dirname($file);

				if(!is_dir($dir)){

					\Gougnon::createFolders($dir);

				}

				$this->return = \Gougnon::createFile($file, $content);

			}

		} // Class Create


	} // if class_exists 'Create'









	if(!class_exists('\GGN\File\Content')){

		/*
			Content
		*/
		Class Content extends Invoke{

			/* Obtenir */
			static public function Get($File = false){

				global $GRegister;

				if(is_string($File) && is_file($File)){

					$GRegister->AddToCaches($File);

					return file_get_contents($File);

				}

				else{

					return false;

				}

			}



			/* JSON */
			static public function JSON($File = false){

				global $GRegister;

				$Get = self::Get($File);

				if(is_string($Get)){

					return json_decode($Get, \GStorages::JSON_OPT());

				}

				else{

					return false;

				}


			}




		} // Class Content


	} // if class_exists 'Content'










	if(!class_exists('\GGN\File\Update')){

		/*
			Update
		*/
		Class Update extends Invoke{

			public function __construct($file = false, $content = false){

				if(is_file($file)){

					$c = file_get_contents($file);
					
					$this->return = \Gougnon::createFile($file, $c . $content);

				}
				
				else{

					$this->return = false;

				}

			}

		} // Class Update


	} // if class_exists 'Update'









	if(!class_exists('\GGN\File\Path')){

		/*
			Path
		*/
		Class Path extends Invoke{

			public function __construct($File = false){

				$this->return = $this->Name($File);

			}

			static public function Name($File = false, $Merge = false){

				return \GGN\Path\Name::Get($File, $Merge);

			}

		} // Class Path


	} // if class_exists 'Path'









	if(!function_exists('\GGN\File\Remove')){

		/*
			Remove
		*/
		function Remove ($File = false){


			if(is_string($File) && is_file($File) ){

				$tFile = \GGN\Path\Protocol::Value($File, false);

				// // $Detect0 = \GGN\Path\Protocol::Detect($File, false);

				// $In = false;

				// foreach ( (new \GGN\System\Bases())->_FILES as $Except) {

				// 	if($tFile == \GGN\Path\Protocol::Value($Except, false)){$In = true;break;}
					
				// }

				// if($In == false){

					return unlink($tFile);

				// }

				// if($In != false){return false;}

			}

			else{return false;}

		}


	} // if function_exists 'Remove'

















				








?>