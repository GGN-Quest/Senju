<?php

	$return = false;
	

if(is_object($context) && isset($context->Infos) && is_object($context->Infos)){

	global $database;


	/* Environnement des fichiers */
	new GGN\Using('File');

	
	/* Contenu du log */
	$txt = (isset($args[0])) ? $args[0]: '';


	/* Données */
	$data = new _GGNCustomObject();

	$data->UKey = (isset($context->Register) && is_array($context->Register->USER)) ? $context->Register->USER['UKEY']: false;

	$data->IP = __IP__;

	$data->ClientHost = __CLIENT_HOST__;

	$data->Referer = __HTTP_REFERER__;

	$data->UserName = $data->IP;

	if(is_string($data->UKey)){

		$data->UserName = $context->Register->USER['USERNAME'];

	}

	$data->URL = \Gougnon::pageUrlSelf();

	$data->Browser = CLIENT_BROWSER;

	$data->UserAgent = $_SERVER['HTTP_USER_AGENT'];

	$data->Time = time();

	$data->Comment = $txt;







	/* Fichier log de l'application */
	$f = $context->COMLogFile();
	$Vef = !is_file($f);

	$dta = json_encode($data, GStorages::JSON_OPT()) . "\n";


	/* Creation du log s'il n'existe pas */
	if($Vef){

		$crupt = new GGN\File\Create($f, $dta);
		// new GGN\File\Create($f, '{ "name":"' . self::NAME . '", "version":"' . self::VERSION . '", "updateVersion":"'.self::REEL_VERSION.'", "COM.Log":true }' . " \n");

	}


	/* Mise a jour du log */
	if(!$Vef){

		$crupt = new GGN\File\Update($f, $dta);


	}


	/* Retour de la mise a jour */
	$return = $crupt->return;



}



?>