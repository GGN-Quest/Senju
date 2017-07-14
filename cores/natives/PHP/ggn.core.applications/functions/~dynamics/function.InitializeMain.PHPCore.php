<?php
	
	
	namespace GGN\DPO;
	

	$return = false;


	if(is_object($context)){


		/* Chargement des fonctionnalités */
		new Using('DPO\Page');
		new Using('DPO\Theme');





		/* Nouvelle instance */
		$context->Main = new Theme\Instance();


		$context->Head = new Theme\Head();


		$context->Body = new Theme\Body();


		$context->Settings = new Theme\Settings();


		
		// $context->Main->gapps = $context;

		$context->Main->style = \_GGN::varn('GAPPS_STYLE');
		
		$context->Core->CSS = \_GGN::CSSCore('ggn.core');

		$context->Core->CSS->Style($context->Main->style);

		
		$context->Init();




		if($context->ajaxRun == false){
			
			/* Doctype de la page HTML */
			$context->Main->doctype('html');


			/* Barre du haut */
			$context->Body->NavBar = new Theme\Tag(['class'=>'nav-bar disable', 'id'=>'gapps-nav-bar']);

			
			/* Splash Screen */
			$context->Body->SplashScreen = new Theme\Tag(['class'=>'splash-screen enable', 'id'=>'gapps-splash-screen']);

			$context->Body->SplashScreen->text( \Gougnon::fullSpace('<center><div class="gui loading circle x32"></div></center>') );

				

			/* Barre du bas */
			$context->Body->StatusBar = new Theme\Tag(['class'=>'status-bar disable', 'id'=>'gapps-status-bar']);
				

			/* Feuille de la page */
			$context->Body->Sheet = new Theme\Tag(['class'=>'gui sheet gapps', 'id'=>'gapps-sheet']);


			/* Corps de la page */
			$context->Body->Sheet->node->Page = new Theme\Tag(['class'=>'body-main', 'id'=>'gapps-body-main']);
			
			$context->Page = $context->Body->Sheet->node->Page;


			/* Nom de l'application */
			if(isset($context->Name)){

				$context->Body->Sheet->attrib('ggn-app', $context->Name);

			}


		}

		if($context->ajaxRun == true){

			$context->Page = $context->Body;

		}



	


	}



?>