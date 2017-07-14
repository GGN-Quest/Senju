<?php
/*
	Copyright GOBOU Y. Yannick
	
*/


$lLogin = new \GGN\Using('Connect/Login');
	



$connect = \GGN\Connect\Login\ResetPasswordFactory::Main([

	/*
		email de l'utilisateur
	*/
	'email'=> Register::_POST('email')
	

	/*
		Clé d'acces
	*/
	, 'codex'=> Register::_POST('tmp')
	

	/*
		Nouveau Mot de passe
	*/
	, 'password'=> Register::_POST('reset_password')
	

	/*
		Nouveau Mot de passe : Confirmation
	*/
	, 'passwordConfirm'=> Register::_POST('reset_password_confirm')
	

	/*
		Classe 'com.service'
	*/
	, 'com.service'=>$this


]);





/*
	Tentative de connexion : Validation des variables requires
*/
if($connect->attempt()===true){

	$connect->responses('reset.success');

}




/*
	Echec de la tentative de connexion
*/
else{

	$connect->responses('attempt.failed');

}




	
?>