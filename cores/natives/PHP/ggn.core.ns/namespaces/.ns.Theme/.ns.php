<?php

	/**
	 * GGN Theme Invoke
	 *
	 * @version 0.1 
	 * @update 170101.1851
	 * @Require Gougnon Framework
	*/



/*
	Nom de l'espace
*/
namespace GGN\Theme;
	
	

	if(!class_exists('\GGN\Path\Invoke')){

		new \GGN\Using('Path');

	}



	if(!class_exists('\GGN\Theme\Invoke')){

		/*
			Invoke
		*/
		Class Invoke{

			const PATH = "theme://";

		} // Class Invoke


	} // if class_exists 'Invoke'

	



	if(!class_exists('\GGN\Theme\Local')){

		/*
			Local
		*/
		Class Local extends Invoke{


			var $Name = false;

			var $Path = false;


			public function __construct($Name = false){

				$Ex = explode('://', $Name);

				$this->Name = \GGN\Path\Name::Format( (isset($Ex[1])) ? $Name : (self::PATH . $Name) );

				$this->Path = \GGN\Path\Protocol::Value(self::PATH);

				$this->manifest = false;

			}


			public function Manifest(){

				if(is_string($this->Name) && is_string($this->Path)){

					$DPO = new \GGN\DPO\Theme\Preset($this->Name, true);

					$this->manifest = new \_GGNCustomObject();

					$this->manifest = \Gougnon::mergeArray($this->manifest, $DPO->manifestTact(true), true);

					$this->DPO = $DPO;

					return ($DPO->hasManifest === true) ? $this->manifest : null;

				}

				return false;
				
			}


			static public function Get(){

				$Path = \GGN\Path\Protocol::Value(self::PATH);

				$Scan = \Gougnon::iScanFolder($Path);

				$Out = [];


				foreach ($Scan as $File) {

					if(basename($File) == \GGN\DPO\Driver::__MANIFEST . \GGN\DPO\Driver::__Ext){

						$Name = basename(dirname($File));

						$Out[] = $Name;

					}
					
				}

				return $Out;

			}


		} // Class Local


	} // if class_exists 'Local'





?>