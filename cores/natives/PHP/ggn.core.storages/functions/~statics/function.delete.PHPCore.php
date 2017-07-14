<?php
	
	$return = false;


	if(isset($args)){
		$errorDetector = false;

		/* Variables */
		$where = (isset($args[0]))?$args[0]:false;
		$name = (isset($args[1]))?$args[1]:false;
		$path = (isset($args[2]))?$args[2]:false;
		

		/* Si name est du type STRING */
		if(is_string($name) && $where!==false){

			/* Fichier */
			$file = self::getDataFilePath($name, $path);

			if(is_file($file)){
				$reader = self::load($name, $path, true);
				$data = (isset($reader['data']))?$reader['data']:false;
				$option = (isset($reader['option']))?$reader['option']:false;
				$column = (isset($option['column']))?$option['column']:false;
				$error=true;



					/* Avec stucture */
					$line=[];
					$colkey=[];
					$isColumn = is_array($column);

					if($isColumn===true){
						// $whr=false;

						/* Les clés de référence */
						foreach ($column as $key => $col) {
							$colkey[$col] = $key;
						}


						/* Toutes les Données */
						foreach ($data as $kr => $d){
							foreach ($where as $ky => $v) {

								/* La clé d'entré du 'where' */
								if(isset($colkey[$ky])) {
									$kd = $colkey[$ky];

									if(isset($d[$kd])){

										if($v==$d[$kd]){
											unset($reader['data'][$kr]);
											$error=false;
										}
									}

								}
							}

						}


							

					}

					if($isColumn===false){

						/* Données de remplacement */
						if(isset($data[$where])){
							$reader['data'][$where] = $value;
							$error=false;
						}

					}


					if($error==false){
						$reader['footer']['last-update'] = time();
						$return = Gougnon::createFile($file, json_encode($reader, self::JSON_OPT()));
					}
					
					if($error==true){$return = null;}


			}


		}


	}



?>