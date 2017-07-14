<?php

	/**
	 * GGN Connect Subscribe Invoke
	 *
	 * @version 0.1 
	 * @update 150814.1321
	 * @Require Gougnon Framework
	*/




/* 
	Si le parent n'existe pas
 */

/*
	Nom de l'espace
*/
namespace GGN\Connect\Subscribe;
	

	/*
		Connect\Invoke
	*/
	if(!class_exists('\GGN\Connect\Invoke')){

		$Connect = (new \GGN\Using('Connect'))->Call(null, 'Invoke');

	}



	if(!class_exists('\GGN\Connect\Subscribe\Invoke')){
			
		Class Invoke extends \GGN\Connect\Invoke{

			const NAME = 'Gougnon Connect - Subscribe';
			
			const VERSION = '0.1';
			
			const UPDATE = '160222.1107';

			static public function Main($data = []){
				
				if(!is_array($data)){$data = [];}

				$data['command'] = \GGN\Connect\SUBSCRIBE;

				return new \GGN\Connect\Invoke($data);

			}

		}

	}








?>