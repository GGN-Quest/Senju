<?php

	$return = false;
	

if(is_object($context) && isset($context->Infos) && is_object($context->Infos)){


	/* Dossier des log */
	$lg = __CORES_SYSTEM_COM_LOG__;



	/* Fichier Log de l'Application */
	$return = $lg . 'apps/' . $context->Infos->Key . '.log';;



}



?>