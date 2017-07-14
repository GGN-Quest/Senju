<?php
/*
	Copyright GOBOU Y. Yannick
	
*/


$lLogin = new \GGN\Using('Connect/Login');
	

/* Class DPO */
\Gougnon::loadPlugins('PHP/designPackage.Object');



$connect = \GGN\Connect\Login\ResetPassword::Main([

	/*
		email de l'utilisateur
	*/
	'email'=> Register::_POST('email')
	

	/*
		Classe 'com.service'
	*/
	, 'com.service'=>$this


]);





/*
	Tentative de connexion : Validation des variables requires
*/
if($connect->attempt()===true){

	$connect->responses('reset.password.success');

}




/*
	Echec de la tentative de connexion
*/
else{

	$connect->responses('attempt.failed');

}




	
?>