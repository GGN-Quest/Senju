<?php
	
	$return = false;

	if(is_object($context)){

		
		$return = GSystem::requires('users.login.refresh/sessions');

	}

?>