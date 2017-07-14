<?php
	
global $_Gougnon;
	
	


	
	/* Extraction du fichier à télécharger // DEBUT  */

		$f = explode('/', $this->gFile);

			unset($f[0]);

		$l = array_reverse($f);

		$file = __DOWNLOADABLES__ . implode('/', $f);

	/* Extraction du fichier à télécharger // FIN  */



	// exit('Data returned');



	if(Gougnon::isEmpty($file)){

		header(_GGN::HTTP_HEADER_404);

		$this->close();

	}



	$GetVersion = substr_count(basename($file), 'version:') > 0;

	$filename = basename($file);





	if($GetVersion === true){


		$fle = basename($file);

		$xfle = explode(':', $fle);

		$gver = strtolower(isset($xfle[1]) ? $xfle[1] : 'latest');

		$Version = $gver;


		$dir = dirname($file);

		if(is_dir($dir)){


			$Scan = \Gougnon::scanFolder($dir);


			$filename = basename($dir) . '.';



			if($gver == 'latest' || $gver == 'first'){

				$fls = [];

				$ver = [];


				foreach ($Scan as $f) {

					preg_match_all('!\d+!', basename($f), $ffle);

					array_push($fls, $f );

					array_push($ver,  implode('', $ffle[0]));
					
				}


				$choose = ($gver == 'latest') ? max($ver) : min($ver);

				$k = array_search($choose, $ver);

				$file = $fls[$k];



				$GiVersion = explode('.', basename($file));

				$Version = substr(basename($file), 0, -1 * (strlen(end($GiVersion))) - 1 );

			}



			if($gver != 'latest'){

				preg_match_all('!\d+!', $gver, $fgver);

				$ngver = implode('', $fgver[0]);

				foreach ($Scan as $f) {

					preg_match_all('!\d+!', basename($f), $ffle);

					$nver = implode('', $ffle[0]);

					if($ngver == $nver){

						$file = $f;

					}
					
				}


			}


			// $Version = $file;

			$filename .= basename($file);

		}



		else{

			header(_GGN::HTTP_HEADER_404);

			\_GGN::wCnsl('<h1>Dossier directeur Introuvable</h1>');

			$this->close();

		}


	}





	if(!is_file($file)){

		header(_GGN::HTTP_HEADER_404);

		\_GGN::wCnsl('<h1>Fichier Introuvable</h1>');

		$this->close();

	}



	/* Mise à jour du Meta // DEBUT */

		// $meta = new RegisterMeta($file);

		// $meta->Update('counter', 1, RegisterMeta::INCVALUE);

		// $meta->Save();

	/* Mise à jour du Meta // FIN */


	/* Mise en place de téléchargeur */
	header(_GGN::HTTP_HEADER_200);

	header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');

    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('File-Version: ' . $Version);
    header('Content-Length: ' . filesize($file));
    header('Content-Disposition: attachment; filename="' . $filename . '"');

	echo readfile($file);





?>