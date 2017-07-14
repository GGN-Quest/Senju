<?php
	
	$return = false;


	if(isset($args)){

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
				include $file;


				$reader = (isset(${self::DVAR}))?${self::DVAR}:false;
				$data = (isset($reader["data"]))?$reader["data"]:false;
				$output = false;


				if(is_array($data)){
				
					/* Recherche de structure dans la table */
					$gc = self::getDataColumn($reader);
					
	
					/* Table Avec Structure */
					if($gc!=false){
						$output = [];
						foreach ($data as $field => $column) {
							$output[$field] = (isset($output[$field]))?$output[$field]:[];
							
							if(is_array($column)){
								foreach ($column as $key => $value) {
									$output[$field][] = json_decode($value, self::JSON_OPT());
								}
							}

						}
	
					}
	
	
	
					/* Table Sans Structure */
					if($gc===false){
						$count = count($data);
	
						/* On retourne du contenu vierge */
						if($count==0){
							$output = [];
						}
	
						/* On retourne le contenu d'une table de donnée */
						if($count>0){
							$output = [];
							foreach ($data as $key => $value) {
								$output[] = self::inputDecoder($value);
							}
						}
	
	
	
					}
				}


				/* Lecture */
				$return = ($opt===true)?['option'=>self::inputDecoder($reader['option']), 'data'=>$output]: $output;


			}



		}


	}



?>