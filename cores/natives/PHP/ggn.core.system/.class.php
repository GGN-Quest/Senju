<?php
/*
	Copyright GOBOU Y. Yannick
======================================================
	CLASS Gougnon
	PAGE cores/_GGNs/PHP/ggn.core/.class.php
======================================================

*/

	
class GSystem

{

	/* INFOS */

		CONST NAME = 'Gougnon System Core';
		
		CONST VERSION = '0.1';
		
		CONST REEL_VERSION = '0.1.160816.1019';
		
		CONST TYPE = 'PHP.CORE';
	
	
	
	
	
	
	
	
	/* Terminal */

		CONST TERMINAL_NAME = 'Gougnon Terminal BrainKey';
		
		CONST TERMINAL_KEY = 'ggn.terminal.brainkey';

		CONST TERMINAL_VERSION = '0.1';
		
		CONST TERMINAL_UPDATE_VERSION = '0.1.160816.1021';
		
		CONST TERMINAL_TITLE = 'GGN Terminal';

		CONST TERMINAL_STYLE = 'dark:ggn.blue';
		// CONST TERMINAL_STYLE = 'dark:ggn';
		// CONST TERMINAL_STYLE = 'carbon:ghost';
	
	
	
	
	
	
	
	
	/* RESSOURCES */
		CONST CPREF = 'function';
		
		CONST FUNCTIONS_STORE = 'functions/';
		
		CONST CSUF = 'PHPCore.php';

	
	
	/* Interface Manager */

		CONST IMKey = 'ggn.interface.rk.1'; // Interface Manager Application : Clé de l'application
	
	


	
	/* Cleaner Manager */

		CONST CleanerKey = 'ggn.cleaner.rk.1'; // Cleaner Manager Application : Clé de l'application
	
	
	


	/* Documentaions */

		CONST DocsKey = 'ggn.cores.docs.rk.1'; // GGN Docks : Clé de l'application
	


		
	





	
	
	
	
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
			
		if(!file_exists($funcCompo)){ _GGN::wCnsl("Erreur: <b>" . ($func) . "</b> n'existe pas"); }
		
		}

	
}
	
	
 
 
 
?>