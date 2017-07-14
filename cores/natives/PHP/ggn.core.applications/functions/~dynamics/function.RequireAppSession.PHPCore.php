<?php
	
	$return = false;


	if(is_object($context)){

		// echo'app session: requireAppSession: ';var_dump($context->AppSession); exit;

		if($context->AppSession===false){

			$context->GoToLogin();

		}

		else{
			
			if(!is_array($context->AppSession)){

				$context->GoToLogin();

			}
			
			else{

				$return = true;

			}

		}

	}



?>