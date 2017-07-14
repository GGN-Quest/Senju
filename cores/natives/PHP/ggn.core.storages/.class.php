<?php
/*
	Copyright GOBOU Y. Yannick
======================================================
	CLASS Gougnon
	PAGE cores/_GGNs/PHP/ggn.core.storages/.class.php
======================================================

*/


if(!class_exists('GStorages')){
		
	class GStorages extends GGNCorePHP implements GGNCoreInterface
	{

		/* INFOS */
		CONST NAME = 'Gougnon Core Storages';
		CONST VERSION = '0.1';
		CONST REEL_VERSION = '0.1.150218.1549';
		
		
		
		
		
		
		
		
		/* RESSOURCES */
		CONST CPREF = 'function';
		CONST FUNCTIONS_STORE = 'functions/';
		CONST CSUF = 'PHPCore.php';

		
		

		CONST EXTC = '.DAT.';
		CONST EXTS = '.ggn-storage.php';
		// CONST EXTSM = '.ggn-storage-unit.meta';

		CONST DVAR = 'd';


		
		
		
		
		
		
		/* CONSTRUCTEUR */
		public function __construct(){
			$this->arguments = func_get_args(); 	
		}
			
		
		
		/* FUNCTIONS */
		public static function getCoreDir(){
			return dirname(__FILE__) . '/';	
		}
		


		public static function JSON_OPT(){
			return JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE;	
		}
		


		public static function dataDir(){
			return __CORES_SYSTEM_STORAGES__ . 'data/';
		}


		
		public static function getDataFilePath($name, $path){
			return self::dataDir() . $path . '/' . self::EXTC . $name . self::EXTS;
		}


		
		public static function getDataPath($path){
			return self::dataDir() . $path . '/';
		}


		
		// public static function getDataFileMeta($name, $path){
		// 	return self::dataDir() . $path . '/' . self::EXTC . $name . self::EXTSM;
		// }


		
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
			return self::loadFunction($function, $args, '~dynamics', $this);
		}
			


		
	}
		
		
	 
}
 
 
?>