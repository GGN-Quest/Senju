<?php

	$return = false;
	



if(is_object($context) && isset($context->Infos) && is_object($context->Infos)){

	$return = new \GGN\Apps\Size($context);

}



?>