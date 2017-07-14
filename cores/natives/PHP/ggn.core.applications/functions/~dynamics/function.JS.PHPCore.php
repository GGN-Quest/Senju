<?php

	$return = false;
	
	


if(is_object($context) && is_array($context->_JS) && isset($args[0]) ){



	/* code JS */
	$code = $args[0];



	/* 
		Code JS -----------------------
		à executer à l'ouverture de l'interface 
		ou à l'execution d JS de la page chargé via AJAX
	*/
	array_push($context->_JS, $code);



}
