<?php
	
	$return = false;


	if(isset($context)){
		if(isset($context->Main) && isset($context->Name)){

			$context->Body->js('(function(id){G.DOC.GApp=false;');
			
			/* Declaration */
			$context->Body->js('GApp=GApps.Mount(id);');




			/* Parametrage */
			if(isset($context->MainManifest)){

				$param = [];

				$addParam = [];
				// $addParam['AppUrl'] = $context->Infos->URL;
				$addParam['URL'] = ($context->Infos->URL);

				

				foreach ($addParam as $key => $value) {
					array_push($param, '("'.$key.'", "'.($value).'", false)');
				}

				foreach ($context->MainManifest as $name => $value) {
					array_push($param, '("'.$name.'", \''.addslashes($value).'\', true)');
				}

				$context->Body->js('GApp.Param' . implode('.Param',$param) . ';');

			}
			/* Parametrage FIN */




			/* Parametrage */
			if(isset($context->Params->COM['all.events.function.name'])){

				foreach (explode(' ', $context->Params->COM['all.events.function.name']) as $key => $name) {

					foreach ($context->Params->COM[$name] as $function) {
						$context->Body->js('GApp.event.add("'.$name.'", '.$function.');');
					}

				}

			}
			/* Parametrage FIN */


			$context->Body->js('GApp.Embed();');
			$context->Body->js('})("'.$context->AppName.'");');
		}
	}


?>