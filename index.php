<?php
/*
	Copyright 2013 GOBOU Y. Yannick
======================================================
	FICHIER 'index.php'
======================================================

*/


	REQUIRE_ONCE dirname(__FILE__) . '/cores/autorun.php';
	
	
	if(!class_exists('AutoRun')){exit('Class AutoRun introuvable');}
	
	if(!isset($AutoRun)){exit('La déclaration de "AutoRun" est introuvable');}

	
	$AutoRun->bootOn = (_GGN::varn('BootOn'))?_GGN::varn('BootOn'):false;
	
	// $AutoRun->bootOn = false;
	
	$AutoRun->start();
	
	
?>