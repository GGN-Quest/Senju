<?php
	
	$return = false;


	if((isset($context->ParamsData)) &&(isset($context->Params)) && (isset($context->Main)) && (isset($args[0])) ){
		$lib = $args[0];

		if($context->Params->{$lib}===TRUE){
			$data = $context->ParamsData[$lib];

			if(is_array($data)){
				if(isset($data['jspkg'])){$context->Head->jsPackages($data['jspkg']);}
				if(isset($data['csspkg'])){$context->Head->cssPackages($data['csspkg']);}
			}

			
		}

	}


?>