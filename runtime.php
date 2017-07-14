<?php 
/*
	Copyright 2013 GOBOU Y. Yannick
======================================================
	FICHIER 'runtimes.php'
======================================================

*/
	
	REQUIRE_ONCE dirname(__FILE__) . '/cores/run.php';
	
	if(!class_exists('Register')){exit('Class "Register" introuvable');}

	if(!isset($GRegister)){exit('La déclaration de "Register" est introuvable');}
	
	$GRegister->Invoke('GET', Register::REQUEST_RUNTIME);

	$GRegister->SetMode('-debug'); /* Mode d'utilisationlimit (-debug/-release) */

	$GRegister->Rendering('-g auh');
	
	
?>