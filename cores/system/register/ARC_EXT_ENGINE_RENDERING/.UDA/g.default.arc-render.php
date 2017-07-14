<?php
/*
	Copyright GOBOU Y. Yannick
	
*/

	$vars = explode('/', $this->file);
	$username = (isset($vars[0]))?$vars[0]:false;
	$pathvar = (isset($vars[1]))?$vars[1]:false;
	$filename = (isset($vars[2]))?$vars[2]:false;
	$arctype = '.';

	/* Chemin du fichier dans l'url */
	$gpath=[];
	for($x=2; $x<count($vars); $x++){array_push($gpath, $vars[$x]);}
	$filepath = implode('/', $gpath);


	/* Chemin du fichier sur le serveur */
	$dir = GUSERS::dataDir($username, '%'.strtoupper($pathvar).'%');
	$this->file = $dir . $filepath;


	/* ARC */
	$fexp = explode('.', $filepath);
	$arctype .= strtoupper($fexp[count($fexp)-1]);



	/* EMULATION DU FICHIER */
	$emulator = dirname(__FILE__) . '/emulators/' . $arctype . '.uda-emul';

	// var_dump($arctype); 
	// var_dump($this->file); 
	// exit;

	if(!is_file($this->file)){_GGN::wCnsl('<h1>Donnée introuvable</h1>');}
	if(!is_file($emulator)){_GGN::wCnsl('<h1>Emulateur introuvable</h1>');}

	include $emulator;

?>