<?php

	/**
	 * GGN xCMD Invoke
	 *
	 * @version 0.1 
	 * @update 150814.1321
	 * @Require Gougnon Framework
	*/



/*
	Nom de l'espace
*/
namespace GGN\System\xCMD;
	
	





	/* Using */
	if(!class_exists('\GGN\System\xCMD\Using')){

		Class Using{

			public function __construct($ns){ $this->object = clone new \GGN\Using($ns); }

		} 

	}

	





	/* Interface */
	if(!interface_exists('\GGN\System\xCMD\Format')){

		Interface Format{

			public function Apply($cmd = false);

			public function Help($section = false);

		} 

	}








	if(!class_exists('\GGN\System\xCMD\Invoke')){

		/*
			Invoke
		*/
		Class Invoke{


			const NAME = 'Gougnon xCommands';
			
			const VERSION = '0.1';
			
			const UPDATE = '150920.2244';


		} // Class Invoke


	} // if class_exists 'Invoke'








	if(!class_exists('\GGN\System\xCMD\Utility')){

		/*
			Utility
		*/
		Class Utility{


			const NAME = 'Gougnon xCommands Utilitaire';
			
			const VERSION = '0.1';
			
			const UPDATE = '150920.2244';



			static public function Concatenate($string){

				$output = '';

				preg_match_all('/"(?:\\\\.|[^\\\\"])*"|\S+/', $string, $output);


				/* Faire quelque chose / DEBUT */

					// $output

				/* Faire quelque chose / FIN */


				return $output[0];

			}



			static public function StripExQuotes($string){

				$output = ltrim(rtrim($string));

				if(substr($output, 0, 1) == '"' && substr($output, -1) == '"'){

					$output = substr($output, 1, -1);

				}

				return $output;

			}



		} // Class Utility


	} // if class_exists 'Utility'









	if(!class_exists('\GGN\System\xCMD\Attributes')){

		/*
			Attributes
		*/
		Class Attributes{

			const NAME = 'Gougnon xCommands Attributes';
			
			const VERSION = '0.1';
			
			const UPDATE = '150920.2244';




			/* 

				'Instance'

					L'instance actuel d'un execution de commande

				/ DEBUT
				
			*/

				var $Instance = [

					'Used' => false

				];

			/* 'Instance' / FIN */




			/* 

				'Executes'

					Code ou Procédure JavaScript à executer à la fin de l'instance du traitement

				/ DEBUT
				
			*/

				var $Executes = [

					'Script' => []

					, 'Process' => []

					, 'Cmd' => []

					, 'Sequence' => []

				];

			/* 'Executes' / FIN */







			/* 

				'Constructrice' : Dynamique

					Methode construisant la variable '$this->args' de type 'array'
					Ceci permet a l'utilisateur d'avoir en varaiable toutes donneés initialisée
					lors de la déclaration de l'instance.

					Exemple : $this->args[0] retrourne 'VAR_1', donc le permier argument passé dans
							l'instance 
							'$MyInstance = new CLASS("VAR_1", "VAR_2");'
				/ DEBUT

			*/

				public function __construct($args = []){

					$this->args = $args;

				}

			/* 'Constructrice' / FIN */








			/* 

				'OccupiesTheInstance' : DYNAMIC

					Occupez l'instance par l'execution en cours

				/ DEBUT

			*/

				public function OccupiesTheInstance($status = true){

					$this->Instance['Used'] = $status;

					return $this;
					
				}

			/* 'OccupiesTheInstance' / FIN */
				







			/* 

				'FollowUp' : DYNAMIC

					Suivi de l'execution, pour passer des variable entre les commandes

				/ DEBUT

			*/

				public function FollowUpStart(){

					$this->Cmd('console:follow.up/start');

					return $this;
					
				}

				public function FollowUpStop(){

					$this->Cmd('console:follow.up/stop');

					return $this;
					
				}

			/* 'FollowUp' / FIN */
				







			/* 

				'ApplyDefaultReturn' : STATIC

					Retour par defaut du traitement de la methode 'Apply'

				/ DEBUT

			*/

				static public function ApplyDefaultReturn($cmd = false){

					$R = '';

					if($cmd===null){
						
						$R = '__Graph:Icn:Ok__ Module rattaché à la console';

					}

					else{

						$R = '__Graph:Icn:Warning__ Commande invalide : <b>' . $cmd . '</b>';

					}

					return $R;

				}

			/* 'ApplyDefaultReturn' / FIN */
				







			/* 

				'Exec' : DYNAMIC

					Execution terminal et javascript

				/ DEBUT

			*/

				public function Exec($Type, $Name, $Fn = false){

					if(is_string($Type)){

						if(!isset($this->Executes[$Type]) || (isset($this->Executes[$Type]) && !is_array($this->Executes[$Type])) ){

							$this->Executes[$Type] = [];

						}


						$Save = ['time' => time()];

						$gN = is_string($Name);

						if($gN){

							$Save[$Name] = $Fn;

						}

						if(!$gN){

							$Save[count($this->Executes[$Type])] = $Fn;

						}

						array_push($this->Executes[$Type], $Save);

					}

					return $this;

				}

				public function Process($Name, $Fn = false){

					if(is_string($Name)){

						$this->Exec('Process', $Name, $Fn);

					}

					return $this;

				}

				public function JavaScript($Fn = false){

					if(is_string($Fn)){

						$this->Exec('Script', false, $Fn);

					}

					return $this;

				}

				public function Cmd($Fn = false){

					if(is_string($Fn)){

						$this->Exec('Cmd', false, $Fn);

					}

					return $this;

				}

			/* 'Exec' / FIN */
				







			/* 

				'Input' : DYNAMIC

					Construit un champs (INPUT, SELECT, TEXTAREA) permettant au client d'entrer un valeur 

				/ DEBUT

			*/

				public function Input($I = false){


					if(is_array($I)){

						$this->Process('-input', $I);

					}

					return $this;

				}

			/* 'Input' / FIN */
				







			/* 

				'Sequence' : DYNAMIC

					Executer une sequence d'un ensemble d'action qui stop l'execution 
					des commandes précédentent et les reprends une foi terminer

				/ DEBUT

			*/

				public function Sequence($args = false){


					if(!is_bool($args)){

						$this->Exec('Sequence', false, $args);

					}

					return $this;

				}

			/* 'Sequence' / FIN */
				








		} // Class Attributes


	} // if class_exists 'Attributes'








	if(!class_exists('\GGN\System\xCMD\Dir')){

		/*
			Dir
		*/
		Class Dir{


			static public function Name($get = false){

				return __CORES_SYSTEM__ . 'x-cmds/' . ( (is_string($get)) ? $get . '/': '' );

			}


			static public function Mod($get = false){

				return self::Name( 

					'mods/' . ( (is_string($get)) ? $get : '' )

				);

			}


			static public function Process($get = false){

				return self::Name( 

					'process/' . ( (is_string($get)) ? $get : '' )

				);

			}


			static public function Sequences($get = false){

				return self::Name( 

					'sequences/' . ( (is_string($get)) ? $get : '' )

				);

			}



		} // Class Dir


	} // if class_exists 'Dir'








	if(!class_exists('\GGN\System\xCMD\Process')){

		/*
			Process
		*/
		Class Process{


			const PREFIX = 'proc.';

			const EXT = '.php';


			static public function Get(){

				$Dir = Dir::Process();

				$Scan = \Gougnon::scanFolder($Dir);

				$OutPut = [];


				foreach ($Scan as $file) {

					$f = basename($file);
					
					$prefix = substr($f, 0, strlen(self::PREFIX));

					$ext = substr($f, -1 * strlen(self::EXT));

					if($prefix == self::PREFIX && $ext == self::EXT && is_file($file)){

						array_push($OutPut, $file);

					}

				}

				return $OutPut;

			}


			static public function Write(){

				$Get = self::Get();

				$Len = count($Get);

				$Lim = $Len - 1;


				foreach ($Get as $k => $file) {

					include $file;

					if($k < $Lim){echo ",";}

				}

			}



		} // Class Process


	} // if class_exists 'Process'








	if(!class_exists('\GGN\System\xCMD\Sequences')){

		/*
			Process
		*/
		Class Sequences{


			const PREFIX = 'seq.';

			const EXT = '.php';


			static public function Get(){

				$Dir = Dir::Sequences();

				$Scan = \Gougnon::scanFolder($Dir);

				$OutPut = [];


				foreach ($Scan as $file) {

					$f = basename($file);
					
					$prefix = substr($f, 0, strlen(self::PREFIX));

					$ext = substr($f, -1 * strlen(self::EXT));

					if($prefix == self::PREFIX && $ext == self::EXT && is_file($file)){

						array_push($OutPut, $file);

					}

				}

				return $OutPut;

			}


			static public function Write(){

				$Get = self::Get();

				$Len = count($Get);

				$Lim = $Len - 1;


				foreach ($Get as $k => $file) {

					include $file;

					if($k < $Lim){echo ",";}

				}

			}



		} // Class Sequences


	} // if class_exists 'Sequences'













	if(!class_exists('\GGN\System\xCMD\Get')){

		/*
			Get
		*/
		Class Get extends Invoke{


			var $Return = false;
			

			public function __construct($xCMD){


				// $this->Return = ;

			}




			/* Module / DEBUT */

				static public function isModule($key){

					$loader = Dir::Mod('mod.' . $key) . 'load.php';

					return is_file($loader) ? $loader : false;

				}

				static public function Module($key, $args = false){

					$mod = self::isModule($key);


					if($mod){

						$Class = false;

							include $mod;

						return $Class;

					}

					else{

						return false;

					}

				}

			/* Module / FIN */




		} // Class Get


	} // if class_exists 'Get'









				








?>