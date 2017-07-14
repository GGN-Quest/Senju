<?php

namespace GGN\Junctions;

	global $GRegister;

	$GRegister->UseCaches = false;

	

	new \GGN\Using('Junctions');


	$ViewerType = \Register::_REQUEST('viewer-type', false);

	$ViewerMode = \Register::_REQUEST('viewer-mode', '0');

		$ViewerMode = ($ViewerMode == '1') ? true : false;



	$Key = \Register::_GET('key', false);

	$Type = \Register::_GET('type', false);






	if(is_string($Key) && is_string($Type)){

		$Viewer = new Viewer($Key, $Type, $ViewerMode);
		

		$Viewer->Start();

			/* Disposition / DEBUT */

				if($Type == 'layout'){

					$Viewer->Layout();

				}

			/* Disposition / FIN */

		$Viewer->Close(true);




		/* Mode de vue / DEBUT */

			if($ViewerType){

				if($ViewerType == 'json:objects'){

					echo json_encode($Viewer->Transcribed, \GStorages::JSON_OPT());
					
				}

			}

			else{echo $Viewer->Page->code;}

		/* Mode de vue / FIN */


	}

	else{

		\_GGN::wCnsl('<h1>GGN Sense Viewer</h1> Paramètres insuffisantes');

	}



?>