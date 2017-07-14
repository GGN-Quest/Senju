<?php
	
	$return = false;


	if(isset($args)){

		/* Variables */
		$value = (isset($args[0]))?$args[0]:false;
		$name = (isset($args[1]))?$args[1]:false;
		$path = (isset($args[2]))?$args[2]:'';
		

		/* Si name est du type STRING */
		if(is_string($name) && $value!==false){

			/* Fichier */
			$file = self::getDataFilePath($name, $path);

			if(is_file($file)){
				$reader = self::load($name, $path, true);
				$data = (isset($reader['data']))?$reader['data']:false;
				$option = (isset($reader['option']))?$reader['option']:false;
				$error=false;


				if(is_array($data) && is_array($option)){


					/* Avec stucture */
					if(is_array($option['column'])){
						if(count($value)!=count($option['column'])){$error=true;}
					}


					/* Insertion */
					array_push($reader['data'], $value);



					/* Enregistrement */
					if($error==false){
						$reader['option']['row']++;
						$return = Gougnon::createFile($file, json_encode($reader, self::JSON_OPT()));
					}
					
					if($error==true){$return = null;}

				}

			}



		}


	}



?>