<?php
/*
	Copyright GOBOU Y. Yannick
======================================================
	CLASS Gougnon
	PAGE cores/_GGNs/PHP/ggn.core/.class.php
======================================================

*/

	
class Gougnon
{

	/* INFOS */
	CONST NAME = 'Gougnon PHP Framework';
	CONST VERSION = '0.1';
	CONST REEL_VERSION = '0.1.160331.1348';
	CONST TYPE = 'PHP.CORE';
	
	
	
	
	
	
	
	
	
	
	/* RESSOURCES */
	CONST CPREF = 'function';
	CONST FUNCTIONS_STORE = 'functions/';
	CONST CSUF = 'PHPCore.php';

	
	
	
	
	
	
	
	
	/* CONSTRUCTEUR */
	public function __construct(){
		$this->PARAM = func_get_args(); 	
		}
		
	
	
	/* FUNCTIONS */
	public static function getCoreFolder(){
		return dirname(__FILE__) . '/';	
		}
		
		
		
	public static function __callStatic($F,$A){
		return self::loadNewFunction($F,$A, '-s');	
		}
		
		
		
	public function __call($F,$A){
		$this->loadNewFunction($F,$A, '-d');	
		}
		
		
	protected static function loadNewFunction($func,$args,$calledMode){
		global $Gougnon, $GLANG;
		
		$funcCompo = self::getCoreFolder() . '/' . self::FUNCTIONS_STORE . self::CPREF . '.' . $func . '.' . self::CSUF;
		if(file_exists($funcCompo)){
			if($calledMode == '-s'){ return include $funcCompo; }
			if($calledMode == '-d'){ include $funcCompo; }
			 }
			
		if(!file_exists($funcCompo)){ _GGN::wCnsl("<h1>" . self::NAME . "</h1> la méthode <b>" . ($func) . "</b> n'existe pas en <b>" . $calledMode . "</b>"); }
		
		}

	
}
	
	
 
 
 
?>