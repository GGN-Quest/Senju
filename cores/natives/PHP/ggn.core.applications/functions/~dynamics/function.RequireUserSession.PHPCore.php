<?php
	
	$return = false;


	if(is_object($context)){

		if(!isset($context->UserSession)){$context->GoToLogin();}
		else{
			if(!is_array($context->UserSession)){$context->GoToLogin();}
			else{$return = true;}
		}

	}



?>