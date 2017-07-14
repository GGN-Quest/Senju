<?php
	
	$return = false;


	if(isset($args)){

		new \GGN\Using('File');

		/* Variables */
		$name = (isset($args[0]))?$args[0]:false;
		$path = (isset($args[1]))?$args[1]:'';
		$opt = (isset($args[2]))?$args[2]:false;
		

		/* Si name est du type STRING */
		if(is_string($name)){

			/* Fichier */
			$file = self::getDataFilePath($name, $path);


			if(is_file($file)){
				${self::DVAR} = false;



				/* Chargement de la table */
				// $json = file_get_contents($file);
				$json = \GGN\File\Content::Get($file);
				$reader = json_decode($json, self::JSON_OPT());

				/* Lecture */
				$return = $reader;


			}



		}


	}



?>