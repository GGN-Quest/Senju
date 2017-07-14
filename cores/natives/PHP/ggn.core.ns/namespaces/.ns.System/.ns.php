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
namespace GGN\System;
	
	





	/* Using */
	if(!class_exists('\GGN\System\Using')){
		Class Using{
			public function __construct($ns){ $this->object = clone new \GGN\Using($ns); }
		} 
	}








	if(!class_exists('\GGN\System\Invoke')){

		/*
			Invoke
		*/
		Class Invoke{

			

		} // Class Invoke


	} // if class_exists 'Invoke'







	if(!class_exists('\GGN\System\Bases')){

		/*
			Bases
		*/
		Class Bases{


			/* Fichiers de bases du système */

				var $_FILES = [

					"main://.htaccess"

					, "cores://.htaccess"

					, "cores://autorun.php"

					, "cores://index.php"

					, "cores://native.core.interface.php"

					, "cores://native.cores.php"

					, "cores://native.database.php"

					, "native://.htaccess"

					, "native://CSS/.htaccess"

					, "native://CSS/ggn.core/"

					, "native://JS/.htaccess"

					, "native://JS/ggn.core/"

					, "native://PHP/.htaccess"

					, "native://PHP/ggn.core/"

					, "native://PHP/ggn.core.applications/"

					, "native://PHP/ggn.core.autorun/"

					, "native://PHP/ggn.core.com/"

					, "native://PHP/ggn.core.dpo/"

					, "native://PHP/ggn.core.ns/"

					, "native://PHP/ggn.core.register/.htaccess"

						, "native://PHP/ggn.core.register/.class.php"

						, "native://PHP/ggn.core.register/.load.php"

					, "native://PHP/ggn.core.storages/"

					, "native://PHP/ggn.core.system/"

					, "native://PHP/ggn.core.users/"

					, "native://PHP/ggn.core.variables/"

					, "cores://run.php"

					, "cores://settings.constantes.php"

					, "cores://settings.database.php"

					, "cores://settings.root.php"

					, "cores://settings.tables.database.php"

					, "cores://settings.variables.php"

					, "ggn-system://ggn.terminal.sense"

					, "system://.htaccess"

					, "system://gdk/"

					, "system://register/.htaccess"

						, "system://register/ARC_USERS_BLOGGING/"

						, "system://register/ARC_SLASH_PATH_ENGINE_RENDERING/"

						, "system://register/ARC_SLASH_PATH/"

						, "system://register/ARC_FREE_REGISTER/"

						, "system://register/ARC_EXT_FILES/"

						, "system://register/ARC_EXT_ENGINE_RENDERING/"

						, "system://register/ARC_EVENTS/"

					, "system://com/behaviors/"

					, "system://com/log/"

					, "system://com/tunnels/"
					
					, "system://com/vendor/.htaccess"

						, "system://com/vendor/app/ggn.senju.sense/"
						
						, "system://com/vendor/app/ggn.terminal.sense/"

					, "system://com/services/ggn.com.user/"

					, "system://com/services/ggn.connect/"

					, "system://com/services/ggn.photo/"

					, "system://com/services/ggn.ressources/"

					, "system://com/services/ggn.system/"

					, "system://com/services/ggn.terminal/"

					, "system://com/services/ggn.user/"

					, "system://com/services/ggn.user.blogs/"

					, "system://com/services/ggn.user.blogs.followers/"

					, "system://require.util.rsrc.gsys.php"

					, "system://secures/"

					, "system://sessions/"

					, "system://storages/.htaccess"

					, "system://storages/data/ggn.core/database/"

					, "system://storages/data/ggn.core/variables/natives/"

					, "cmds://mods/mod.ggn.cache/"

					, "cmds://mods/mod.ggn.register/"

					, "cmds://mods/mod.gapp/"
					
					, "cmds://mods/mod.gpk/"

					, "cmds://mods/mod.gdk/"

					, "cmds://mods/mod.ggn.var/"

					, "cmds://mods/mod.server.shell/"

					, "cmds://mods/mod.wiz/"

					, "cmds://process/"

					, "cmds://sequences/"

					, "dpo://layouts.pages/"

					, "dpo://layouts.bricks/"

					, "driver://app/dpo.state.php"

					, "main://index.php"

					, "main://runtime.php"

				];




				public function Files(){

					$Files = $this->_FILES;

					/* Ajouter des fichiers auxiliaire / DEBUT */

						$Files[] = __MAIN__ . 'licenses/index.php';


						$Files[] = __APPLICATIONS__ . '.htaccess';


						$Files[] = __RESSOURCES__ . '.htaccess';


						$Files[] = __SAMPLE_FILES__ . '';


						$Files[] = __CSS__ . '.htaccess';

						$Files[] = __CSS__ . 'ggn.terminal/';

						$Files[] = __CSS__ . 'ggn.shodai/';


						$Files[] = __FONTS__ . '.htaccess';

						$Files[] = __FONTS__ . 'Icons/';

						$Files[] = __FONTS__ . 'roboto.thin/';

						$Files[] = __FONTS__ . 'roboto.light/';

						$Files[] = __FONTS__ . 'roboto.condensed.regular/';

						$Files[] = __TTF_FONTS__ . 'astonished.ttf';


						$Files[] = __CAPTCHA__ . 'captcha_0.png';

						$Files[] = __CAPTCHA__ . 'captcha_1.png';

						$Files[] = __CAPTCHA__ . 'captcha_2.png';

						$Files[] = __CAPTCHA__ . 'captcha_3.png';

						$Files[] = __CAPTCHA__ . 'sample.png';


						$Files[] = __IMAGES__ . '.htaccess';

						$Files[] = __IMAGES__ . 'ggn.shodai/';

						$Files[] = __IMAGES__ . 'loading/ggn-loading-circle.png';

						$Files[] = __IMAGES__ . 'logo/ggn.name.png';

						$Files[] = __IMAGES__ . 'logo/ggn.png';

						$Files[] = __IMAGES__ . 'logo/ggn.senju.name.png';

						$Files[] = __IMAGES__ . 'logo/ggn.senju.png';

						$Files[] = __IMAGES__ . 'logo/logo.name.png';

						$Files[] = __IMAGES__ . 'logo/logo.name.png';


						$Files[] = __JAVASCRIPTS__ . '.htaccess';

						$Files[] = __JAVASCRIPTS__ . 'ggn.shodai/';

						$Files[] = __JAVASCRIPTS__ . 'ggn.terminal/';


						$Files[] = __SVG__ . '.htaccess';

						$Files[] = __SVG__ . 'logo/ggn.senju.a.svg.php';


						$Files[] = __LANGS__ . '.htaccess';

						$Files[] = __LANGS__ . 'FR-fr/GougnonRT.ini';


						$Files[] = __VIDEOS__ . '.htaccess';


						$Files[] = __THEMES__ . '.htaccess';

						$Files[] = __THEMES__ . 'ggn.shodai/';


						$Files[] = __SHOCKWAVES_X__ . '.htaccess';


						$Files[] = __SOUNDS_FILE__ . '.htaccess';


						$Files[] = __DOWNLOADABLES__ . '.htaccess';


						$Files[] = __SAMPLE_FILES__ . '.htaccess';


						$Files[] = __LANGS__ . '.htaccess';


						$Files[] = __USERS__ . '.htaccess';


						$Files[] = __PLUGINS__ . 'HTML/';

							$Files[] = __PLUGINS__ . 'HTML/Models/';

							$Files[] = __PLUGINS__ . 'HTML/Models.plg.php';

						$Files[] = __PLUGINS__ . 'PHP/ajax.upload.0.1.plg.php';

						$Files[] = __PLUGINS__ . 'PHP/designPackage.Object.plg.php';

						$Files[] = __PLUGINS__ . 'PHP/GCaptcha.0.1.plg.php';

						$Files[] = __PLUGINS__ . 'PHP/ggn.photoshot.0.1.plg.php';

						$Files[] = __PLUGINS__ . 'PHP/ggn.session.0.1.plg.php';

						$Files[] = __PLUGINS__ . 'PHP/GImages.0.1.plg.php';

						$Files[] = __PLUGINS__ . 'PHP/GImages.0.1.plg.php';


						$Files[] = __HTML__ . '.htaccess';

						$Files[] = __ARC_PAGES__ . '.htaccess';

						$Files[] = __ARC_PAGES__ . 'LOGIN';

					/* Ajouter des fichiers auxiliaire / FIN */


					return $Files;

				}
			

		} // Class Bases


	} // if class_exists 'Bases'








	if(!class_exists('\GGN\System\Driver')){

		/*
			Driver
		*/
		Class Driver{

			static public function Get($Name = false, $Args = false){

				if(is_string($Name)){

					$File = __CORES_SYSTEM__ . 'x-drivers/' . ( (!is_string($Name)) ? '': $Name )  . '.php';

					if(is_file($File)){

						$Driver = false;

							include $File;

						return $Driver;

					}

					else{return false;}

				}

				else{return false;}

			}


			static public function State($Name = false, $Args = false){

				if(is_string($Name)){

					return self::Get($Name . '.state', $Args);

				}

				else{return false;}

			}



		} // Class Driver


	} // if class_exists 'Driver'









				








?>