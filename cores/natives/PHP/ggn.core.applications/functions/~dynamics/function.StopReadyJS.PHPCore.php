<?php

	$return = false;
	



if(is_object($context) && isset($context->Body) && is_object($context->Body) && method_exists($context->Body, 'js') && is_array($context->_JS)){



	/*
		
		CODE JS Accumulé

	*/
	$js = implode('', $context->_JS);





	/* 
		Chargement normal de la page 
	*/
	if($context->ajaxRun == false){

		/* AU Montage de la Application */
		$context->Body->js('GScript.check("GApp", function(){');

			/* A l'affichage de l'interface */
			$context->Body->js('GApp.event.add("ShowInterface", function(){');

				/* Insertion de JS */
				$context->Body->js($js);

			/* A l'affichage de l'interface - FIN */
			$context->Body->js('});');


		/* AU Montage de la Application - FIN */
		$context->Body->js('});');

	}






	/* 
		Chargement sous ajax
	*/
	if($context->ajaxRun == true){

		/* Insertion de JS */
		$context->Body->js($js);

	}






}
