<?php
/*
	Copyright GOBOU Y. Yannick
======================================================
	CLASS imagesPNG
	PAGE cores/_GGNs/PHP/Register.core.g/ARC_ENGINE_RENDING/.PNG/imagesPNG.arc-render
======================================================

	Moteur de rendu d'images PNG
	
*/

/*
	CLASS 'imagesPNG'
*/

	if(!class_exists('GCaptcha')){
		Gougnon::loadPlugins('PHP/GCaptcha.0.1');
	}


	$name = $this->_REQUEST('name');
	$textColor = $this->_REQUEST('textcolor');
	$bgColor = $this->_REQUEST('bgcolor');
	

	$this->Render = new GCaptcha($name,$textColor,$bgColor);
	$this->Render->engine();
	


?>