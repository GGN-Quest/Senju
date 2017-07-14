<?php
	
	$return = false;


	if(is_object($context) && is_array($context->_cssFiles)  && isset($args[0]) ){

		$file=$args[0];
		$parm=(isset($args[1]))?$args[1]:'';

		if(!in_array($file, $context->_cssFiles)){

			array_push($context->_cssFiles, $file . '?' . $parm);

		}

	}


?>