<?php

	$return = false;
	



if(is_object($context) && isset($context->Infos) && is_object($context->Infos)){


	if($context->Infos->Available != true){

		_GGN::wCnsl('<h1>Erreur GAPPS</h1> Application désactivée');

	}

	$context->path = $context->Infos->Path;

	$context->Location = (isset($context->path)) ? $context->path: false;
	
	$context->Location = (substr(ltrim(rtrim($context->Location)), -1)=='/')?$context->Location: $context->Location . '/';
	

	$context->appCodeNameConcatenate = explode('://', $context->Location);

	if(isset($context->appCodeNameConcatenate[1])){

		// if(isset($context->Arguments[2])){
		// 	if(is_array($context->Arguments[2])){
		// 		foreach ($context->Arguments[2] as $key => $value) {
		// 			$context->{$key}=$value;
		// 		}
		// 	}
		// }

		
		if(is_object($context->Register)){
			$context->AppInstance = $context->Register->_REQUEST('gapp-instance');
		}



		$context->Core = new _GGNCustomObject();

		$context->Core->CSS = _GGN::CSSCore('ggn.core');

		$context->Initialize();

		$context->InitializeParams();

		$context->_cssFiles = [];

		$context->_jsFiles = [];

		$context->Params->MockUpLayoutMode = APPMockUpNormal;
		

		$context->InitializeMain();

		$Exec = self::GetExec($context->Key);

		$isExec = is_file($Exec);


		$context->COMLog();





		/* Chemin du dossier Maquette */
		$context->MockUpPath = $context->Path . 'assets/mockup/';


		

		if($isExec){

			include $Exec;

		}
		
		if(!$isExec){

			 _GGN::wCnsl('<h1>Erreur GAPPS</h1> Aucun executeur trouvé');

		}
		
	}


}


else{
	if(isset($context->NoEventOnAppsNotFound) && is_bool($context->NoEventOnAppsNotFound) && $context->NoEventOnAppsNotFound===true){}
	else{_GGN::wCnsl('<h1>Erreur GAPPS</h1> Application Introuvable'); }
	
}


?>