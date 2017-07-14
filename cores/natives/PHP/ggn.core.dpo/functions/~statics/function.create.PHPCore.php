<?php
	
	$return = false;


	if(isset($args)){

		/* Variables */
		$name = (isset($args[0]))?$args[0]:false;
		// $value = (isset($args[1]))?$args[1]:'';
		$path = (isset($args[1]))?$args[1]:'';
		$column = (isset($args[2]))?$args[2]:false;
		

		/* Si name est du type STRING */
		if(is_string($name)){

			/* Dossier */
			$dir = self::dataDir() . $path . '/';
			if(!is_dir($dir)){Gougnon::createFolders($dir);}


			/* Fichier */
			$content = self::initializeUnit($column);
			$file = self::getDataFilePath($name, $path);


			/* Génération du fichier de stockage de donnée */
			$return = Gougnon::createFile($file, json_encode($content));


		}


	}



?>