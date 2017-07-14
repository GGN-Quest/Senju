<?php

	/**
	 * GGN Dir Invoke
	 *
	 * @version 0.1 
	 * @update 150814.1321
	 * @Require Gougnon Framework
	*/



/*
	Nom de l'espace
*/
namespace GGN\Dir;
	
	





	/* Using */
	if(!class_exists('\GGN\Dir\Using')){
		Class Using{
			public function __construct($ns){ $this->object = clone new \GGN\Using($ns); }
		} 
	}





	if(!class_exists('\GGN\Path\Invoke')){

		new \GGN\Using('Path');

	}





	if(!class_exists('\GGN\Dir\Invoke')){

		/*
			Invoke
		*/
		Class Invoke{



		} // Class Invoke


	} // if class_exists 'Invoke'









	if(!class_exists('\GGN\Dir\Create')){

		/*
			Create
		*/
		Class Create extends Invoke{

			public function __construct($Dir = false){

				$this->return = \Gougnon::createFolders($Dir);

			}

		} // Class Create


	} // if class_exists 'Create'









	if(!class_exists('\GGN\Dir\Path')){

		/*
			Path
		*/
		Class Path extends Invoke{

			public function __construct($Dir = false){

				$this->return = $this->Name($Dir);

			}

			static public function Name($Dir = false, $Merge = false){

				return \GGN\Path\Name::Get($Dir, $Merge);

			}

		} // Class Path


	} // if class_exists 'Path'









	if(!class_exists('\GGN\Dir\Size')){

		/*
			Size
		*/
		Class Size extends Invoke{

			public function __construct($Dir = '', $All = false){

				$Scan = ($All===false)?\Gougnon::scanFolder($Dir) : \Gougnon::iScanFolder($Dir);

				$Size = 0;

				foreach($Scan as $file){
					if(is_file($file)){
						$Size += filesize($file);
					}
				}

				$this->Value = $Size;

			}

		} // Class Size


	} // if class_exists 'Size'









	if(!function_exists('\GGN\Dir\Remove')){

		/*
			Remove
		*/
		function Remove ($Dir = false){

			if(is_string($Dir) && is_dir($Dir)){

				$Scan = \Gougnon::iScanFolder($Dir);

				if(count($Scan) > 0){

					foreach($Scan as $file){

						if(is_file($file)){

							\GGN\File\Remove($file);

						}

					}

				}


				if( rmdir($Dir) ){

					return true;

				}


				return false;

			}

		}


	} // if function_exists 'Remove'









				






