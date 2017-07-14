<?php
/*
	Copyright GOBOU Y. Yannick
======================================================
	FICHIER cores/_GGNs/PHP/Register.core.g/.load.php
======================================================

*/

	
	define('__Register_PATH__', dirname(__FILE__));

	require dirname(__FILE__) . '/.class.php';


	$core = new Register(__MAIN__, $_GET, __Register_PATH__);
	
?>