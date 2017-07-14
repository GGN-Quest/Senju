<?php
	
	$return = false;


	if( (isset($context->Params)) && (isset($context->Main)) ){

		/* directives demandé */
		if(isset($context->Params)){
			foreach ($context->Params as $name => $value) {
				$v = (is_string($value))?addslashes($value):$value;
				$context->MainManifest[$name] = json_encode($v);

			}
		}


		/* Directives du manifest de l'application */
		if(isset($context->Manifest)){
			foreach ($context->Manifest as $name => $value) {
				$v = (is_string($value))?addslashes($value):$value;
				$context->MainManifest[$name] = json_encode($v);

			}
		}


		$otherVar = explode(' ', 'Name AppName');

		foreach ($otherVar as $name) {
			if(isset($context->{$name})){
				$value = $context->{$name};
				$v = (is_string($value))?addslashes($value):$value;
				$context->MainManifest[$name] = json_encode($v);
			}
		}


		$return = true;
	}


?>