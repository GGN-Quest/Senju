<?php


	namespace GGN\DPO;

	
	$return = false;


	if(is_object($context)){

		



		/* Construction du manifest de l'application */
		$context->BuildMainManifest();





		/* Déclaration de la maquette */
		$context->MockUpStatement();





		/* Arret du "JS.Ready" et Generation */
		$context->StopReadyJS();
		




		/* Declaration a partir du manifest */
		if(isset($context->Manifest)){
			
			$context->Main->style=(isset($context->Manifest->Style))?$context->Manifest->Style: $context->Main->style;
			
			$context->Main->responsivity=(isset($context->Params->Responsivity))?$context->Params->Responsivity: $context->Main->responsivity;

		}




		/* Génération du Theme */
		$context->Head->title($context->Params->Title);



			
			/* Entête de la page ================================================== */

			$context->Main->html('lang', ((isset($context->Params->Lang))? $context->Params->Lang : $context->Main->_lang) );

			$context->Head->shortcut($context->Params->Shortcut);
			
			$context->Head->meta('charset', $context->Params->Charset);
			
			$context->Head->meta('charset', $context->Params->Charset);

			$context->Head->meta('name', 'viewport', $context->Params->Viewport);




			/* Packages CSS et JS  */
			$context->InitializeCSS();
			
			$context->InitializeJS();

			$context->Head->cssPackages([
			
				'ggn.application.initialize'
			
				, 'ggn.application.mount'
			
			]);
			
			$context->Head->jsPackages([
			
				'ggn.application.initialize'
			
				, 'ggn.application.mount'
			
			]);



			foreach ($context->ParamsData as $name => $data) {
			
				if((isset($data['type'])) && ((isset($data['jspkg'])) || (isset($data['csspkg']))) ){
			
					$context->Packages($name);
			
				}
			
			}




			/* Additif */
			if(isset($context->Infos->LiveMode) && $context->Infos->LiveMode==true){
				$context->Head->jsPackages('ggn.live');
				$context->Body->js('GScript.check("GApp", function(){');
					$context->Body->js('GApp.event.add("ShowInterface", function(){var w=window,a=GApp,l;');
						$context->Body->js('a.Live=GLive;');
						$context->Body->js('l=a.Live;');
						$context->Body->js('l({Key:"_system/vendor.apps.activity",Timer:5000 ,Data:"appKey='.$context->Infos->Key.'&instance='.\_GGNCrypt::_sha256(date('Ymd.His')).'"});'); 
						$context->Body->js('GLive.event.add("receive",function(ob){a.LiveReceived(ob);});');
						$context->Body->js('GLive.Ready(function(o){');
							// $context->Body->js('if(G.isObject(a["LiveMode"]||"")){ G.foreach(a.LiveMode,function(v,k){o.Request(k,v);}); o.ResetAttempt();}');
						$context->Body->js('});');
					$context->Body->js('});');
				$context->Body->js('});');
			}

		/* Entête FIN ================================================== */




		/* 
			Clonage
		*/
		$tpl = clone $context->Main;
		
		$tpl->Head = $context->Head;
		
		$tpl->Body = $context->Body;
		
		$tpl->Settings = $context->Settings;



		/* 
			La page 
		 */
		$page = new Page\Init($tpl);




		/* 
			Moteur de rendu
		*/
		$page
			
			->engine()
			
			->schema( (new Page\RenderingScheme())->html5 )

			->start();






		return true;

	}



?>