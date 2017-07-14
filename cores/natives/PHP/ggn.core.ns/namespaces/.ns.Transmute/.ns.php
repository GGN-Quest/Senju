<?php

	/**
	 * GGN Transmute Invoke
	 *
	 * @version 0.1 
	 * @update 150814.1321
	 * @Require Gougnon Framework
	*/



/*
	Nom de l'espace
*/
namespace GGN\Transmute;
	
	





	if(!class_exists('\GGN\Transmute\Invoke')){

		/*
			Invoke
		*/
		Class Invoke{


		} // Class Invoke


	} // if class_exists 'Invoke'









	/* Load / DEBUT ////////////////////////////// */

	if(!function_exists('\GGN\Transmute\Load')){


		function Load($URL = false){


		  	$curl = curl_init($URL);


			curl_setopt( $curl, CURLOPT_NOBODY, true );

			curl_setopt( $curl, CURLOPT_HEADER, true );

			curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );

			curl_setopt( $curl, CURLOPT_FOLLOWLOCATION, true );

			curl_setopt( $curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT'] );


			$data = curl_exec( $curl );

			curl_close( $curl );


			return $data;


		}


	} 

	/* Load / FIN ////////////////////////////// */










				








?>