<?php
/*
	Copyright GOBOU Y. Yannick
	
*/
	
$lLogin = new \GGN\Using('Connect\Login');

$Login = \GGN\Connect\Login\Invoke::Main();

$isLogged = $Login->isLogged();

return (is_array($isLogged))?$Login:false;


?>