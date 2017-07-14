<?php
	
	$return = false;


	if(is_object($context)){

		$default = $args[0];
		$errorPage = (isset($args[1]))?$args[1]: false;
		$defaultPage = $context->Register->path . $context->Register->pagePrefix . $default . $context->Register->pageExtension;


		/* Paramètres addtionnels */
		$context->Params->DefaultPage = $default;


		$issetPage = isset($context->Register->page);
		if($issetPage){

			if(is_string($context->Register->page)){
				include $context->Register->page;
			} else{
				if(is_file($defaultPage)){include $defaultPage;}
				else{$context->Main->body($errorPage);}
			}
			
		}

		if(!$issetPage){
			if($context->Register->page==null){
				@header(_GGN::HTTP_HEADER_404);
				if(is_string($errorPage)){include $errorPage;}
				if(!is_string($errorPage)){Gougnon::fullSpace('<div class="alert">Page introuvable</div>');}
				
			} else{
				if(is_file($defaultPage)){include $defaultPage;}
				else{
					if(is_string($errorPage)){include $errorPage;}
					if(!is_string($errorPage)){Gougnon::fullSpace('<div class="alert">Page introuvable</div>');}
				}
			}
		}


		$return = true;
	}



?>