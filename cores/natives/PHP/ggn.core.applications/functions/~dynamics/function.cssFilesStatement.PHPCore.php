 <?php
	
	$return = false;


	if(is_object($context) && isset($context->Params->MockUpLayoutMode) && is_array($context->_cssFiles) ){

		$context->Body->js('(function(){');
			$context->Body->js('GScript.check("GApp", function(){');

			/* Depuis un chargement "NORMAL" */
			if($context->ajaxRun==false){


				
				$context->cssFilesCaller();


			}




			/* Depuis un chargement "AJAX" */
			if($context->ajaxRun==true){

				$context->Body->js('if(GApp.Params.Style!="'.$context->Manifest->Style.'"){');
					
					/* Rechargement des fichiers css courant */
					$context->Body->js('G.foreach(GApp.MockUp.CSS.Files, function(el,k){');
						$context->Body->js('if(!G.isObject(el||"")){return false;}');
						$context->Body->js('if(!G.isFunction(el.attrib||"")){return false;}');
						$context->Body->js('var f=el.data("origin")||false;');
						$context->Body->js('if(!G.isString(f||false)){return false;}');
						$context->Body->js('el.attrib("href", [f,"&style=' . $context->Manifest->style . '"].join(""));');
					$context->Body->js('});');


					$context->Body->js('GStyle("#ggn-css-framework-packages").change("'.$context->Manifest->style.'");');
					$context->Body->js('GApp.Params.Style = "'.$context->Manifest->style.'";');
				$context->Body->js('}');


			}





			$context->Body->js('});');
		$context->Body->js('})();');


	}

	// $context->Body->js('GToast("style : '.$context->Manifest->style.'").bubble();');

?>