<?php
	
	$return = false;


	if(isset($args)){
		$errorDetector = false;

		/* Variables */

		$value = (isset($args[0]))?$args[0]:false;
		
		$where = (isset($args[1]))?$args[1]:false;
		
		$name = (isset($args[2]))?$args[2]:false;
		
		$path = (isset($args[3]))?$args[3]:'';
		

		/* Si name est du type STRING */
		if(is_string($name) && $value!==false && $where!==false){

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
					$isColumn = is_array($column);
					if($isColumn===true){

						/* Lister le '$data' par ligne */
						foreach ($data as $dk => $dv) {
							
							$whr=true;
							
							if(is_array($where)){

								/* 
									Concordance des valeurs à partir desquelles 
									la mise à jour de ligne doit etre effectué 
								*/
								foreach ($where as $wk => $wv) {
									$whr = false;
									
									/*
										Verifie si la clé à partir de laquelle
										la mise à jour sera faite est valide 
									*/
									if(isset($dv[$wk])){

										/*
											Verifie si la clé à partir de laquelle
											la mise à jour est egale à la valeur de 
											la meme clé dans la lign de '$data' 
										*/
										if($dv[$wk] == $wv){
											$whr = true;
											continue; // entrée suivante
										}
										else{
											break; // stop
										}

									}
									else{
										break; // stop
									}

								}
							}



							if($whr===true){

								foreach ($value as $vk => $vd) {

									/* 
										Mise à jour 
									*/
									$reader['data'][$dk][$vk] = $vd;

									/*
										Désactivé le mode 'ERREUR'
									*/
									$error=false;

								}

							}



						}


					}


					/* Sans structure */
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