<?php
	
	$return = false;


	if(is_object($context)){


		/* Paramètres */
		$context->AppCompleteURL = Gougnon::currentURL();
		$context->AppURL = explode('?', $context->AppCompleteURL)[0];


		
		$context->Params = new _GGNCustomObject();

		$context->InitializeParamsData();
		
		foreach ($context->ParamsData as $name => $data) {

			if(isset($data['type'])){
				$type = (isset($data['type'])) ? $data['type'] : false;

				if(isset($context->Params->{$name}) && (isset($data['type'])) ){
					if(gettype($context->Params->{$name}) != $type){
						settype($context->Params->{$name}, $type); // formatage de la variable
					}
				}
				else{
					$context->{$name} = null;
					if(isset($data['defaultValue'])){$context->Params->{$name} = $data['defaultValue'];}
					settype($context->Params->{$name}, $type); // formatage de la variable
				}
			}

		}



		
		$return = true;
	}



?>