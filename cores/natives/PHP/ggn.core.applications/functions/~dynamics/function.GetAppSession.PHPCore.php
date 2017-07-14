<?php
	
	$return = false;


	if(isset($context->Key)){
		$return = GSystem::requires('users.login.app/secures', $context->Key);
	}

?>