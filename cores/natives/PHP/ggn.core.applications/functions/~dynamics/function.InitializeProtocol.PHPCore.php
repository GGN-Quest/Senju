<?php

	$return = false;
	
	if(is_object($context)){

		$context->Protocol = $context->GetAppProtocole();
		$context->Path = false;
		$context->InternalApp = true;


		if($context->Protocol=='http'){
			$context->InternalApp = false;
			$context->Path = $context->Location;
		}

		else{
			$context->Path = Gougnon::getPathFromProtocol($context->Location);
			// $context->Path = Gougnon::getPathFromProtocol($context->Protocol, $context->Name);
		}

		// switch ($context->Protocol) {
		// 	case 'ggn':
		// 		$context->Path = __APPLICATIONS__ . $context->Name;
		// 	break;
			
		// 	case 'ggn-system':
		// 		$context->Path = __CORES_SYSTEM_GGN__ . $context->Name;
		// 	break;
			
		// 	case 'root':
		// 		$context->Path = $context->Name;
		// 	break;
			
		// 	case 'http':
		// 		$context->InternalApp = false;
		// 		$context->Path = $context->Location;
		// 	break;
			
		// }

	}


?>