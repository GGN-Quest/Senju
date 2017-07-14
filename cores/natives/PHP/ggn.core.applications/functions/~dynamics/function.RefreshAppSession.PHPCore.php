<?php
	
	$return = false;


	if(isset($context->Key)){
		$return = GSystem::requires('users.login.app.refresh/sessions', $context->Key);
	}

?>