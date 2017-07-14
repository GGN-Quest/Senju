<?php

/**
 * GGN Core Kernel
 *
 * version 0.1 
 * version update 150824.1103
*/



// if(class_exists('\GGN\Invoke')){
	

	/*
		Nom d'espace 'GGN'
	*/
	namespace GGN{


		/*
			Nom d'un 'namspace'
		*/
		const NAME = 'Gougnon NameSpace';

		/*
			Version d'un 'namspace'
		*/
		const VERSION = '0.1';

		/*
			Version de la mise à jour d'un 'namspace'
		*/
		const UPDATE = '150824.1103';

		/*
			Version de la mise à jour d'un 'namspace'
		*/
		const NS = 'GGN';




		/*
			Inclure un fichier
		*/

		function load($file = false){

			if(is_file($file)){

				include $file; 

			}

			else{

				\_GGN::wCnsl('<h1>Gougnon Core</h1> Fichier introuvable (' . $file . ') ');

			}

		}




		/*
			Inclure un namespace
		*/

		function Get($Ns = false){

			if(is_string($Ns)){

				$Path = dirname(__FILE__) . '/namespaces/' . Using::NS_PRE . $Ns . Using::NS_EXT . '';

				if(is_file($Path)){

					include $Path; 

				}

				else{

					\_GGN::wCnsl('<h1>Gougnon Core</h1> Fichier introuvable (' . $Path . ') ');

				}

			}

		}




		/*
			Chargement d'un 'namspace'
		*/
		Class Using{


			/*
				Dossier des nom d'espace
			*/
			const NS_DIR = 'namespaces/';


			/*
				Prefixe des nom d'espace enfant
			*/
			const NS_PRE = '.ns.';


			/*
				Nom d'espace chargé par default
			*/
			const NS_EXT = '.ns.php';



			public function __construct($name = ''){

				$this->args = func_get_args();

				$ns = self::dir($name);

				$sn = self::NS_EXT;


				/*
					Si le 'namespace' est dans un dossier
				*/
				if(is_file($ns . $sn)){

					load($ns . $sn);

				}

				/*
					Si le 'namespace' est inclut dans le dossier courant
				*/
				elseif (is_file($ns . '/' . $sn)) {

					load($ns . '/' . $sn);

				}

				/*
					Sinon
				*/
				else{

					\_GGN::wCnsl('<h1>Gougnon Core NameSpace</h1> le nom d\'espace ('.$name.') introuvable ');

				}

				$this->NSVars($name);

			}



			/*
				Variables du nom d'espace
			*/
			public function NSVars($name = ''){
				
				$this->NS = '\\' . \GGN\NS . '\\' . str_replace('/', '\\', $name);

			}



			/*
				Dossier actuel de GGN
			*/
			public function Call($arg = null, $class = ''){

				if(isset($this->NS)){

					$ns = $this->NS . ( \Gougnon::isEmpty($class) ? '\Invoke': '\\' . $class);

					return (class_exists($ns)) ? new $ns($arg): false;

				}


			}



			/*
				Dossier actuel de GGN
			*/
			static public function dir($path = ''){

				$path = str_replace('\\', '/', $path);

				return dirname(__FILE__) . '/' . self::NS_DIR . ((\Gougnon::isEmpty($path))?'':self::NS_PRE . $path);

			}


		}








		/*
			Invoke du 'namespace'
		*/
		class Invoke{

			public function __construct(){

			}


		}



	}
	 
// }
 


namespace GGN\CMD{

	/* Connect */
	const LOGIN = 'user.log.in';

	const LOGOUT = 'user.log.out';

	const RESETUPWD = 'reset.user.password';

	const RESETUPWDFAC = 'reset.user.password.factory';

	const SUBSCRIBE = 'users.subscribe.handler';




}







 
?>