<?php
	
global $_Gougnon;


if(isset($this->USER) && is_array($this->USER) && $this->USER['ACCOUNT_TYPE'] >= 4){




	 
	new \GGN\Using('File');

	new \GGN\Using('Plugins');

	new \GGN\Plugin\PHP('ggn.pkg.man.0.1');






	$OutPut = ['response'=>'failed'];


	/* Paramètres  / DEBUT */
	
		$Do = Register::_REQUEST('do', false);

		$Name = Register::_REQUEST('name', false);

		$DownloadThis = Register::_REQUEST('download-this', false);


	/* Paramètres  / FIN */


	$Do = strtolower($Do);


	if(is_string($Do)){


		/* Création / DEBUT */
			
			if($Do == 'create'){

				$Set = [

					'name' => $Name

					, 'sources' => Register::_REQUEST('sources', false)

					, 'type' => Register::_REQUEST('type', false)

					, 'paths' => Register::_REQUEST('paths', false)

				];


				$Pkg = new GGNPKG($Set);


				if($Pkg->Create()){

					$OutPut['response'] = 'create.success';

				}

				else{

					$OutPut['response'] = 'create.failed';

				}

			}

		/* Création / FIN */




		/* Construction d'une mise à jour / DEBUT */

			elseif($Do == 'update'){

				$date = Register::_REQUEST('date', date('Y-m-d.H:i:s'));

				$cdate = strtotime($date);



				$Set = [

					'name' => $Name

					, 'sources' => Register::_REQUEST('sources', false)

					, 'type' => Register::_REQUEST('type', false)

					, 'paths' => Register::_REQUEST('paths', false)

				];


				$Pkg = new GGNPKG($Set);


				if($Pkg->Create($cdate)){

					$OutPut['response'] = 'updater.success';

				}

				else{

					$OutPut['response'] = 'updater.failed';

				}

			}

		/* Construction d'une mise à jour / FIN */




		
		/* Action introuvable / DEBUT */

			else{

				$OutPut['response'] = 'action.not.found';

			}

		/* Action introuvable / FIN */


	}



	/* Aucune action / DEBUT */
		
		if(!is_string($Do)){

			$OutPut['response'] = 'no.action';

		}

	/* Aucune action / DEBUT */






	/* Ecriture de la reponse */

		$Sortie = json_encode($OutPut);


		/* Mode JSON simple / DEBUT */

			if(!$DownloadThis){

				echo json_encode($Sortie);
				
			}

		/* Mode JSON simple / FIN */






		/* Mode téléchargeable / DEBUT */

			if($DownloadThis){

				$TmpFile = __CACHES__ . '~gpk.creator.' . \_GGNCrypt::_sha256($Name . '.' . __IP_UNIQUE__);

				\Gougnon::createFile($TmpFile, $Sortie);

				header('Content-Description: File Transfer');
			    
			    header('Content-Type: application/octet-stream');

			    header('Content-Transfer-Encoding: binary');
			    
			    header('Expires: 0');
			    
			    header('Cache-Control: must-revalidate');
			    
			    header('Pragma: public');
			    
			    header('Content-Length: ' . filesize($TmpFile) );
			    
			    header('Content-Disposition: attachment; filename="ggn.installer.cache"');


			    echo readfile($TmpFile);

			    \GGN\File\Remove($TmpFile);

			}

		/* Mode téléchargeable / FIN */





	


}



else{

	header(_GGN::HTTP_HEADER_404);

	$this->close();

}


	
	
?>