<?php

	/**
	 * GGN DPO Theme
	 *
	 * @version 0.1
	 * @update 150911.0854
	*/




/*
	Nom de l'espace
*/
namespace GGN\System\OInterface;
	

	// const _ = '';




	if(!class_exists('\GGN\System\OInterface\Invoke')){
			
		Class Invoke extends \GGN\System\Invoke{
				
			const NAME = 'Gougnon System OInterface';
			
			const VERSION = '0.1';
			
			const UPDATE = '151011.0256';

			const AppKey = 'ggn.interface.rk.1';



		} // Class 'Invoke'


	} // If class exists 'Invoke'




	if(!class_exists('\GGN\System\OInterface\Path')){
			
		Class Path extends Invoke{
				
			const NAME = 'Gougnon System OInterface : Chemin';
			
			const VERSION = '0.1';
			
			const UPDATE = '151011.0256';



			/* Dossier de l'application */
			static public function Path(){
				
				$app = new \GAPPS(\GSystem::IMKey);

				if(is_object($app->Infos)){

					return \Gougnon::getPathFromProtocol($app->Infos->Path);

				}


				return false;
				

			}


			/* Dossier des Atouts */
			static public function Assets(){
			
				return self::Path() . '/assets/';
			
			}


			/* Dossier des Atouts */
			static public function Mockup(){
			
				return self::Assets() . '/mockup/';
			
			}


			/* Dossier des Classes */
			static public function Classes(){
			
				return self::Path() . '/classes/';
			
			}


			/* Dossier du Menu */
			static public function Menu(){
			
				return self::Assets() . '/start.menu/';
			
			}


			/* Dossier des Applications */
			static public function Apps(){
			
				return __CORES_SYSTEM_COM_VENDOR__ . 'apps/';
			
			}


		} // Class 'Path'


	} // If class exists 'Path'








	if(!class_exists('\GGN\System\OInterface\MockUp')){
			
		Class MockUp extends Invoke{
				
			const NAME = 'Gougnon System OInterface : Maquette';
			
			const VERSION = '0.1';
			
			const UPDATE = '151012.1706';


			static public function Head(){

				return Path::MockUp() . 'mockup.head.php';
				
			}
			
			static public function Foot(){

				return Path::MockUp() . 'mockup.foot.php';

			}
			
			static public function JSInitApps(){

				return Path::MockUp() . 'js.init.apps.php';

			}
			

		} // Class 'MockUp'


	} // If class exists 'MockUp'








	if(!class_exists('\GGN\System\OInterface\Classes')){
			
		Class Classes extends Invoke{
				
			const NAME = 'Gougnon System OInterface : Classes';
			
			const VERSION = '0.1';
			
			const UPDATE = '151011.0256';


			public function __construct(){

				$appPath = Path::Classes();

				if(!is_dir($appPath)){
					\_GGN::wCnsl('<h1>OInterface du Système : Erreur</h1>Dossier introuvable');
				}

				$loader = $appPath . 'load.php';

				if(!is_file($loader)){
					\_GGN::wCnsl('<h1>OInterface du Système : Erreur</h1>Fichier de chargement introuvable');
				}

				include $loader;
				
			}
			

		} // Class 'Classes'


	} // If class exists 'Classes'










	if(!class_exists('\GGN\System\OInterface\Apps')){
			
		Class Apps extends Invoke{
				
			const NAME = 'Gougnon System OInterface : Apps';
			
			const VERSION = '0.1';
			
			const UPDATE = '151011.0256';



			protected $Categories = [

				[
					'icon'=>'app'
					,'cmd'=>false
					,'label'=>'Toutes'
				]

				,[
					'icon'=>'app'
					,'cmd'=>'sys'
					,'label'=>'Système'
				]

				// ,[
				// 	'icon'=>'app'
				// 	,'cmd'=>'social'
				// 	,'label'=>'Social'
				// ]

			];


			public function __construct(){

			}
			

			static public function Categories(){

				return (new self)->Categories;

			}
			
			
			/* 
				Recherche des applications installées 
			*/
			static public function Get($cat = false){
				$apps = [];

				/* Scan tout le dossier */
				$scan = \Gougnon::ScanFolder(Path::Apps());

				/* Verifie le format de la variable */
				if(is_array($scan)){

					/* Parcours les fichier scannés */
					foreach ($scan as $key => $data) {

						/* Clé de l'application */
						$key =  basename($data);

						/* Véfication */
						if(is_dir($data) && is_file($data . '/.manifest') && $key!=Invoke::AppKey ){

							$app = new \GAPPS($key);
							$is = isset($app->Infos) && is_object($app->Infos);
							$acat = ($is==true) ? $app->Infos->Category: false;

							if($cat==false||($cat===$acat) ){

								/* Enregistrement */
								array_push($apps, $key);

							}

						}

					}

				}

				return $apps;

			}
			
			

		} // Class 'Apps'


	} // If class exists 'Apps'




	if(!class_exists('\GGN\System\OInterface\StartMenu')){
			
		Class StartMenu extends Invoke{
				
			const NAME = 'Gougnon System OInterface : StartMenu';
			
			const VERSION = '0.1';
			
			const UPDATE = '151011.0256';




			protected $MenuStarter = [

				// [
				// 	'icon'=>'back'
				// 	,'cmd'=>'minimize.menu'
				// 	,'label'=>'Reduire le menu Démarrer'
				// ]

				[
					'icon'=>'browse'
					,'cmd'=>'browser.files'
					,'label'=>'Parcourir les fichiers'
				]

				,[
					'icon'=>'app'
					,'cmd'=>'apps.all'
					,'label'=>'Applications'
				]

				,[
					'icon'=>'settings'
					,'cmd'=>'settings.system.all'
					,'label'=>'Paramètres'
				]

				,[
					'icon'=>'home'
					,'cmd'=>'home.show'
					,'label'=>'Accueil'
				]

				,[
					'icon'=>'message'
					,'cmd'=>'messages.all'
					,'label'=>'Messages'
				]

				,[
					'icon'=>'alert'
					,'cmd'=>'alert.all'
					,'label'=>'Notifications'
				]

				,[
					'icon'=>'out-right'
					,'cmd'=>'log.out'
					,'label'=>'Se déconnecté'
				]

			];



			/* Obtention */
			static public function Starter(){
				
				return (new self)->MenuStarter;
			
			}



			/* Obtention */
			static public function Get(){

				if(!is_dir(Path::Menu())){
					\_GGN::wCnsl('<h1>OInterface du Système : Erreur du Menu Démarrer</h1>Dossier introuvable');
				}

				$files = \Gougnon::ScanFolder(Path::Menu());
				
			}


			

		} // Class 'StartMenu'


	} // If class exists 'StartMenu'








?>