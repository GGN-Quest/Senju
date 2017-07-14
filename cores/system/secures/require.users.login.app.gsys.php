<?php
/*
	Copyright GOBOU Y. Yannick
======================================================
	CLASS IHTML
	PAGE cores/_GGNs/PHP/Register.core.g/ARC_ENGINE_RENDING/LOGIN/PHP.HTML.arc-render
======================================================

	Moteur de rendu IHTML
	
*/
	
global $database, $_Gougnon, $GRegister;




// if(!is_string($arguments)){
// 	_GGN::wCnsl($api . ' : Erreur l\'argument proposé n\'est pas du type "STRING" ');
// }



$app=$arguments;



// if(!class_exists('GUSERS')){
// 	_GGN::PHPCore('gougnon.core.user');
// }





// $session = GSystem::requires('users.login.app/sessions', $app);


// if($session===FALSE){
// 	return false;
// }
// else{
// 	$query = GUSERS::GetAccess($session->data['DATA'][0]);

// 	return ($query===false)?false:$query->data;
// }



$connect = GSystem::requires('users.login.app/sessions', $app);


if(is_object($connect)){

	$user = $connect->user();

	return (is_array($user))?$user:false;

}

else{

	return false;

}





?>