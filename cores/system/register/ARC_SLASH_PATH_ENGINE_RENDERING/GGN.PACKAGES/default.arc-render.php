<?php
	
global $_Gougnon;


if(isset($this->USER) && is_array($this->USER) && $this->USER['ACCOUNT_TYPE'] >= 4){


	$this->UseCaches = false;


	 
	new \GGN\Using('File');
	
	new \GGN\Using('Package');


	// new \GGN\Using('Plugins');

	// new \GGN\Plugin\PHP('ggn.pkg.man.0.1');



	 ini_set('max_execution_time', '120');




	$OutPut = ['response'=>'failed'];

	$OutFile = false;




	/* Paramètres  / DEBUT */
	
		$Do = Register::_REQUEST('do', false);

		$Name = Register::_REQUEST('name', false);

		$Version = Register::_REQUEST('version', false);

		$DownloadThis = Register::_REQUEST('download-this', false);


	/* Paramètres  / FIN */


	$Do = strtolower($Do);


	if(is_string($Do)){







		/* Création / DEBUT */
			
			if($Do == 'create'){

				$Set = [

					'name' => $Name

					, 'version' => $Version

					, 'sources' => Register::_REQUEST('sources', false)

					, 'type' => Register::_REQUEST('type', false)

					, 'easePaths' => Register::_REQUEST('paths', false)

				];


				$Pkg = new \GGN\Package\Creator($Set);


				if($Pkg->Initialize()){

					$OutPut['response'] = 'create.success';

					$OutFile = $Pkg->OutFile;
					
				}

				else{

					$OutPut['response'] = 'create.failed';

				}

			}

		/* Création / FIN */







		/* Construction d'une mise à jour / DEBUT */

			elseif($Do == 'create.update'){

				$date = Register::_REQUEST('date', date('Y-m-d.H:i:s'));

				$cdate = strtotime($date);



				$Set = [

					'name' => $Name

					, 'version' => $Version

					, 'sources' => Register::_REQUEST('sources', false)

					, 'type' => Register::_REQUEST('type', false)

					, 'paths' => Register::_REQUEST('paths', false)

				];


				$Pkg = new \GGN\Package\Creator($Set);


				if($Pkg->Initialize($cdate)){

					$OutPut['response'] = 'updater.success';

					$OutFile = $Pkg->OutFile;

				}

				else{

					$OutPut['response'] = 'updater.failed';

				}

			}

		/* Construction d'une mise à jour / FIN */








		/* Désinstaller / DEBUT */

			elseif($Do == 'uninstall'){


				$Pkg = new \GGN\Package\UnInstaller($Name, Register::_REQUEST('type', 'root'));


				if($Pkg->Initialize()){

					$OutPut['response'] =  ($Pkg->Response == true) ? 'uninstall.success' : null;

				}

				else{

					$OutPut['response'] = $Pkg->Response;

				}

			}

		/* Désinstaller / FIN */








		
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

				echo $Sortie;
				
			}

		/* Mode JSON simple / FIN */






		/* Mode téléchargeable / DEBUT */

			if($DownloadThis && is_string($OutFile) ){

				$TmpFile = $OutFile;

				$TmpFile = __CACHES__ . '~gpk.creator.' . \_GGNCrypt::_sha256($Name . '.' . __IP_UNIQUE__);

				\Gougnon::createFile($TmpFile, $Sortie);

				header('Content-Description: File Transfer');
			    
			    header('Content-Type: application/octet-stream');

			    header('Content-Transfer-Encoding: binary');
			    
			    header('Expires: 0');
			    
			    header('Cache-Control: must-revalidate');
			    
			    header('Pragma: public');
			    
			    header('Content-Length: ' . filesize($OutFile) );
			    
			    header('Content-Disposition: attachment; filename="ggn.installer.cache"');


			    echo \GGN\File\Content::Get($OutFile);

			    \GGN\File\Remove($TmpFile);

			}

		/* Mode téléchargeable / FIN */





	


}



else{

	header(_GGN::HTTP_HEADER_404);

	$this->close();

}


	
	
?>