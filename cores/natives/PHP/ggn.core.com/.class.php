<?php
/*
	Copyright GOBOU Y. Yannick
======================================================
	CLASS Gougnon
	PAGE cores/_GGNs/PHP/ggn.core/.class.php
======================================================

*/

global $_Gougnon,$GRegister;

/* Verification */
if(!class_exists('_GGN')){exit('Class Native introuvable');}
if(!class_exists('Gougnon')){_GGN::wCnsl('Class Gougnon introuvable');}



$GAPPS_NATIVE_VARS = 'USERS_SESSION_MANAGER_PLUGIN_PLG LOGIN_PAGE USERS_SESSION_LOCATION USERS_SESSION_MANAGER_PLUGIN_NAME SYSTEM_THEME';

_GGN::keyExists(explode(' ',$GAPPS_NATIVE_VARS));


	



if(!class_exists(_GGN::varn('USERS_SESSION_MANAGER_PLUGIN_NAME'))){
	Gougnon::loadPlugins(_GGN::varn('USERS_SESSION_MANAGER_PLUGIN_PLG'));
}
	






/* Class GUSERS */
if(!class_exists('GUSERS')){
	_GGN::PHPCore('ggn.core.users');
}











if(!class_exists('GCOMCore')){

	class GCOMCore{

		/* INFOS */
		CONST NAME = 'Gougnon Communication Core';
		CONST VERSION = '0.1';
		CONST REEL_VERSION = '0.1.140509.1247';
		CONST TYPE = 'PHP.CORE';
		
		
		
		
		
		
		
		
		/* RESSOURCES */
		CONST CPREF = 'function';
		CONST FUNCTIONS_STORE = 'functions/';
		CONST CSUF = 'PHPCore.php';



		CONST TBL_ = 'NATIVE_APPS';

		CONST CRYKLEN = 256;
		CONST PWCRYDT = 3;
		CONST PWCRYKEY = 3;




		CONST MANIFEST = '.manifest.php';




		public $arguments=false;
		public $key=false;
		
		public $theme=false;
		

		public $USER=false;
		public $USER_APP=false;
		public $USER_SESSION=false;
		public $USER_APP_SESSION=false;


		public $manifest=false;
		public $REQUIRE_APP_AUTH=true;
		public $REQUIRE_AUTH=true;
		
		

		public $Register = false;
		public $Type = 'com:core';

		public $application = [];
		public $CORE = false;





		/* CONSTRUCTEUR */
		public function __construct(){
			global $_Gougnon, $GLANG;
			$this->arguments = func_get_args();

			/* 
				L'instruction est une chaine de caratère qui permet de definir 
				le type de communication qu'on veut passer avec le système 
			*/
			$this->instruction = $this->argumentsVar(0);


			/*
				Gestionner de session
			*/
			$this->sessionHandlerClass = _GGN::varn('USERS_SESSION_MANAGER_PLUGIN_NAME');
			$this->sessionHandler = new $this->sessionHandlerClass;
		}

		



		
		








		/* Initialisations Générales */
		public function initialize(){

			if($this->Type == 'com:application'){
				return $this->initApplication();
			}

			if($this->Type == 'com:service.core'){
				
			}

			if($this->Type == 'com:service.class'){
				
			}

			if($this->Type == 'com:service.plugin'){
				
			}

			if($this->Type == 'com:service.upload'){
				
			}

			return false;
		}



		/* Initialisation : Outils */
		public function initManifest(){

			if(!isset( $this->application['data'])){return false;}
			if(!is_array( $this->application['data'])){return false;}
			if(!isset( $this->application['data']['path'])){return false;}

			$this->manifestFile = $this->application['data']['path'] . '.manifest.php';

			if(!is_file($this->manifestFile)){ 
				$this->manifest = false;
			}
			else{
				$this->manifest = [];
				include($this->manifestFile);
			}

			return $this;
		}



		/* Initialisation : Application*/
		public function initApplication(){

			if($this->instruction==false){return false;}
			$this->application=[];


			/* Concatenation de l'instruction */
			$inst = explode('&',$this->instruction);
			
			$this->application['args'] = [];

			foreach($inst as $name => $value){
				$ex0 = explode(':',$value);

				if(isset($ex0[1])){
					if($ex0[0]=='app'){$this->application['key'] = (isset($ex0[1]))?((Gougnon::isEmpty($ex0[1]))?false:$ex0[1]):false;}
					if($ex0[0]=='args'){array_push($this->application['args'], (isset($ex0[1]))?$ex0[1]:false);}

				}

			}


			if(!isset($this->application['key'])||!is_string($this->application['key'])){return false;}
			$this->application['data'] = [];
			$this->getAppData();

			return $this->initManifest();
		}







		











		/* FUNCTIONS */
		static public function getCoreFolder(){
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
				
			if(!file_exists($funcCompo)){ _GGN::wCnsl("<h1>".self::NAME."</h1><br> Erreur : <b>" . ($func) . "</b> n'existe pas"); }
			
		}


















		/* Outils */
		public function argumentsVar($k){
			return (isset($this->arguments[$k]))?$this->arguments[$k]:false;
		}



		static public function getCOMFromURL(){
			$u = Gougnon::currentURL();
			$ex0 = explode('?',$u);
			$k = count($ex0)-1;
			return (isset($ex0[$k]))?$ex0[$k]:false;
		}



		public function getAppData(){
			global $database;

			if(!isset($this->application['key'])||!is_string($this->application['key'])){return false;}

			$this->query="WHERE ";
			$this->query.="COMKEY='".$this->application['key']."' ";
			$this->query.="AND AVAILABLE='1' ORDER BY VERS DESC";

			$this->appData = $database->SelectFromTable(self::TBL_, $this->query);

			if($this->appData==false){return FALSE;}
				$this->appData->results();

			if($this->appData->row>0){

				foreach($this->appData->data as $n=>$d){
					$nk = strtolower($n);
					$this->application['data'][$nk] = _GGN::setvar($d[0]);
				}

				return TRUE;
			}
			// if($this->appData->row>1){return '-conflit.multi.app';}
			
			return FALSE;
		}



		public function data(){
			$args = func_get_args();
			$exists = $this->exists();
			$key = (isset($args[0]))?$args[0]:false;
			$data = $this->appData->data;
			$this->_data = $data;
			return ($exists!==false)?((isset($this->appData->data[$key][0]))?$data[$key][0]:$data):false;
		}
		









		
	}
		
}
 
 













 
?>