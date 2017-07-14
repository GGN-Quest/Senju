<?php
	



	/* Class GAPPS */
	if(!class_exists('GAPPS')){
		_GGN::PHPCore('ggn.core.applications');
	}





	/* Application */
	$gapps = new GAPPS(GSystem::IMKey);

	$gapps->Open();





	
?>