<?php

namespace GGN\DPO;
	
	$return = false;


	if(is_object($context)){

		$default = $args[0];
		$prefix = $args[1];
		$extension = $args[2];


		$path = $context->Path;
		$file = $context->Register->getCFileName();


		$context->Register->page = false;
		$context->Register->pagePrefix = $prefix;
		$context->Register->pageExtension = $extension;



		/* Verification */
		$get = $path;
		if(is_string($file)){
			$get .= ((dirname($file)) . '/' . $prefix . (basename($file)) . $extension);

			if(is_file($get)){
				$context->Register->page = $get;
			}
			else{

				if(\Gougnon::isEmpty($file)){
					$context->Register->page = false;
				}
				else{
					$context->Register->page = null;
				}

			}

		}

		if(is_bool($file)){
			$context->Register->page = false;
		}



		/* Page */
		$context->Register->path = $path;



		/* Paramètres addtionnels */
		$context->Params->CurrentPage = $file;


		
		/* Demarrage du "JS.Ready" */
		$context->StartReadyJS();



		/* Traitement */
		if(($context->ajaxRun==true)&&(is_string($context->Register->page))){


			/*
				Appel du fichier courant
			*/
			include $context->Register->page;


			/* Arret du "JS.Ready" et Generation */
			$context->StopReadyJS();
			
			/* 
				La page 
			 */
			$tpl = new Theme\Instance();
			$tpl->Body = $context->Body;
			$page = new Page\Init($tpl);


			/* 
				Moteur de rendu
			*/
			$page->engine()->start(false, 'body');


		}
			
		if(($context->ajaxRun==false)||(!is_string($context->Register->page)) ){
			include $path . $default;


		}


		


		$return = true;
	}



?>