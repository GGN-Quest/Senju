<?php

	/**
	 * GGN Plugin Invoke
	 *
	 * @version 0.1 
	 * @update 150814.1321
	 * @Require Gougnon Framework
	*/



/*
	Nom de l'espace
*/
namespace GGN\Plugin;
	
	





	/* Using */
	if(!class_exists('\GGN\Plugin\Using')){
		Class Using{
			public function __construct($ns){ $this->object = clone new \GGN\Using($ns); }
		} 
	}








	if(!class_exists('\GGN\Plugin\Invoke')){

		/*
			Invoke
		*/
		Class Invoke{



		} // Class Invoke


	} // if class_exists 'Invoke'









	if(!class_exists('\GGN\Plugin\Load')){

		/*
			Load
		*/
		Class Load extends Invoke{

			public function __construct($name = false){

				$this->return = \Gougnon::loadPlugins($name);

			}

		} // Class Load


	} // if class_exists 'Load'









	if(!class_exists('\GGN\Plugin\HTML')){

		/*
			HTML
		*/
		Class HTML extends Invoke{

			public function __construct($name = false){

				$this->return = new Load('HTML/' . $name);

			}

		} // Class HTML


	} // if class_exists 'HTML'










	if(!class_exists('\GGN\Plugin\PHP')){

		/*
			PHP
		*/
		Class PHP extends Invoke{

			public function __construct($name = false){

				$this->return = new Load('PHP/' . $name);

			}

		} // Class PHP


	} // if class_exists 'PHP'















				








?>