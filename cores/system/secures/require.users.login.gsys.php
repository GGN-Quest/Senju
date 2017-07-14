<?php
/*
	Copyright GOBOU Y. Yannick
======================================================
	CLASS IHTML
	PAGE cores/_GGNs/PHP/Register.core.g/ARC_ENGINE_RENDING/LOGIN/PHP.HTML.arc-render
======================================================

	Moteur de rendu IHTML
	
*/
	
global $database, $_Gougnon, $GRegister, $core;


$connect = GSystem::requires('users.login/sessions');


if(is_object($connect)){

	$user = $connect->user();

	return (is_array($user))?$user:false;

}

else{

	return false;

}


?>