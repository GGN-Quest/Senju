<?php
	
	$return = false;


	if(is_object($context)){

		$context->Params->COM['Pattern'] = '#';


		/* Fonction - evenements */
		$context->Params->COM['all.events.function.name'] = 'Initialize NavBarLogoBuilt BuildNavBarLogo ScreenSplashingMade TitleChanged MountLoaded ParamInitialized InitializeParams OnBeforeLoadPage OnLoadPage OnErrorPage OnFailPage OnWaitPage OnURIUninvailable';

		foreach (explode(' ', $context->Params->COM['all.events.function.name']) as $key => $name) {
			$context->Params->COM[$name] = [];
		}


		$return = true;
	}



?>