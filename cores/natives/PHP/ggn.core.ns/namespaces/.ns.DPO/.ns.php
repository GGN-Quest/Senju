<?php

	/**
	 * GGN DPO Invoke
	 *
	 * @version 0.1 
	 * @update 150814.1321
	 * @Require Gougnon Framework
	*/



/*
	Nom de l'espace
*/
namespace GGN\DPO;
	
	
	if(!defined(' GGN\DPO\Page\CDxS_')){

		define('GGN\DPO\ERROR_INSTANCE_', 'dpo;inst;error;');

	}






	/* Using */
	if(!class_exists('\GGN\DPO\Using')){
		Class Using{
			public function __construct($ns){ $this->object = new \GGN\Using($ns); }
		} 
	}



	/*
	
		Si "XML_HTTP_REQUEST" est utlisé pour acceder à la page

		NB : Ajax doit envoyer l'entête " X-Requested-Width "
		
	*/

	if(!function_exists('UsesAjax')){

		function UsesAjax () {return (isset($_SERVER['HTTP_X_REQUESTED_WIDTH'])) ? $_SERVER['HTTP_X_REQUESTED_WIDTH'] : FALSE;}

	}





	if(!class_exists('\GGN\DPO\Invoke')){

		// const NS = "GGN\DPO";

		/*
			Invoke
		*/
		Class Invoke{



		} // Class Invoke


	} // if class_exists 'Invoke'















	if(!function_exists('\GGN\DPO\ToLogin')){

		function ToLogin($app = false, $message = false){

			$UsesAjax = UsesAjax();


			$location = \_GGN::setvar( \_GGN::varn('LOGIN_PAGE') . '?'
			
				. ( (is_string($app)) ? 'app=' . $app . '&': '' )
			
				. 'next=' 
			
				. urlencode( \Gougnon::currentURL() ) . '&'
			
				. ( (is_string($message))? 'message='  . $message : '' )
			
				);


			if($UsesAjax == false){
			
				if(@header('location:' . $location )){exit;}
			
			}

			if($UsesAjax == true){
			
				echo ('<script type="text/javascript">location.href="' . $location . '";</script>'); exit;
			
			}
			

		}

	}















	if(!class_exists('\GGN\DPO\Error')){

		// const NS = "GGN\DPO";

		/*
			Error
		*/
		Class Error extends Invoke{
				
			const NAME = 'Gougnon DPO Error';
			
			const VERSION = '0.1';
			
			const UPDATE = '150920.2126';


			/* 
				Déclaration 
			*/
			public function __construct($data = false){

				$this->_Tx = [ERROR_INSTANCE_, false, func_get_args()];

				$this->code = $data;

			}


			/*
				Analyseur du code de l'erreur
			*/
			public function analyzer($code = false){

				switch (strtolower($code)) {

					case 'theme:brick.not.found':
						
					break;
					
					default: break;
				}

			}




		} // Class Error


	} // if class_exists 'Error'






				
	








?>