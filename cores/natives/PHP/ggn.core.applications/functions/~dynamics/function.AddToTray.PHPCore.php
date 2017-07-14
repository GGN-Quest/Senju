<?php
	
	$return = false;


	if(is_object($context) && is_array($context->Params->NavBarMenu) && is_array($args)){

		array_push($context->Params->NavBarTray, $args[0]);

		return true;
	}

?>