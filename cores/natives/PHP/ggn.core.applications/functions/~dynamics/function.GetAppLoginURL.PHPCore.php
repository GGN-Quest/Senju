<?php
	
	$return = false;


	if(is_object($context)){
		$message = (isset($args[0]))?'&message='  . $args[0]:'';
		$return = _GGN::setvar(_GGN::varn('LOGIN_PAGE') 
			. '?app='.$context->AppKey.'&next=' 
			. urlencode(Gougnon::currentURL())
			. $message
			);
	}



?>