<?php
/*
	Copyright GOBOU Y. Yannick
======================================================
	CLASS Gougnon
	PAGE cores/_GGNs/PHP/ggn.core.applications/.class.php
======================================================

*/

global $_Gougnon,$GRegister;

/* Verification */
if(!class_exists('_GGN')){exit('Class Native introuvable');}
if(!class_exists('Gougnon')){_GGN::wCnsl('Class Gougnon introuvable');}



$GAPPS_NATIVE_VARS = 'USERS_SESSION_MANAGER_PLUGIN_PLG LOGIN_PAGE USERS_SESSION_LOCATION USERS_SESSION_MANAGER_PLUGIN_NAME SYSTEM_THEME';

_GGN::keyExists(explode(' ',$GAPPS_NATIVE_VARS));


	



// if(!class_exists(_GGN::varn('USERS_SESSION_MANAGER_PLUGIN_NAME'))){
// 	Gougnon::loadPlugins(_GGN::varn('USERS_SESSION_MANAGER_PLUGIN_PLG'));
// }
	



/* Environnement d'Application */
if(!class_exists('\GGN\Apps\Invoke')){
	new \GGN\Using('Apps');
}



/* Class GUSERS */
// if(!class_exists('GUSERS')){
// 	_GGN::PHPCore('ggn.core.users');
// }




/* Class CSS3 //removed */
// if(!class_exists('CSS3')){
// 	Gougnon::loadPlugins('PHP/CSS.3');
// }



if(!class_exists('GAPPS')){



	define('APPMockUpFullScreen', '--fullscreen.fid:' . _GGNCrypt::RKCRandm(_GGNCrypt::PALETTE_NUMERIC, 3));
	define('APPMockUpNormal', '--normal.nid:' . _GGNCrypt::RKCRandm(_GGNCrypt::PALETTE_NUMERIC, 3));


		
	class GAPPS extends GGNCorePHP implements GGNCoreInterface
	{

		/* INFOS */
		CONST NAME = 'Gougnon Applications Core';
		CONST VERSION = '0.1';
		CONST REEL_VERSION = '0.1.150427.1657';
		
		
		
		
		
		
		
		
		/* RESSOURCES */
		CONST CPREF = 'function';
		CONST FUNCTIONS_STORE = 'functions/';
		CONST CSUF = 'PHPCore.php';

		

		CONST TBL_ = 'NATIVE_APPS';

		CONST CRYKLEN = 256;
		CONST PWCRYDT = 3;
		CONST PWCRYKEY = 3;




		CONST MANIFEST = '.manifest.php';





		CONST DRIVER_DPO = 'ggn.app::dpo.driver.instance';
		CONST DRIVER_HTML = 'ggn.app::normal.html.driver.instance';




		CONST MockUpLayoutLeft = 'ggn-app-mockup-side-left';
		CONST MockUpLayoutInside = 'ggn-app-mockup-inside';
		CONST MockUpLayoutRight = 'ggn-app-mockup-side-right';



		
		
		var $Key = false;
		var $Driver = false;
		var $DefaultDriver = false;


		var $Manifest = [];
		var $ImageQuality = '-medium';
		var $MainManifest = [];
		var $Registrer = false;
		var $Settings = false;
		var $Arguments = false;
		var $appCodeNameConcatenate = false;

		var $innerAPP = false;




		/* Communication */
		var $COM = [];
		var $AppInstance = '0';
		// var $AppInternalExec = '0';
		
		


		/* Authentification */
		var $REQUIRE_APP_AUTH=true;
		var $REQUIRE_AUTH=true;



		
		/* CONSTRUCTEUR */
		public function __construct(){
			global $GLANG, $GRegister;
			
			// $this->LANG = $GLANG;
			$this->Arguments = func_get_args();
			
			$this->Register = $GRegister;
			
			$this->ajaxRun = (isset($_SERVER['HTTP_X_REQUESTED_WIDTH'])) ? $_SERVER['HTTP_X_REQUESTED_WIDTH'] : FALSE;

			$this->DefaultDriver = self::DRIVER_DPO;

			$this->Driver = (isset($this->Arguments[1]))?(($this->Arguments[1]!=false)?strtolower($this->Arguments[1]):$this->DefaultDriver):$this->DefaultDriver;
			

			/* Utilisateur connecté */
			if(is_array($this->Register->USER)){

				$this->User = new _GGNCustomObject();

				foreach ($this->Register->USER as $k => $d) {
					
					$this->User->{strtolower($k)} = (isset($d))?$d:false;

				}

			}
			/* Utilisateur connecté - FIN */


	
			/* Variables Addictives */
			if(isset($this->Arguments[2])){
				
				if(is_array($this->Arguments[2])){
				
					foreach ($this->Arguments[2] as $key => $value) {
				
						$this->{$key}=$value;
				
					}
				
				}
			
			}
			/* Variables Addictives - FIN */



			/* Clé Application */
			if(isset($this->Arguments[0]) && is_string($this->Arguments[0]) ){

				$this->arguments = $this->Arguments;

				$this->Key = (isset($this->arguments[0]))?(($this->arguments[0]!=false)?$this->arguments[0]:false):false;

				$this->Get();

				if(isset($this->Infos) && is_object($this->Infos)){
					foreach ($this->Infos as $key => $value){if(is_string($value)){$this->Infos->{$key} = _GGN::setvar($value);}}

					$this->Infos->Driver = (isset($this->Infos->Driver) && is_string($this->Infos->Driver) && $this->Infos->Driver==self::DRIVER_HTML) 
						? $this->Infos->Driver: self::DRIVER_DPO; 
				}

			}
			/* Clé Application - FIN */




		}
			
		
		
		/* FUNCTIONS */
		public static function getCoreDir(){
			return dirname(__FILE__) . '/';	
		}
		


		
		public static function functionsDir($function, $mode){
			return self::getCoreDir() . '/' . self::FUNCTIONS_STORE . $mode . '/' . self::CPREF . '.' . $function . '.' . self::CSUF;
		}


		
		public static function isFunction($function, $mode){
			$f = self::functionsDir($function, $mode);
			return (is_file($f)?$f:false);
		}


		
		public static function loadFunction($function, $args, $mode, $context){
			global $Gougnon, $GLANG;

			$is = self::isFunction($function, $mode);
			$return = null;

			if(is_string($is)){include $is; }
			else{_GGN::wCnsl("<h1>" . self::NAME . "</h1> la méthode <b>" . ($function) . "</b> n'existe pas en mode <b>" . $mode . "</b> "); }

			return $return;
		}
			
			
			
		public static function __callStatic($function,$args){
			return self::loadFunction($function, $args, '~statics', false);
		}
			
			
			
		public function __call($function,$args){
			return $this->loadFunction($function, $args, '~dynamics', $this);
		}
			


		
	}
		
		
	 
}
 
 
?>