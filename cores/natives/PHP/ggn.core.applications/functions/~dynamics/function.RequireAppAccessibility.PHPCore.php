<?php
	
	$return = false;


	if(is_object($context)){

		// echo'access: ';var_dump($context->Accessibility); exit;

		if(!isset($context->Accessibility)){

			$context->GoToLogin();
			
		}

		else{
			if(!is_bool($context->Accessibility)){$context->GoToLogin();}
			else{
				if($context->Accessibility==false){
					$context->GoToLogin($context->AccessibilityReason);
				}
				else{$return = true;}
			}
		}

	}



?>