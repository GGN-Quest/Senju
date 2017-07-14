<?php
	
	$return = false;


	if(isset($args)){
		$errorDetector = false;

		/* Variables */
		$name = (isset($args[0]))?$args[0]:false;
		$path = (isset($args[1]))?$args[1]:false;
		

		/* Si name est du type STRING */
		if(is_string($name)){

			/* Fichier */
			$file = self::getDataFilePath($name, $path);

			if(is_file($file)){

				if(\GGN\File\Remove($file)){
					$return = true;
				}

			}


		}


	}



?>