<?php
/*
	Copyright GOBOU Y. Yannick
======================================================
	CLASS USERDATA
	PAGE cores/_GGNs/PHP/Register.core.g/ARC_ENGINE_RENDING/USERDATA/g.default.arc-render
======================================================

	Moteur de rendu USERDATA
	
*/

	if(!isset($this->USER)){exit('user.var.not.found');}
	if(!is_array($this->USER)){exit('user.session.failed');}


	Require dirname(__FILE__) . '/g.default.arc-class.php';


	$UD = new GUSERDATA(
		$this->USER
		,$this->_GET('factory')
		,$this->_GET('mod')
	);

	$reponses = $UD->factory();


	exit($reponses);

	
?>