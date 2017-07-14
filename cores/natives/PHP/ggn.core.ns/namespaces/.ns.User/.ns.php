<?php

	/**
	 * GGN User Invoke
	 *
	 * @version 0.1 
	 * @update 150814.1321
	 * @Require Gougnon Framework
	*/



/*
	Nom de l'espace
*/
namespace GGN\User;
	
	


	if(!class_exists('\GGN\User\Invoke')){

		/*
			Invoke
		*/
		Class Invoke{



		} // Class Invoke


	} // if class_exists 'Invoke'


	


	if(!class_exists('\GGN\User\Log')){

		/*
			Log
		*/
		Class Log{


			public function __construct($Name = false, $Comment = false){

				global $GRegister;

				return \RegisterLog::Add('-user', $Name, $Comment);

			}

		} // Class Log


	} // if class_exists 'Log'






				








?>