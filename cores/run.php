<?php
/*
	Copyright 2013 GOBOU Y. Yannick
======================================================
	FICHIER 'cores/run.php'
======================================================

*/  

	@session_start();
	
	$_SESSION['GGN_ID_SESSION'] = trim( (isset($_SESSION['GGN_ID_SESSION'])) ? $_SESSION['GGN_ID_SESSION'] : sha1(date('YmdHis')) ); 
	


	define('PHP_VERSION_AVAILABLE', '5.3');
	
	define('GGN_ID_SESSION',  $_SESSION['GGN_ID_SESSION']);

	
	
	/* Parametres */
	$_Gougnon = array();

	$_GougnonDB = array();

	$Native = array();
	
	$GGNCoresPath = dirname(__FILE__);


	$_VARS = [];

	
	require $GGNCoresPath . '/settings.root.php';
	
	
	
	
	/* Class Native */
	require $GGNCoresPath . '/native.core.interface.php';
	
	require $GGNCoresPath . '/native.cores.php';
	
	
	if(_GGN::versionValidate(PHP_VERSION, PHP_VERSION_AVAILABLE)!==true){
	
		_GGN::wCnsl('<b>'._GGN::_SYSTEM_NAME.'</b> est compatible avec <b>PHP '.PHP_VERSION_AVAILABLE.'</b> au minimum.<br>votre version de PHP est '.PHP_VERSION);
	
	}
	
	
	
	
	/* Chargement des Noyaux PHP */
	$Gougnon 		= _GGN::PHPCore('ggn.core');
	
	$GStorages 		= _GGN::PHPcore('ggn.core.storages');
	
	$GVariables 	= _GGN::PHPcore('ggn.core.variables');
	
	$GRegister 		= _GGN::PHPCore('ggn.core.register');
	
	$GNameSpace		= _GGN::PHPCore('ggn.core.ns');
	

	
	
	
	/* Constantes */
	require $GGNCoresPath . '/settings.constantes.php';
	
	
	
	
	
	/* Chargement de langue */
	$GLANG = _GGN::loadLang(_LANG_ . '/GougnonRT.ini');
	
	
	
	
	/* Class Native Base de Donnée */
	require $GGNCoresPath . '/native.database.php';
	
	
	
	
	
	/* Connexion Base de donnée */
	if(!isset($database)){_GGN::wCnsl('Classe base de donnée introuvable');}
	
	
	
	
	
	require $GGNCoresPath . '/settings.variables.php';
	

	
	/* DPO */
	
	$DPO			= new \GGN\Using('DPO');
	
	$DPODevice		= new \GGN\Using('DPO\Device');
	
	$DPODriver		= new \GGN\Using('DPO\Driver');



	
	


	/* Chargement des Plugins PHP */

	// $Gougnon::loadPlugins(
	// 	'PHP/designPackage.Object'
	// );

	


	$GSystem 		= Gougnon::System();
	
	$GUsers			= _GGN::PHPCore('ggn.core.users');
	






	/* Variable & Constantes addtionnelle */

	$_DPO_DEVICE = new \GGN\DPO\Device();
	
	define('CLIENT_BROWSER', $_DPO_DEVICE->name);




	/* NameSpace pré-require */
	
	new \GGN\Using('System');

	new \GGN\Using('Path');

	new \GGN\Using('File');

	new \GGN\Using('Dir');

	

	
	
?>