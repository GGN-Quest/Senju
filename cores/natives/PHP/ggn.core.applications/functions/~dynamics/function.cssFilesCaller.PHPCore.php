<?php
	
	$return = false;


	if(is_object($context) && is_array($context->_cssFiles) ){

		foreach($context->_cssFiles as $key => $file){
			$context->Main->js('var sty=G.Style.load("'.$file.'&style='.$context->Manifest->Style.'");');
			$context->Main->js('sty.data("origin", "'.$file.'");');
			$context->Main->js('GApp.MockUp.CSS.Files["'.$key.'"]=sty;');
		}

	}


?>