<?php

	$return = false;
	



if(is_object($context)){
	
	$context->Infos = self::Get($context->Key);

	$return = $context->Infos;

}


?>