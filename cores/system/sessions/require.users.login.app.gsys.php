<?php
/*
	Copyright GOBOU Y. Yannick
	
*/
	


$lLogin = new \GGN\Using('Connect/Login');

$Login = \GGN\Connect\Login\Invoke::Main(['app'=>$arguments]);

$isLogged = $Login->isLoggedApp();

return (is_array($isLogged))?$Login:false;



?>