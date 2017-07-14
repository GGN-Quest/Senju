<?php
	
	$return = false;

	

	if(is_object($context)){

		if(isset($context->Register) && is_object($context->Register)){

			global $database;

			// $context->AppKey = $context->Manifest->AppKey;

			// $context->App = new self($context->AppKey);
			
			$context->AppExists = is_object($context->Infos);

			$context->UserAccountType = false;
			
			$context->AccessPermission = false;
			
			$context->UserSession = false;
			
			$context->AppSession = false;



			if($context->AppExists!==TRUE){
			
				_GGN::wCnsl('<h1>Erreur, Donnée introuvable</h1>Impossible de retrouver les informations de l\'application < <b>'
					. $context->Key
					. '</b> > dans la base de donnée');
			
			}


			if(is_array($context->Register->USER)){


				$context->Accessibility = true;

				$context->UserAccountType = $context->Register->USER['ACCOUNT_TYPE'];
				
				$context->AccessPermission = $context->Infos->Permission;
				
				$context->UserSession = $context->GetUserSession();
				
				$context->AppSession = $context->GetAppSession();



				if($context->UserAccountType < $context->AccessPermission){
				
					$context->Accessibility = false;
				
					$context->AccessibilityReason = 'error:right.enough';
				
				}


				if($context->UserSession!=false){$context->RefreshUserSession();}

				if($context->AppSession!=false){$context->RefreshAppSession();}

			}


			$return = true;

		
		}
	}



?>