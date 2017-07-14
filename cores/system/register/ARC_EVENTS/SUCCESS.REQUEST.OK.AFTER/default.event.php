<?php

	global $GLANG;





	/* Taritement */
	$_REG_MODE = (isset($args[1]))?$args[1]:false;

	$_REG_MIME = (isset($args[2]))?trim($args[2]):false;

	$_REG_TYPE = (isset($args[3]))?$args[3]:false;





	if(

		$_REG_MIME == 'content-type:text/html'

		|| $_REG_MIME == 'content-type:text/css'

		|| $_REG_MIME == 'content-type:text/javascript'

	){

		ob_end_flush();

	}




?>