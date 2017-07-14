<?php

	/**
	 * GGN DPO Procedure
	 *
	 * @version 0.1
	 * @update 150911.0854
	*/




/*
	Nom de l'espace
*/
namespace GGN\DPO\Procedure;
	



	use \GGN\DPO\Page;
	

	if(!defined('GGN\DPO\Procedure\CDxM_')){

		define('GGN\DPO\Procedure\CDxM_', \GGN\DPO\Page\CDxM_);

	}

	if(!defined('GGN\DPO\Procedure\PROC_INSTANCE_DB_')){

		define('GGN\DPO\Procedure\PROC_INSTANCE_DB_', 'procedure;instance;db.table;');

	}

	if(!defined('GGN\DPO\Procedure\PROC_INSTANCE_VAR_')){

		define('GGN\DPO\Procedure\PROC_INSTANCE_VAR_', 'procedure;instance;var.applied;');

	}










	if(!class_exists('\GGN\DPO\Procedure\Invoke')){
			
		Class Invoke extends \GGN\DPO\Invoke{
				
			const NAME = 'Gougnon DPO Procedure';
			
			const VERSION = '0.1';
			
			const UPDATE = '150911.0859';


			public function __construct(){
				
			}


		} // Class 'Invoke'


	} // If class exists 'Invoke'







	if(!class_exists('\GGN\DPO\Procedure\Variable')){
			
		Class Variable extends Invoke{
				
			const NAME = 'Gougnon DPO Procedure : Variable';
			
			const VERSION = '0.1';
			
			const UPDATE = '150911.0859';



			public $vars = [];



			public function __construct($data = false){

				$this->_Tx = [PROC_INSTANCE_VAR_, CDxM_];

				/* Initialisation */
				if(is_string($data)){

					$this->vars[$data] = gettype($data);

				}

				
			}



		} // Class 'Variable'


	} // If class exists 'Variable'








	if(!class_exists('\GGN\DPO\Procedure\Database')){
			
		Class Database extends Invoke{
				
			const NAME = 'Gougnon DPO Procedure : Base de donnée';
			
			const VERSION = '0.1';
			
			const UPDATE = '150911.0859';



			public function __construct($config = false){

				$this->_Tx = [PROC_INSTANCE_DB_, CDxM_];

				/* Initialisation */
				if(is_array($config)){

					foreach ($config as $var => $value) {

						$this->{$var} = $value;
						
					}

				}

				
			}



		} // Class 'Database'


	} // If class exists 'Database'




?>