<?php
/*
	Copyright GOBOU Y. Yannick
======================================================
	CLASS Gougnon
	PAGE cores/_GGNs/JS/ggn.core/.class.php
======================================================

*/

	
class GougnonJS
{

	/* INFOS */
	CONST NAME = 'Gougnon JS Framework';
	CONST VERSION = '0.1';
	CONST REEL_VERSION = '0.1.160205.1003';
	CONST TYPE = 'JS.CORE';
	
	
	
	
	
	
	
	/* OPERATEUR */
	CONST OPERATOR_CONSTRUCTOR = "GOBOU Y. Yannick";
	CONST OPERATOR_WEBSITE = "http://Gougnon.com";
	CONST OPERATOR_MAIL = "dev@Gougnon.com";
	
	
	
	
	
	
	
	
	/* RESSOURCES */
	CONST CPREF = 'function';
	CONST FUNCTIONS_STORE = 'functions/';
	CONST CSUF = 'JSCore.php';

	CONST CPREP = 'api';
	CONST PACKAGES_STORE = 'APIs/';
	CONST CSUP = 'JSCore.pkg.php';

	CONST FPREP = 'framework';
	CONST FRAMEWORK_STORE = 'frameworks/';
	CONST FSUP = 'php';

	
	
	
	
	
	
	
	/* CONSTRUCTEUR */
	public function __construct(){
		$this->PARAM = func_get_args(); 	
		}
		
	
	
	/* FUNCTIONS */
	public function getCoreFolder(){
		return dirname(__FILE__) . '/';	
		}
		
	
		
		
		
	public static function __callStatic($F,$A){
		return self::loadNewFunction($F,$A, '-s');	
		}
		
		
		
	PUBLIC FUNCTION __call($F,$A){
		$this->loadNewFunction($F,$A, '-d');	
		}
		
		
	protected function loadNewFunction($func,$args,$calledMode){
		global $Gougnon, $GLANG;
		
		$funcCompo = dirname(__FILE__) . '/' . self::FUNCTIONS_STORE . self::CPREF . '.' . $func . '.' . self::CSUF;
		
		if(file_exists($funcCompo)){
			if($calledMode == '-s'){ return include $funcCompo; }
			if($calledMode == '-d'){ include $funcCompo; }
			}
			
		if(!file_exists($funcCompo)){ _GGN::wCnsl("Erreur: <b>" . ($func) . "</b> est introuvable"); }
		}
		
		
		
		
		
	public function initDefaultStyle(){
		$CSSCore = new GougnonCSS;
		$CSSCore->Style((defined('DEFAULT_STYLE'))?DEFAULT_STYLE: GougnonCSS::STYLE);
		GougnonJS::toJSON('__GOUGNONJS_DEFAULT_STYLE__', $CSSCore->StyleProperties);
	}
		
		
		
	public function loadPackages($pkg){
		global $Gougnon, $GLANG;
		
		if(!Gougnon::isEmpty($pkg)){
			$pkgCompo = dirname(__FILE__) . '/' . self::PACKAGES_STORE . self::CPREP . '.' . $pkg . '.' . self::CSUP;
			if(file_exists($pkgCompo)){$JSCore = new self();include $pkgCompo;}
			if(!file_exists($pkgCompo)){ return false; }
			}
			
	}	
	
	public function libraries($apin){
		global $Gougnon, $GLANG;
		$dir = dirname(__FILE__) . '/' . self::PACKAGES_STORE;
		$get = Gougnon::iScanFolder($dir);

		foreach ($get as $apib) {
			if(is_file($apib)){
				$path = dirname(substr($apib,strlen($dir)));
				$apia = basename($apib);
				$apid = self::CPREP . '.' . $apin;

				if(substr($apia, 0, strlen($apid))==$apid){
					$api = substr($apia, strlen(self::CPREP.'.'), -1*strlen('.'.self::CSUP));
					$path = ($path=='.')?'':$path.'/';

					if(strtolower($api)==strtolower($apin)){

					}
					else{
						self::loadPackages($path.$api);
					}

				}
			}
		}
		
	}	
	
		
		
	public function framework($version){
		global $Gougnon, $GLANG;
		
		if(!Gougnon::isEmpty($version)){
			$frwk = dirname(__FILE__) . '/' . self::FRAMEWORK_STORE . self::FPREP . '.' . $version . '.'  . self::FSUP;

			if(file_exists($frwk)){$JSCore = new self();include $frwk;}
			if(!file_exists($frwk)){ return false; }
			}
			
	}	
		
	public function loadDefaultFramework(){
		self::framework('nightly.0.1');
	}


	
}
	
	
 
 
 
?>