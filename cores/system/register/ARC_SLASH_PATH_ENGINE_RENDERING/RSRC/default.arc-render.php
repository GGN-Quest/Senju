<?php

/*
	Copyright GOBOU Y. Yannick
	
*/


	/*
		Classe utile pour les ressources 
		du système et des utilisateurs 
	*/

	GSystem::requires('util.rsrc');

	$_RSRC = new GGN_UTIL_RSRC($this);





	/*
		
		Extension du fichier

	*/
	$ext = Register::_REQUEST('ext', '');
	






	/*
		
		Paramètres pour retrouver le fichier

	*/

	$ex = explode('/', $this->gFile);

	$user = (isset($ex[1])) ? $ex[1]: '';

	$type = (isset($ex[2])) ? $ex[2]: false;

	$file = implode('/',\Gougnon::arrayValues($ex,3));


	$file .= '.' . $ext;




	if(is_string($user) && is_string($type)  && is_string($file) ){


		/*
		
			Utilisateur : Ressources sur le serveur

		*/

			$dir = GUSERS::dataDir($user, '%' . strtoupper($type) . '%');

			$path = $dir . $file;



		if(file_exists($path)){

			if(is_file($path)){

				$mime = (new GGN_UTIL_RSRC($path))->MimeType();
				
				$mimx = explode('/', $mime);

				header('Content-Type:' . $mime);
				


				/* Ouverture des Images */

				if($mimx[0]=='image'){

					if(isset($mimx[1])){

						$type = $mimx[1];

						$ttype = strtoupper($type);

						$this->file = $path;
						
						$this->requireARCRender('.' . $ttype . '/images' . $ttype);

					}

					else{

						readfile($path);
						
					}
					

				}

				else{

					readfile($path);
					
				}


			}

			else{

				$boot = $path . '/boot.php';

				if(is_file($boot)){

					include $boot;

				}

				else{

					$this->eventOn('ERROR.404');

					$this->close();

				}

			}

		}


		else{

			$this->eventOn('ERROR.404');

			$this->close();

		}









	}


	else{

		$this->eventOn('ERROR.404');

		$this->close();

	}



	

?>