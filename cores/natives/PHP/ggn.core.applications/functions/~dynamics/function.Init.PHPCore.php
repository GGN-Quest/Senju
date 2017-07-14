<?php
	
	$return = false;


	if(is_object($context)){



		/* Initialisation de la COM */
		$context->InitializeCOM();



		/* Application */
		$context->Name = $context->GetAppKeyName();
		
		$context->AppName = substr($context->GetAppKeyName(), 0, -1);



		/* Initialisation du Protocole */
		$context->InitializeProtocol();



		/* Chargement du Manifest */
		$context->InitializeManifest();



		/* Initialisation de la COM */
		$context->InitializeUser();
		
		
		
		$return = true;
	}



?>